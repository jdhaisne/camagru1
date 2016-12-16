<html>
	<head>
		<link rel="stylesheet" type="text/css" href="camagru.css">
		<title>camagru</title>
	<head>
	<body>
		<?php include('header.php');?>
						<!-- formulaire pour s'enregistrer --!>
		<?php if (preg_match('#bf#', $_GET['error']))
			echo '<span class="error">You must specifie all information</span>';?>
		<div class="form">
			<h1>Register</h1>
			<form method="post" action="register_post.php">
				<p>
					pseudo <input type='text' name='pseudo' />
					<?php if (preg_match('#p#', $_GET['error']))
						echo "<span class=\"error\">pseudo took</span>";?>
					<br />
					password <input type='password' name='password' />
					<br />
					verify password <input type='password' name='verify_pass' />
					<?php if (preg_match('#v#', $_GET['error']))
						echo "<span class=\"error\">verification password doesn't match password</span>";?>
					<br />
					e-mail<input type='text' name='mail' />
					<?php if (preg_match('#bm#', $_GET['error']))
						echo "<span class=\"error\">not a valid mail address</span>";
					else if (preg_match('#mt#', $_GET['error']))
						echo "<span class=\"error\">mail took</span>";?>
					<br />
					<input type='submit' name='submit' />
				</p>
			</form>
		</div>
	</body>
</html>
