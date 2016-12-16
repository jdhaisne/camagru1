<?php
include_once('membre.class.php');
include_once('membreManager.class.php');

$membre1 = new Membre([
	'pseudo' => 'julien',
	'password' => sha1(caca),
	'mail' => 'jdhaisne@hotmail.fr',
	'cle' => md5(microtime(TRUE) * 100000),
	'actif' => 0]);

$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
$manager = new MembreManager($bdd);
$manager->add($membre1);
?>
