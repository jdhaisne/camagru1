<?php
session_start();
if($_COOKIE['pseudo'] && $_COOKIE['pass_hash'])
{
	include('login_get.php');
	login($_COOKIE['pseudo'], $_COOKIE['pass_hash']);
}
else
{
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="camagru.css">
		<title>camagru</title>
	</head>
	<body id="login">
<?php include('header.php');?>
		<div class="form" style="height: 20%;">
		<h1>login</h1>
			<?php if(preg_match("#bf#", $_GET['error']))
				echo "<span class=\"error\">You must specifie all information </span>";?>
			<form method="post" action="login_post.php">
				<p>
					<span class="form_txt">Pseudo :<input type="text" name="pseudo" /></span>
					<br />
					<span class="form_txt">Password :<input type='password' name='password' /></span>
					<br />
					<label for="case" classe="form_txt">Auto login :</label> <input type="checkbox" name='auto_login' id="case" />
					<br />
					<input type="submit" name="submit" />
				</p>
			</form>
					<br />
			<span>Need an account ? <a href="register_view.php">register</a></span>
		</div>
	</body>
</html>
<?php
}
?>
