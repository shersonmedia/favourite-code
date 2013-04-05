<?php
include_once('config.php');

// Reset errors and success messages
$errors = array();
$success = array();

// Login attempt
if(isset($_POST['loginSubmit']) && $_POST['loginSubmit'] == 'true'){
	$loginUsername = trim($_POST['username']);
	$loginPassword 	= trim($_POST['password']);
	
		
	if(strlen($loginUsername) < 6 || strlen($loginUsername) > 12)
		$errors['$loginUsername'] = 'Your username must be between 6-12 characters.';

	
	if(strlen($loginPassword) < 6 || strlen($loginPassword) > 12)
		$errors['loginPassword'] = 'Your password must be between 6-12 characters.';
	
	if(!$errors){
		$query 	= 'SELECT * FROM users WHERE user_name = "' . mysql_real_escape_string($loginUsername) . '" AND password = MD5("' . $loginPassword . '") LIMIT 1';
		$result = mysql_query($query);
		if(mysql_num_rows($result) == 1){
			$user = mysql_fetch_assoc($result);
			$query = 'UPDATE users SET session_id = "' . session_id() . '" WHERE user_id = ' . $user['user_id'] . ' LIMIT 1';
			mysql_query($query);
			header('Location: index.php');
			exit;
		}else{
			$errors['login'] = 'No user was found with the details provided.';
		}
	}
}

// Register attempt
if(isset($_POST['registerSubmit']) && $_POST['registerSubmit'] == 'true'){
	$registerUsername = trim($_POST['username']);
	$registerPassword = trim($_POST['password']);
	$registerConfirmPassword 	= trim($_POST['confirmPassword']);
	
	if(strlen($registerUsername) < 6 || strlen($registerUsername) > 12)	
		$errors['registerUsername'] = 'Your username must be between 6-12 characters.';
	
	if(strlen($registerPassword) < 6 || strlen($registerPassword) > 12)	
		$errors['registerPassword'] = 'Your password must be between 6-12 characters.';
	
	if($registerPassword != $registerConfirmPassword)
		$errors['registerConfirmPassword'] = 'Your passwords did not match.';
	
	// Check to see if we have a user registered with this username already
	$query = 'SELECT * FROM users WHERE user_name = "' . mysql_real_escape_string($registerUsername) . '" LIMIT 1';
	$result = mysql_query($query);
	if(mysql_num_rows($result) == 1) 
		$errors['registerUsername'] = 'This username already exists. Please choose an alternative';
	
	if(!$errors){
		$query = 'INSERT INTO users SET user_name = "' . mysql_real_escape_string($registerUsername) . '", 
		password = MD5("' . mysql_real_escape_string($registerPassword) . '"), 
		join_date = "' . date('Y-m-d H:i:s') . '"';
		
		if(mysql_query($query)){
			$success['register'] = 'Thank you for registering. You can now log in on the left.';
		}else{
			$errors['register'] = 'There was a problem registering you. Please check your details and try again.';
		}
	}
	
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>Login to the secure area</title>
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"/>
  <link rel="stylesheet" type="text/css" href="default.css"/>
</head>

<body>
  <header><h1>Login / Register Here</h1></header>
	
	<form class="box400" name="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<h2>Login</h2>
		<?php if($errors['login']) print '<div class="invalid">' . $errors['login'] . '</div>'; ?>
		
		<label for="username">User Name</label>
		<input type="text" name="username" value="<?php echo htmlspecialchars($loginUsername); ?>" />
		<?php if($errors['$loginUsername']) print '<div class="invalid">' . $errors['$loginUsername'] . '</div>'; ?>
		
		<label for="password">Password <span class="info">6-12 chars</span></label>
		<input type="password" name="password" value="" />
		<?php if($errors['loginPassword']) print '<div class="invalid">' . $errors['loginPassword'] . '</div>'; ?>
		
		<label for="loginSubmit">&nbsp;</label>
		<input type="hidden" name="loginSubmit" id="loginSubmit" value="true" />
		<input type="submit" value="Login" />
	</form>
	
	<form class="box400" name="registerForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<h2>Register</h2>
		<?php if($success['register']) print '<div class="valid">' . $success['register'] . '</div>'; ?>
		<?php if($errors['register']) print '<div class="invalid">' . $errors['register'] . '</div>'; ?>
		
		<label for="username">User Name</label>
		<input type="text" name="username" value="<?php echo htmlspecialchars($registerUsername); ?>" />
		<?php if($errors['registerUsername']) print '<div class="invalid">' . $errors['registerUsername'] . '</div>'; ?>
		
		<label for="password">Password</label>
		<input type="password" name="password" value="" />
		<?php if($errors['registerPassword']) print '<div class="invalid">' . $errors['registerPassword'] . '</div>'; ?>
		
		<label for="confirmPassword">Confirm Password</label>
		<input type="password" name="confirmPassword" value="" />
		<?php if($errors['registerConfirmPassword']) print '<div class="invalid">' . $errors['registerConfirmPassword'] . '</div>'; ?>
		
		<label for="registerSubmit">&nbsp;</label>
		<input type="hidden" name="registerSubmit" id="registerSubmit" value="true" />
		<input type="submit" value="Register" />
	</form>
</body>
</html>