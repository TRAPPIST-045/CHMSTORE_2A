<?php
class OrderModel
{
    public const STATUSES = ['Pending','Processing','Ready for Pickup','Completed','Cancelled'];

    public static function getAll(?string $status=null): array
    {
        $sql = 'SELECT o.*, s.full_name AS student_name, s.email AS student_email, s.student_no
                FROM orders o LEFT JOIN students s ON s.id=o.student_id';
        $params=[];
        if ($status && strtolower($status)!=='all') { $sql .= ' WHERE o.status=:s'; $params[':s']=$status; }
        $sql .= ' ORDER BY o.created_at DESC';
        $st = Database::pdo()->prepare($sql); $st->execute($params);
        $orders = $st->fetchAll();

        $itemsStmt = Database::pdo()->prepare(
            'SELECT oi.*, p.name AS product_name,
                    COALESCE(pv.variant_name, CONCAT_WS(" ", pv.size, pv.color)) AS variant
             FROM order_items oi
             JOIN products p ON p.id=oi.product_id
             LEFT JOIN product_variants pv ON pv.id=oi.variant_id
             WHERE oi.order_id=:oid'
        );
        foreach ($orders as &$o) {
            $itemsStmt->execute([':oid'=>$o['id']]);
            $o['items'] = array_map(function($r){
                return [
                    'name'    => $r['product_name'],
                    'variant' => $r['variant'] ?: 'Standard',
                    'qty'     => (int)$r['quantity'],
                    'price'   => (float)$r['price'],
                ];
            }, $itemsStmt->fetchAll());
            $o['total'] = (float)$o['total'];
        }
        return $orders;
    }

    public static function getById(int $id): ?array {
        $st = Database::pdo()->prepare(
            'SELECT o.*, s.full_name AS student_name, s.email AS student_email, s.student_no
             FROM orders o LEFT JOIN students s ON s.id=o.student_id WHERE o.id=:id'
        );
        $st->execute([':id'=>$id]);
        $o = $st->fetch();
        if (!$o) return null;
        $st2 = Database::pdo()->prepare(
            'SELECT oi.*, p.name AS product_name,
                    COALESCE(pv.variant_name, CONCAT_WS(" ", pv.size, pv.color)) AS variant
             FROM order_items oi
             JOIN products p ON p.id=oi.product_id
             LEFT JOIN product_variants pv ON pv.id=oi.variant_id
             WHERE oi.order_id=:oid'
        );
        $st2->execute([':oid'=>$id]);
        $o['items'] = $st2->fetchAll();
        $o['total'] = (float)$o['total'];
        return $o;
    }

    public static function getDashboardStats(): array {
        $pdo = Database::pdo();
        return [
            'total_orders' => (int)$pdo->query("SELECT COUNT(*) FROM orders WHERE DATE(created_at)=CURDATE()")->fetchColumn(),
            'pending'      => (int)$pdo->query("SELECT COUNT(*) FROM orders WHERE status IN ('Pending','Processing')")->fetchColumn(),
            'ready'        => (int)$pdo->query("SELECT COUNT(*) FROM orders WHERE status='Ready for Pickup'")->fetchColumn(),
            'revenue'      => (float)$pdo->query("SELECT COALESCE(SUM(total),0) FROM orders WHERE status='Completed'")->fetchColumn(),
        ];
    }

    public static function updateStatus($orderId, string $status, array $meta=[]): bool {
        if (!in_array($status, self::STATUSES, true)) return false;
        $pdo = Database::pdo();

        $sets = ['status=:s'];
        $params = [':s'=>$status];

        $map = [
            'payment_status'     => 'payment_status',
            'accepted_by'        => 'accepted_by',
            'accepted_date'      => 'accepted_date',
            'processed_by'       => 'processed_by',
            'processed_date'     => 'processed_date',
            'completed_by'       => 'completed_by',
            'completed_date'     => 'completed_date',
            'cancel_reason'      => 'cancel_reason',
            'cancel_reason_date' => 'cancel_reason_date',
        ];
        foreach ($map as $k => $col) {
            if (array_key_exists($k,$meta)) { $sets[] = "$col=:$k"; $params[":$k"] = $meta[$k]; }
        }

        if (is_numeric($orderId)) {
            $sql = 'UPDATE orders SET '.implode(',',$sets).' WHERE id=:id';
            $params[':id'] = (int)$orderId;
        } else {
            $sql = 'UPDATE orders SET '.implode(',',$sets).' WHERE order_code=:oc';
            $params[':oc'] = (string)$orderId;
        }
        return $pdo->prepare($sql)->execute($params);
    }

    public static function create(int $studentId, array $items, string $status='Pending', string $paymentMethod='Cash at BOA'): int {
        $pdo = Database::pdo(); $pdo->beginTransaction();
        try {
            $code   = 'CHM-' . strtoupper(bin2hex(random_bytes(3)));
            $pickup = 'PU-'  . strtoupper(bin2hex(random_bytes(2)));
            $total = 0.0;
            foreach ($items as $it) $total += (float)$it['price']*(int)$it['quantity'];

            $pdo->prepare(
                'INSERT INTO orders (order_code,pickup_code,student_id,total,status,payment_method,payment_status)
                 VALUES (:oc,:pu,:sid,:t,:s,:pm,:ps)'
            )->execute([
                ':oc'=>$code,':pu'=>$pickup,':sid'=>$studentId,':t'=>$total,
                ':s'=>$status,':pm'=>$paymentMethod,
                ':ps'=> $paymentMethod==='Online Payment' ? 'Paid' : 'Unpaid',
            ]);
            $oid = (int)$pdo->lastInsertId();

            $ins = $pdo->prepare(
                'INSERT INTO order_items (order_id,product_id,variant_id,quantity,price)
                 VALUES (:oid,:pid,:vid,:q,:p)'
            );
            foreach ($items as $it) {
                $ins->execute([
                    ':oid'=>$oid,':pid'=>(int)$it['product_id'],
                    ':vid'=>isset($it['variant_id'])?(int)$it['variant_id']:null,
                    ':q'=>(int)$it['quantity'],':p'=>(float)$it['price'],
                ]);
            }
            $pdo->commit(); return $oid;
        } catch (Throwable $e) { $pdo->rollBack(); throw $e; }
    }
}
