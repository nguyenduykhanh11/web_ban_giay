<?php
session_start();

require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

$user = getUserToken();
if($user != null) {
	$token = getCookie('phien');
	$id = $user['id'];
	$sql = "delete from Tokens where user_id = '$id' and token = '$token'";
	execute($sql);
	setcookie('token', '', time() - 100, '/');
}
header('Location: ../../index.php');

session_destroy();