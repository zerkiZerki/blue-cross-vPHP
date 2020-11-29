<?php
	# Stop Hacking attempt
    define('__APP__', TRUE);

	# Start session
	session_start();
	
	
	unset($_POST);
	unset($_SESSION['users']);

	$_SESSION['users']['valid'] = 'false';
	$_SESSION['message'] = '<p>Uspješno ste se odjavili!</p><hr>';
	
	header("Location: index.php?menu=1");
	exit;