<?php
/**
 * Gmail-style inbox actions.
 *
 * POST JSON body  (recommended) OR form fields:
 *   action = star | unstar | move | delete | mark_read | mark_unread | send
 *
 * - star / unstar / move / delete / mark_read / mark_unread:
 *     id      (int)  — required
 *     folder  (str)  — required for action=move  (inbox|sent|archive|trash)
 *
 * - send:
 *     receiver_email   (str) required
 *     receiver_name    (str) optional
 *     subject          (str) optional
 *     body             (str) required
 *
 * Always JSON response.
 */
require '../controller/Controller.php';
MainController::requireLogin();

// Accept JSON payloads
$input = [];
$raw = file_get_contents('php://input');
if ($raw) {
    $json = json_decode($raw, true);
    if (is_array($json)) $input = $json;
}
$input = array_merge($input, $_POST);

$action = $input['action'] ?? '';
$id     = (int)($input['id'] ?? 0);

switch ($action) {
    case 'star':        MainController::json(['ok'=>MessageModel::star($id,true)]);
    case 'unstar':      MainController::json(['ok'=>MessageModel::star($id,false)]);
    case 'mark_read':   MainController::json(['ok'=>MessageModel::markRead($id,true)]);
    case 'mark_unread': MainController::json(['ok'=>MessageModel::markRead($id,false)]);
    case 'delete':      MainController::json(['ok'=>MessageModel::delete($id)]);
    case 'move':
        $f = $input['folder'] ?? '';
        MainController::json(['ok'=>MessageModel::moveTo($id,$f)]);
    case 'send':
        $receiver = trim($input['receiver_email'] ?? '');
        $body     = trim($input['body'] ?? '');
        if (!$receiver || !$body) MainController::json(['ok'=>false,'error'=>'receiver + body required'],400);
        $newId = MessageModel::create([
            'sender_type'    => 'admin',
            'sender_name'    => UserModel::getCurrentAdmin(),
            'sender_email'   => 'admin@chmstore.edu.ph',
            'receiver_name'  => trim($input['receiver_name'] ?? ($receiver ? explode('@',$receiver)[0] : '')),
            'receiver_email' => $receiver,
            'subject'        => trim($input['subject'] ?? '(No subject)'),
            'body'           => $body,
            'folder'         => 'sent',
            'is_read'        => true,
        ]);
        $msg = MessageModel::getById($newId);
        MainController::json(['ok'=>true,'message'=>$msg]);
    default:
        MainController::json(['ok'=>false,'error'=>'unknown action'],400);
}
