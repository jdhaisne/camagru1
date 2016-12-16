<?php
function send_verif_mail($mail, $pseudo, $cle)
{
$desinataire = $mail;
$sujet = 'account verification';
$mail_header = 'MIME-Version: 1.0' . "\r\n";
$mail_header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"	;
$mail_header .= 'verification@camagru.fr';
$message = 'Welcome to the camagru familly,\n
\n
to become a complete member of our familly you need to click this link or copy/paste it on your web browser.\n
 <a href="http://localhost:8080/camagru1/verification.php?log='.urlencode($pseudo).'&cle='.urlencode($cle).'">http://localhost:8080/camagru1/verification.php?log='.urlencode($pseudo).'&cle='.urlencode($cle).'</a>.
\n
\n
------------------------
this is an auto-send mail do not respond.';
mail($desinataire, $sujet, $message, $mail_header);
}
function form_is_complete()
{
	if(trim($_POST['pseudo']) == "" || trim($_POST['password']) == "" || trim($_POST['verify_pass']) == "" || trim($_POST['mail']) == "")
		return false;
	else
		return true;
}

include ("register_get.php");
include_once('membre.class.php');
include_once('membreManager.class.php');
$pseudo = htmlspecialchars($_POST['pseudo']);
$password = htmlspecialchars($_POST['password']);
$verify_pass = htmlspecialchars($_POST['verify_pass']);
$mail = htmlspecialchars($_POST['mail']);
$error = "";

$membre = new Membre([
	'pseudo' => $_POST['pseudo'],
	'password' => $_POST['password'],
	'mail' => $_POST['mail'],
	'cle' => md5(microtime(TRUE) * 100000),
	'actif' => 0]);

if(form_is_complete()) {
	$bdd = connect_to_bdd();
	if(!pseudo_is_free($pseudo, 'pseudo', $bdd))
	{
		//error
		$error = $error."p"; //p = Pseudo took
	}
	if($password !== $verify_pass)
	{
		//error
		$error = $error."v"; // v = bad pass Verification
	}
	if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail))
	{
		//error
		$error = $error."bm"; // bm = Bad Mail
	}
	if(!mail_is_free($mail, $bdd))
	{
		//error
		$error = $error."mt"; // mt = Mail Took
	}
	if($error == "")
	{
		$cle = md5(microtime(TRUE) * 100000);
		add_member($pseudo, sha1($password), $mail, $cle, $bdd);
		send_verif_mail($mail, $pseudo, $cle);
		echo "ok"; //go to home
	}
	else
		header('location:register_view.php?error='.$error);
}
else{
		header('location:register_view.php?error=bf'); //bf = Bad Form
}
