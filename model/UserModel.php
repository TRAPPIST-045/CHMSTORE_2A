<?php
class UserModel
{
    public static function login(string $username, string $password)
    {
        $stmt = Database::pdo()->prepare(
            'SELECT id, username, password_hash, full_name, role
             FROM users WHERE username=:u AND role=:r LIMIT 1'
        );
        $stmt->execute([':u'=>$username, ':r'=>'admin']);
        $u = $stmt->fetch();
        if (!$u || !password_verify($password, $u['password_hash'])) return false;

        $_SESSION['admin_id']       = (int)$u['id'];
        $_SESSION['admin_username'] = $u['username'];
        $_SESSION['admin_fullname'] = $u['full_name'];
        $_SESSION['admin_role']     = $u['role'];
        unset($u['password_hash']);
        return $u;
    }
    public static function logout(): void {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(),'',time()-42000,$p['path'],$p['domain'],$p['secure'],$p['httponly']);
        }
        session_destroy();
    }
    public static function isLoggedIn(): bool { return isset($_SESSION['admin_id']); }
    public static function getCurrentAdmin(): string {
        return $_SESSION['admin_fullname'] ?? $_SESSION['admin_username'] ?? 'Admin';
    }
    public static function getCurrentAdminId(): ?int { return $_SESSION['admin_id'] ?? null; }
}
