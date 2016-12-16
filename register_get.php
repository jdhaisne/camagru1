<?php
function connect_to_bdd()
{
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
	}
	catch(Exception $e)
	{
		die('Error : '.$e->getMessage());
	}
	return $bdd;
}
function pseudo_is_free($pseudo, $chpstest, $bdd)
{
	$member = $bdd->prepare('SELECT id, pseudo FROM membre WHERE pseudo = :pseudo');
	$member->execute(array(
		'pseudo' => $pseudo
	));
	$result = $member->fetch();
	if($result)
	{
		$member->closeCursor();
		return false;
	}
	$member->closeCursor();
	return true;
}
function mail_is_free($mail, $bdd)
{
	$req = $bdd->prepare('SELECT id, mail FROM membre WHERE mail = :mail');
	$req->execute(array(
		'mail' => $mail
	));
	$result = $req->fetch();
	if($result)
	{
		$req->closeCursor();
		return false;
	}
	$req->closeCursor();
	return true;
}
function add_member($pseudo, $pass_hash, $mail, $cle, $bdd)
{
	$req = $bdd->prepare('INSERT INTO membre(pseudo, password, mail, register_date, cle) VALUES( :pseudo, :password, :mail, CURDATE(), :cle)');
	$req->execute(array(
		'pseudo' => $pseudo,
		'password' => $pass_hash,
		'mail' => $mail,
		'cle' => $cle
	));
}
