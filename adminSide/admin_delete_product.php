<?php
/** POST id + action=delete|unpublish|publish  (JSON if AJAX) */
require '../controller/Controller.php';
MainController::requireLogin();

$id     = (int)($_REQUEST['id'] ?? 0);
$action = (string)($_REQUEST['action'] ?? 'unpublish');
if ($id <= 0) MainController::json(['ok'=>false,'error'=>'invalid id'],400);

switch ($action) {
    case 'delete':    ProductModel::delete($id); break;
    case 'publish':   ProductModel::setStatus($id,'published'); break;
    case 'unpublish':
    default:          ProductModel::setStatus($id,'unpublished'); break;
}

if (MainController::isAjax()) {
    MainController::json(['ok'=>true,'id'=>$id,'action'=>$action]);
}
MainController::redirect('admin_productlist.php');
