<?php
class MessageModel
{
    public const FOLDERS = ['inbox','sent','archive','trash'];

    public static function getAll(?string $folder=null): array
    {
        $sql = 'SELECT * FROM messages';
        $params = [];
        if ($folder && in_array($folder, self::FOLDERS, true)) {
            $sql .= ' WHERE folder=:f'; $params[':f']=$folder;
        }
        $sql .= ' ORDER BY id DESC';
        $st = Database::pdo()->prepare($sql); $st->execute($params);
        $rows = $st->fetchAll();
        foreach ($rows as &$r) {
            $r['is_read']    = (bool)$r['is_read'];
            $r['is_starred'] = (bool)$r['is_starred'];
            $r['msg_id']     = (int)$r['id'];
            $r['msg_folder'] = $r['folder'];
            $r['msg_subject']= $r['subject'];
            $r['msg_body']   = $r['body'];
            $r['is_selected']= false;
            $r['date_added'] = self::prettyDate($r['created_at']);
            $r['full_date']  = date('D, M j, g:i A', strtotime($r['created_at']));
        }
        return $rows;
    }
    public static function getById(int $id): ?array {
        $st = Database::pdo()->prepare('SELECT * FROM messages WHERE id=:id');
        $st->execute([':id'=>$id]); $r = $st->fetch(); return $r ?: null;
    }
    public static function markRead(int $id, bool $read=true): bool {
        return Database::pdo()->prepare('UPDATE messages SET is_read=:v WHERE id=:id')
               ->execute([':v'=>$read?1:0,':id'=>$id]);
    }
    public static function star(int $id, bool $starred): bool {
        return Database::pdo()->prepare('UPDATE messages SET is_starred=:v WHERE id=:id')
               ->execute([':v'=>$starred?1:0,':id'=>$id]);
    }
    public static function moveTo(int $id, string $folder): bool {
        if (!in_array($folder, self::FOLDERS, true)) return false;
        return Database::pdo()->prepare('UPDATE messages SET folder=:f WHERE id=:id')
               ->execute([':f'=>$folder,':id'=>$id]);
    }
    public static function delete(int $id): bool {
        return Database::pdo()->prepare('DELETE FROM messages WHERE id=:id')->execute([':id'=>$id]);
    }
    public static function create(array $d): int {
        $st = Database::pdo()->prepare(
            'INSERT INTO messages (sender_type,sender_name,sender_email,receiver_name,receiver_email,subject,body,folder,is_read,is_starred)
             VALUES (:st,:sn,:se,:rn,:re,:su,:bo,:fo,:ir,:is)'
        );
        $st->execute([
            ':st'=>$d['sender_type']??'student',':sn'=>trim($d['sender_name']??''),
            ':se'=>trim($d['sender_email']??''),
            ':rn'=>trim($d['receiver_name']??''),':re'=>trim($d['receiver_email']??''),
            ':su'=>trim($d['subject']??'(No subject)'),':bo'=>trim($d['body']??''),
            ':fo'=>$d['folder']??'inbox',
            ':ir'=>!empty($d['is_read'])?1:0,':is'=>!empty($d['is_starred'])?1:0,
        ]);
        return (int)Database::pdo()->lastInsertId();
    }
    public static function unreadCount(): int {
        return (int)Database::pdo()->query("SELECT COUNT(*) FROM messages WHERE is_read=0 AND folder='inbox'")->fetchColumn();
    }
    private static function prettyDate(string $ts): string {
        $t = strtotime($ts); if (!$t) return $ts;
        return date('Y-m-d')===date('Y-m-d',$t) ? date('g:i A',$t) : date('M j',$t);
    }
}
