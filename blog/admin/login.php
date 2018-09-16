<?php
//include config
require_once('../includes/config.php');


//check if already logged in
if( $user->is_logged_in() ){ header('Location: index.php'); } 
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
  <link href="../style/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="pagewrap">

		<?php

		//process login form if submitted
		if(isset($_POST['submit'])){

			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			
			if($user->login($username,$password)){ 

				//logged in return to index page
				header('Location: index.php');
				exit;
			

			} else {
				$message = '<p class="message-error">Wrong username or password!</p>';
			}

		}//end if submit

		if(isset($message)){ echo $message; }
		?>
	<div class="widget" style="margin:120px; width:445px">
		<form class="pure-form pure-form-aligned" action="" method="post">
			<fieldset style="background-color:#34495E">
				<div style="background-image: url('/images/admin.png');background-repeat: no-repeat; height: 47px;margin-left: 75px;" class="pure-control-group center"></div>
				<div class="pure-control-group">
					<label for="name">Username</label>
					<input name="username" id="name" type="text" placeholder="Username">
				</div>

				<div class="pure-control-group">
					<label for="password">Password</label>
					<input name="password" id="password" type="password" placeholder="Password">
				</div>

				<div class="pure-controls">
					<button type="submit" name="submit" class="pure-button">Submit</button>
				</div>
			</fieldset>
		</form>	
	</div>
</div>
</body>
</html>
