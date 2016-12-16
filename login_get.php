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
function auto_log_cookie($pseudo, $pass_hash)
{
setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true);
setcookie('pass_hash', $pass_hash, time() + 365*24*3600, null, null, false, true);
}
function login($pseudo, $pass_hash)
{
	$bdd = connect_to_bdd();
	$req = $bdd->prepare('SELECT id, actif FROM membre WHERE pseudo = :pseudo AND password = :pass');
	$req->execute(array(
		'pseudo' =>$pseudo,
		'pass' => $pass_hash
	));
	$result = $req->fetch();
	if(!$result)
	{
		echo 'wrong name or password';
		return false;
	}
	else if ($result['actif'] == 0)
	{
		echo 'you must validate your account before login in';
		return false;
	}
	else
	{
		session_start();
		$_SESSION['id'] = $result['id'];
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['logged'] = 1;
		echo 'log';
		//go to home
		return true;
	}

}
?>
