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
  <style>
  body{
		margin:0;
		color:#6a6f8c;
		background:#c8c8c8;
		font:600 16px/18px 'Open Sans',sans-serif;
	}
	*,:after,:before{box-sizing:border-box}
	.clearfix:after,.clearfix:before{content:'';display:table}
	.clearfix:after{clear:both;display:block}
	a{color:inherit;text-decoration:none}

	.login-wrap{
		width:100%;
		margin:auto;
		max-width:525px;
		min-height:670px;
		position:relative;
		background:url(https://raw.githubusercontent.com/khadkamhn/day-01-login-form/master/img/bg.jpg) no-repeat center;
		box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
	}
	.login-html{
		width:100%;
		height:100%;
		position:absolute;
		padding:90px 70px 50px 70px;
		background:rgba(40,57,101,.9);
	}
	.login-html .sign-in-htm,
	.login-html .sign-up-htm{
		top:0;
		left:0;
		right:0;
		bottom:0;
		position:absolute;
		transform:rotateY(180deg);
		backface-visibility:hidden;
		transition:all .4s linear;
	}
	.login-html .sign-in,
	.login-html .sign-up,
	.login-form .group .check{
		display:none;
	}
	.login-html .tab,
	.login-form .group .label,
	.login-form .group .button{
		text-transform:uppercase;
	}
	.login-html .tab{
		font-size:22px;
		margin-right:15px;
		padding-bottom:5px;
		margin:0 15px 10px 0;
		display:inline-block;
		border-bottom:2px solid transparent;
	}
	.login-html .sign-in:checked + .tab,
	.login-html .sign-up:checked + .tab{
		color:#fff;
		border-color:#1161ee;
	}
	.login-form{
		min-height:345px;
		position:relative;
		perspective:1000px;
		transform-style:preserve-3d;
	}
	.login-form .group{
		margin-bottom:15px;
	}
	.login-form .group .label,
	.login-form .group .input,
	.login-form .group .button{
		width:100%;
		color:#fff;
		display:block;
	}
	.login-form .group .input,
	.login-form .group .button{
		border:none;
		padding:15px 20px;
		border-radius:25px;
		background:rgba(255,255,255,.1);
	}
	.login-form .group input[data-type="password"]{
		text-security:circle;
		-webkit-text-security:circle;
	}
	.login-form .group .label{
		color:#aaa;
		font-size:12px;
	}
	.login-form .group .button{
		background:#1161ee;
	}
	.login-form .group label .icon{
		width:15px;
		height:15px;
		border-radius:2px;
		position:relative;
		display:inline-block;
		background:rgba(255,255,255,.1);
	}
	.login-form .group label .icon:before,
	.login-form .group label .icon:after{
		content:'';
		width:10px;
		height:2px;
		background:#fff;
		position:absolute;
		transition:all .2s ease-in-out 0s;
	}
	.login-form .group label .icon:before{
		left:3px;
		width:5px;
		bottom:6px;
		transform:scale(0) rotate(0);
	}
	.login-form .group label .icon:after{
		top:6px;
		right:0;
		transform:scale(0) rotate(0);
	}
	.login-form .group .check:checked + label{
		color:#fff;
	}
	.login-form .group .check:checked + label .icon{
		background:#1161ee;
	}
	.login-form .group .check:checked + label .icon:before{
		transform:scale(1) rotate(45deg);
	}
	.login-form .group .check:checked + label .icon:after{
		transform:scale(1) rotate(-45deg);
	}
	.login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
		transform:rotate(0);
	}
	.login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
		transform:rotate(0);
	}

	.hr{
		height:2px;
		margin:60px 0 50px 0;
		background:rgba(255,255,255,.2);
	}
	.foot-lnk{
		text-align:center;
	}
	  
  </style>
</head>
<body>

<div id="pagewrap">

		<?php
		//process login form if submitted
		if(isset($_POST['submit'])){

			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			$email = trim($_POST['email']);
			
			if($user->login($username,$password)){ 
				//logged in return to index page
				header('Location: index.php');
				exit;
			
			} else {
				$message = '<p class="message-error">Wrong username or password!</p>';
			}

		}//end if submit
		else if(isset($_POST['signup'])){
			//collect form data
			extract($_POST);
			var_dump($_POST);
			echo "signing up";

			//~ if(!isset($error)){ 
				$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

				try {
					//insert into database
					$stmt = $db->prepare('INSERT INTO blog_members (username,password,email) VALUES (:username, :password, :email)') ;
					echo $stmt;
					$stmt->execute(array(
										':username' => $_POST['username'],
										':password' => $_POST['password'],
										':email' => $_POST['email']
									));

					//redirect to index page
					//header('Location: users.php?action=added');
					exit;

				} catch(PDOException $e) {
					echo $e->getMessage();
				}

			//~ }
			
		}
		

		if(isset($message)){ echo $message; }
		?>
		

<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
        <div class="login-form">
			<!--SIGN IN-->
			<form action="" method="post">
				<div class="sign-in-htm">
					<div class="group">
						<label for="user" class="label">Username</label>
						<input id="user" name="username" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="pass" name="password" type="password" class="input" data-type="password">
					</div>
					<div class="group">
						<input id="check" type="checkbox" class="check" checked>
						<label for="check"><span class="icon"></span> Keep me Signed in</label>
					</div>
					<div class="group">
						<input type="submit" name="submit" class="button" value="Sign In">
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<a href="#forgot">Forgot Password?</a>
					</div>
				</div>
			</form>
			
			<!--SIGN UP-->
			<form action="" method="post">
				<div class="sign-up-htm">
					<div class="group">
						<label for="user" class="label">Username</label>
						<input name="username" id="user" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="pass" name="password" type="password" class="input" data-type="password">
					</div>
					<div class="group">
						<label for="pass" class="label">Repeat Password</label>
						<input id="pass" name="passwordConfirm" type="password" class="input" data-type="password">
					</div>
					<div class="group">
						<label for="pass" class="label">Email Address</label>
						<input id="pass" name="email" type="text" class="input">
					</div>
					<div class="group">
						<input type="submit" name="signup" class="button" value="Sign Up">
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<label for="tab-1">Already Member?</a>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>
		
	
</div>
</body>
</html>
