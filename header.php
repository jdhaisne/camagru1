<header>
	<ul class="menu">
		<li class="menu"><a class="menu" href="home.php">home</a></li>
		<li class="menu"><a class="menu" href="photo.php">Take a pictures</a></li>
		<li class="menu"><a class="menu" href="galerie.php">Gallerie</a></li>
		<li class="menu_right">
			<?php if($_SESSION['logged'] == 1)
				echo '<a class="menu_right" href="profile.php">Your profile</a>';
			else
				echo '<a class="menu_right" href="login.php">Login</a>';
			?>
</li>
	</ul>
</header>
