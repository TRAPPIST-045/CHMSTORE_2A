<?php
/**
 * Central Controller loader — include from every admin page:
 *     require '../controller/Controller.php';
 */
$__B = __DIR__ . '/..';
require_once $__B . '/config/db.php';
require_once $__B . '/model/Database.php';
require_once $__B . '/model/UserModel.php';
require_once $__B . '/model/ProductModel.php';
require_once $__B . '/model/OrderModel.php';
require_once $__B . '/model/MessageModel.php';

class MainController
{
    public static function requireLogin(): void {
        if (!UserModel::isLoggedIn()) { header('Location: '.LOGIN_PAGE); exit; }
    }
    public static function redirect(string $to): void { header('Location: '.$to); exit; }
    public static function json($payload, int $code=200): void {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        exit;
    }
    public static function isAjax(): bool {
        return strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'xmlhttprequest'
            || str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json');
    }
}
