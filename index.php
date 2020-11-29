<?php

session_start();
	
# Database connection
include ("DB.php");

# Variables MUST BE INTEGERS
if(isset($_GET['menu'])) { $menu   = (int)$_GET['menu']; }
if(isset($_GET['action'])) { $action   = (int)$_GET['action']; }

# Variables MUST BE STRINGS A-Z
if(!isset($_POST['_action_']))  { $_POST['_action_'] = FALSE;  }

if (!isset($menu)) { $menu = 1; }

# Classes & Functions
include_once("functions.php");

print '
<!DOCTYPE html>
<html>
<head>
		
    <link rel="stylesheet" href="styles.css">
    <title>Blue Cross - greenfarm animal sanctuary</title>

    <meta name="author" content="Monika Zerec">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <!-- <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="description" content="Web za Blue Cross">
    <meta name="keywords" content=""> -->
</head>
<body>
	<header>
		<div';
		if ($menu > 1) { print ' class="animals-two" '; } else { print ' class="animals-one" '; }  print '></div>';
			include("menu.php");
        print'
	</header>
	<main>';
			if (isset($_SESSION['message'])) {
				print $_SESSION['message'];
				unset($_SESSION['message']);
			}

		# Homepage
		if (!isset($menu) || $menu == 1) { include("home.php"); }

		# News
		else if ($menu == 2) { include("news.php"); }

		# Contact
		else if ($menu == 3) { include("contact.php"); }

		# About us
		else if ($menu == 4) { include("about.php"); }

		# Register
		else if ($menu == 5) { include("register.php"); }

		# Signin
		else if ($menu == 6) { include("signin.php"); }

		# Admin webpage
		else if ($menu == 7) { include("admin.php"); }
	print '
	</main>
	<footer>
		<p>Copyright &copy; ' . date("Y") . ' Monika Zerec. <a href="https://github.com/zerkiZerki?tab=repositories"><img src="img/Octocat.png" title="Github" alt="Github"></a></p>
	</footer>
</body>
</html>';
?>