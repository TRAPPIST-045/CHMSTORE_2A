<?php
require '../controller/Controller.php';
UserModel::logout();
header('Location: '.LOGIN_PAGE);
exit;
