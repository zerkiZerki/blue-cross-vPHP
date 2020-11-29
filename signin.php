<?php 
	print '
	<h1>Prijava</h1>
	<div id="signin">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" name="myForm" id="myForm" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			<label for="username">Username:*</label>
			<input type="text" id="username" name="username" value="" pattern=".{5,10}" required>
									
			<label for="password">Password:*</label>
			<input type="password" id="password" name="password" value="" pattern=".{4,}" required>
									
			<input type="submit" value="Prijavi se">
		</form>';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM users";
		$query .= " WHERE username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if (password_verify($_POST['pass'], $row['pass'])) {
			#password_verify https://secure.php.net/manual/en/function.password-verify.php
			$_SESSION['users']['valid'] = 'true';
			$_SESSION['users']['id'] = $row['id'];
			# 1 - administrator; 2 - editor; 3 - user
			$_SESSION['users']['role'] = $row['role'];
			$_SESSION['users']['firstname'] = $row['firstname'];
			$_SESSION['users']['lastname'] = $row['lastname'];
			$_SESSION['message'] = '<p>Dobrodošli, ' . $_SESSION['users']['firstname'] . ' ' . $_SESSION['users']['lastname'] . '</p>';
			# Redirect to admin website
			header("Location: index.php?menu=7");
		}
		
		# Bad username or password
		else {
			unset($_SESSION['users']);
			$_SESSION['message'] = '<p>Krivi e-mail ili lozinka!</p>';
			header("Location: index.php?menu=6");
		}
	}
	print '
	</div>';
?>