<?php
require '../controller/Controller.php';
MainController::requireLogin();

$messages = MessageModel::getAll();     // all folders — JS filters
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Messages | CHMSTORE</title>
    <link rel="stylesheet" href="css/admin_contacts.css">
    <link rel="stylesheet" href="css/admin_global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="admin-layout-100vh">

    <nav class="pill-navbar">
        <div class="nav-brand">
            <div class="brand-logo-placeholder">CH</div>
            <span class="brand-text">CHMSTORE</span>
        </div>
        <div class="nav-pills-container">
            <a href="admin_dashboard.php" class="nav-pill"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="admin_productlist.php" class="nav-pill"><i class="fas fa-box"></i> Products</a>
            <a href="admin_orders.php" class="nav-pill"><i class="fas fa-shopping-cart"></i> Orders</a>
            <a href="#" class="nav-pill"><i class="fas fa-clipboard-list"></i> Inventory</a>
            <a href="admin_contacts.php" class="nav-pill active"><i class="fas fa-address-book"></i> Messages</a>
            <a href="admin_logout.php" class="nav-pill"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="nav-right-actions">
            <div class="notification-bell" id="notifTrigger">
                <i class="fas fa-bell"></i>
                <span class="badge red"><?= MessageModel::unreadCount() ?></span>
            </div>
            <div class="admin-profile-pill">
                <div class="admin-text">
                    <span class="admin-name"><?= htmlspecialchars(UserModel::getCurrentAdmin()) ?></span>
                    <span class="admin-role">Manager</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Notification panel -->
    <div id="notifPanel" class="notif-panel">
        <div class="notif-header">
            <span>Notifications</span>
            <button id="closeNotif" class="close-notif-btn"><i class="fas fa-times"></i></button>
        </div>
        <div class="notif-tabs">
            <button class="notif-tab active">All</button>
            <button class="notif-tab">Orders</button>
            <button class="notif-tab">Stock</button>
        </div>
        <div class="notif-body">
            <p style="padding:16px;color:#888">No new notifications.</p>
        </div>
    </div>

    <main class="gmail-layout">

        <!-- SIDEBAR -->
        <aside class="gmail-sidebar">
            <button id="btnComposeNew" class="btn-compose"><i class="fas fa-pen"></i> Compose</button>
            <nav class="gmail-folders">
                <a href="#" class="gmail-folder active"  data-folder="inbox"><i class="fas fa-inbox"></i> Inbox <span id="inboxBadge" class="folder-badge"></span></a>
                <a href="#" class="gmail-folder"         data-folder="starred"><i class="fas fa-star"></i> Starred</a>
                <a href="#" class="gmail-folder"         data-folder="sent"><i class="fas fa-paper-plane"></i> Sent</a>
                <a href="#" class="gmail-folder"         data-folder="archive"><i class="fas fa-archive"></i> Archive</a>
                <a href="#" class="gmail-folder"         data-folder="trash"><i class="fas fa-trash"></i> Trash</a>
            </nav>
        </aside>

        <!-- MAIN -->
        <section class="gmail-main">

            <!-- Toolbar -->
            <div class="gmail-toolbar">
                <label class="checkbox-wrapper">
                    <input id="masterCheckbox" type="checkbox" class="gmail-checkbox">
                </label>
                <div class="select-dropdown">
                    <button id="selectDropdownTrigger" type="button"><i class="fas fa-caret-down"></i></button>
                    <div id="selectDropdownMenu" class="dropdown-menu">
                        <a href="#" data-select="all">All</a>
                        <a href="#" data-select="none">None</a>
                        <a href="#" data-select="read">Read</a>
                        <a href="#" data-select="unread">Unread</a>
                        <a href="#" data-select="starred">Starred</a>
                        <a href="#" data-select="unstarred">Unstarred</a>
                    </div>
                </div>
                <button id="refreshBtn" type="button" title="Refresh"><i class="fas fa-sync"></i></button>
                <div id="batchActions" class="batch-actions hidden">
                    <button id="batchArchiveBtn" type="button"><i class="fas fa-archive"></i></button>
                    <button id="batchDeleteBtn"  type="button"><i class="fas fa-trash"></i></button>
                    <button id="batchMarkReadBtn" type="button"><i class="fas fa-envelope-open"></i></button>
                </div>
                <div class="pagination-info">
                    <span id="listPaginationText">0 of 0</span>
                </div>
            </div>

            <!-- List view -->
            <div id="viewMessageList" class="gmail-view active">
                <div id="messageListContainer" class="gmail-message-list"></div>
            </div>

            <!-- Read view -->
            <div id="viewMessageRead" class="gmail-view">
                <div class="read-toolbar">
                    <button id="btnBackToList" type="button"><i class="fas fa-arrow-left"></i> Back</button>
                    <button id="btnReadArchive" type="button"><i class="fas fa-archive"></i></button>
                    <button id="btnReadDelete"  type="button"><i class="fas fa-trash"></i></button>
                    <button id="btnReadUnread"  type="button"><i class="fas fa-envelope"></i></button>
                    <button id="btnReadStar"    type="button"><i class="far fa-star"></i></button>
                    <span id="readPaginationText" class="pagination-info"></span>
                </div>
                <div class="read-body">
                    <h2 id="readSubject"></h2>
                    <div class="read-meta">
                        <span id="readFolderLabel" class="folder-tag"></span>
                    </div>
                    <div class="read-sender-row">
                        <div id="readAvatar" class="sender-avatar"></div>
                        <div class="sender-info">
                            <span id="readSenderName" class="sender-name"></span>
                            <span id="readSenderEmail" class="sender-email"></span>
                        </div>
                        <span id="readDate" class="read-date"></span>
                    </div>
                    <div id="readBody" class="read-content"></div>

                    <!-- Pill buttons -->
                    <div id="footerPillBtns" class="reply-pills">
                        <button id="btnTopReply"     type="button"><i class="fas fa-reply"></i> Reply</button>
                        <button id="btnBottomReply"  type="button"><i class="fas fa-reply"></i> Reply</button>
                        <button id="btnBottomForward" type="button"><i class="fas fa-share"></i> Forward</button>
                    </div>

                    <!-- Inline reply -->
                    <div id="inlineReplyBox" class="inline-reply" style="display:none">
                        <div class="reply-tabs">
                            <button id="replyTab"   type="button" class="tab active">Reply</button>
                            <button id="forwardTab" type="button" class="tab">Forward</button>
                        </div>
                        <div id="replyToLine" class="reply-to-line">To: <span id="replyToEmail"></span></div>
                        <div id="replyEditor" class="reply-editor" contenteditable="true"></div>
                        <div id="replyAttachments" class="reply-attachments"></div>
                        <div class="reply-actions">
                            <button id="btnSendReply"    type="button" class="btn-primary"><i class="fas fa-paper-plane"></i> Send</button>
                            <button id="btnDiscardReply" type="button" class="btn-secondary"><i class="fas fa-trash"></i></button>
                            <label class="attach-btn"><i class="fas fa-paperclip"></i>
                                <input id="replyFileInput" type="file" multiple hidden>
                            </label>
                            <label class="attach-btn"><i class="fas fa-image"></i>
                                <input id="replyImageInput" type="file" accept="image/*" multiple hidden>
                            </label>
                            <button id="emojiBtn" type="button"><i class="far fa-smile"></i></button>
                            <div id="emojiPicker" class="emoji-picker"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- COMPOSE MODAL -->
    <div id="composeModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>New Message</h3>
                <button id="closeComposeBtn" type="button"><i class="fas fa-times"></i></button>
            </div>
            <div class="compose-body">
                <input id="composeTo"      type="email" placeholder="To">
                <input id="composeSubject" type="text"  placeholder="Subject">
                <textarea id="composeMessage" rows="10" placeholder="Write your message…"></textarea>
            </div>
            <div class="modal-actions">
                <button id="discardComposeBtn" type="button" class="btn-secondary">Discard</button>
                <button id="sendComposeBtn"    type="button" class="btn-primary"><i class="fas fa-paper-plane"></i> Send</button>
            </div>
        </div>
    </div>

    <div id="notificationContainer" class="toast-container"></div>
</div>

<!-- Seed real DB rows into the page for the JS to consume -->
<script id="messages-data" type="application/json">
<?= json_encode($messages, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>
</script>
<script>
    window.CURRENT_ADMIN = {
        name:  <?= json_encode(UserModel::getCurrentAdmin()) ?>,
        email: 'admin@chmstore.edu.ph',
    };
</script>
<script src="js/admin_contacts.js"></script>
</body>
</html>