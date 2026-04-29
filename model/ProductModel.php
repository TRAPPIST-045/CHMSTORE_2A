<?php
class ProductModel
{
    public static function getAll(?string $category=null, ?string $search=null, bool $onlyPublished=false): array
    {
        $sql = 'SELECT * FROM products WHERE 1=1';
        $params = [];
        if ($onlyPublished) { $sql .= " AND status='published'"; }
        if ($category && strtolower($category)!=='all') { $sql .= ' AND category=:c'; $params[':c']=$category; }
        if ($search)   { $sql .= ' AND (name LIKE :q1 OR description LIKE :q2)'; $params[':q1']='%'.$search.'%'; $params[':q2']='%'.$search.'%'; }
        $sql .= ' ORDER BY created_at DESC';

        $st = Database::pdo()->prepare($sql); $st->execute($params);
        $rows = $st->fetchAll();
        foreach ($rows as &$p) {
            $p['variants']    = self::getVariants((int)$p['id']);
            $p['total_stock'] = array_sum(array_column($p['variants'],'stock'));
            $p['price']       = (float)$p['price'];
        }
        return $rows;
    }
    public static function getById(int $id): ?array {
        $st = Database::pdo()->prepare('SELECT * FROM products WHERE id=:id LIMIT 1');
        $st->execute([':id'=>$id]); $p = $st->fetch();
        if(!$p) return null;
        $p['variants']    = self::getVariants($id);
        $p['total_stock'] = array_sum(array_column($p['variants'],'stock'));
        $p['price']       = (float)$p['price'];
        return $p;
    }
    public static function create(array $d): int {
        $st = Database::pdo()->prepare(
            'INSERT INTO products (name,description,category,price,image,status)
             VALUES (:n,:d,:c,:p,:i,:s)'
        );
        $st->execute([
            ':n'=>trim($d['name']??''),':d'=>trim($d['description']??''),
            ':c'=>$d['category']??'Uniforms',':p'=>(float)($d['price']??0),
            ':i'=>$d['image']??DEFAULT_PRODUCT_IMAGE,':s'=>$d['status']??'published',
        ]);
        return (int)Database::pdo()->lastInsertId();
    }
    public static function update(int $id, array $d): bool {
        $st = Database::pdo()->prepare(
            'UPDATE products SET name=:n,description=:d,category=:c,price=:p,image=:i,status=:s WHERE id=:id'
        );
        return $st->execute([
            ':id'=>$id,':n'=>trim($d['name']??''),':d'=>trim($d['description']??''),
            ':c'=>$d['category']??'Uniforms',':p'=>(float)($d['price']??0),
            ':i'=>$d['image']??DEFAULT_PRODUCT_IMAGE,':s'=>$d['status']??'published',
        ]);
    }
    public static function delete(int $id): bool {
        return Database::pdo()->prepare('DELETE FROM products WHERE id=:id')->execute([':id'=>$id]);
    }
    public static function setStatus(int $id, string $s): bool {
        return Database::pdo()->prepare('UPDATE products SET status=:s WHERE id=:id')
               ->execute([':s'=>$s,':id'=>$id]);
    }

    // ---------- Variants ----------
    public static function getVariants(int $pid): array {
        $st = Database::pdo()->prepare(
            'SELECT id,product_id,variant_name,size,color,sku,stock,price
             FROM product_variants WHERE product_id=:p ORDER BY id ASC'
        );
        $st->execute([':p'=>$pid]);
        $rows = $st->fetchAll();
        foreach($rows as &$r){ $r['stock']=(int)$r['stock']; $r['price']=(float)$r['price']; }
        return $rows;
    }
    public static function addVariant(int $pid, array $v): int {
        $size  = trim($v['size']  ?? '');
        $color = trim($v['color'] ?? '');
        $name  = trim($v['variant_name'] ?? '') ?: trim($size.' '.$color);
        $sku   = trim($v['sku'] ?? '') ?: self::generateSku($pid,$size,$color);
        $stock = (int)($v['stock'] ?? 0);
        $price = isset($v['price']) ? (float)$v['price'] : 0.0;

        $st = Database::pdo()->prepare(
            'INSERT INTO product_variants (product_id,variant_name,size,color,sku,stock,price)
             VALUES (:p,:n,:s,:c,:k,:t,:r)'
        );
        $st->execute([':p'=>$pid,':n'=>$name,':s'=>$size,':c'=>$color,':k'=>$sku,':t'=>$stock,':r'=>$price]);
        return (int)Database::pdo()->lastInsertId();
    }
    public static function deleteVariants(int $pid): bool {
        return Database::pdo()->prepare('DELETE FROM product_variants WHERE product_id=:p')
               ->execute([':p'=>$pid]);
    }
    private static function generateSku(int $pid,string $size,string $color): string {
        $slug = strtoupper(preg_replace('/[^A-Z0-9]/i','',$size.$color)) ?: 'VAR';
        return sprintf('P%d-%s-%s',$pid,$slug,substr(bin2hex(random_bytes(2)),0,4));
    }
}
