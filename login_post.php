<?php
include ('login_get.php');
if(trim($_POST['pseudo']) == "" || trim($_POST['password']) == "")
{
	header('location:login.php?error=bf'); // bf = Bad Form
}
$pseudo = htmlspecialchars($_POST['pseudo']);
$password = htmlspecialchars($_POST['password']);
$password_hash = sha1($password);

if($_POST['auto_login'])
	auto_log_cookie($pseudo, $password_hash);
login($pseudo, $password_hash);
?>
