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

$login = $_GET['log'];
$cle = $_GET['cle'];

$bdd = connect_to_bdd();
$req = $bdd->prepare('SELECT actif, cle
						FROM membre
						WHERE pseudo = :pseudo');
$req->execute(array('pseudo' => $login));
$result = $req->fetch();
$clebdd = $result['cle'];
$actif = $result['actif'];
$req->closeCursor();

if($actif)
{
	echo 'vous aves deja verifier votre mail';
}
else
{
	if($cle = $clebdd)
	{
		echo 'votre compte a bie ete active';
	$req = $bdd->prepare('UPDATE membre
					SET actif = 1
					WHERE pseudo = :pseudo');
	$req->execute(array('pseudo' => $login));
	
	}
	else
	{
		echo 'erreur verif';
	}
}
?>
