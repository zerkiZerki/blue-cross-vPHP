<?php 
	print '
	<ul>
		<li><a href="index.php?menu=1">Početna</a></li>
		<li><a href="index.php?menu=2">Vijesti</a></li>
		<li><a href="index.php?menu=3">Kontakt</a></li>
		<li><a href="index.php?menu=4">O nama</a></li>';
		if (!isset($_SESSION['users']['valid']) || $_SESSION['users']['valid'] == 'false') {
			print '
			<li><a href="index.php?menu=5">Registracija</a></li>
			<li><a href="index.php?menu=6">Prijava</a></li>';
		}
		else if ($_SESSION['users']['valid'] == 'true') {
			print '
			<li><a href="index.php?menu=7">Admin panel</a></li>
			<li><a href="signout.php">Odjavi se</a></li>';
		}
		print '
	</ul>';
?>