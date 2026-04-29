<?php
/**
 * CHIMSTOKET / CHMSTORE  —  Database + App config
 */

define('DB_HOST', getenv('CHMSTORE_DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('CHMSTORE_DB_PORT') ?: '3306');
define('DB_NAME', getenv('CHMSTORE_DB_NAME') ?: 'chmstore');
define('DB_USER', getenv('CHMSTORE_DB_USER') ?: 'root');
define('DB_PASS', getenv('CHMSTORE_DB_PASS') ?: '');
define('DB_CHARSET', 'utf8mb4');

define('APP_NAME', 'CHMSTORE');
define('LOGIN_PAGE', 'adminLogin.php');
define('UPLOAD_DIR', __DIR__ . '/../adminSide/uploads');
define('UPLOAD_URL', 'uploads');               // relative to adminSide/*.php
define('DEFAULT_PRODUCT_IMAGE', '../assets/images/uniformnobg.png');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', '1');
