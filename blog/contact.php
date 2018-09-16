<?php require('includes/config.php'); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- disable iPhone inital scale -->
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<title>Blog</title>
	<!-- main css -->
	<link href="style/style.css" rel="stylesheet" type="text/css">

	<!-- media queries css -->
	<link href="style/media-queries.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel="icon" href="/images/favico.ico" type="image/x-icon"/>
	<!-- html5.js for IE less than 9 -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- css3-mediaqueries.js for IE less than 9 -->
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<script>
			$(function() {
				var pull 		= $('#pull');
					menu 		= $('nav ul');
					menuHeight	= menu.height();

				$(pull).on('click', function(e) {
					e.preventDefault();
					menu.slideToggle();
				});

				$(window).resize(function(){
					var w = $(window).width();
					if(w > 320 && menu.is(':hidden')) {
						menu.removeAttr('style');
					}
				});
			});
	</script>
</head>
<!--
<body background="images/bg.jpg">
-->
<body background="images/bg.jpg" style="background-image: url('images/mosaic-background.png');
											background-repeat: no-repeat;
											background-attachment: fixed;
											background-position: center;
											background-size: 100%" >

<div id="pagewrap">

	<header id="header">

<!--
		<hgroup>
			<h1 id="site-logo"><a href="#"><img width="60px" src="/images/favico.ico"></a></h1>
		</hgroup>
-->

		<nav>
			<ul id="main-nav" class="clearfix">
				<li><a href="http://webdesignerwall.com">Home</a></li>
				<li><a href="#">About us</a></li>
				<li><a href="contact.php">Contact</a> </li>
				<li><a href="#">Design</a></li>
				<li><a href="#">Info</a></li>
			</ul>
		</nav>

		
		<form id="searchform">
			<input type="search" id="s" placeholder="Search">
		</form>

	</header>
	<!-- /#header -->
	
	<div id="content">
		<!-- Contact form -->
		<form class="form-horizontal" role="form" method="post" action="index.php">
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
					<?php echo "<p class='text-danger'>$errName</p>";?>
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
					<?php echo "<p class='text-danger'>$errEmail</p>";?>
				</div>
			</div>
			<div class="form-group">
				<label for="message" class="col-sm-2 control-label">Message</label>
				<div class="col-sm-10">
					<textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
					<?php echo "<p class='text-danger'>$errMessage</p>";?>
				</div>
			</div>
			<div class="form-group">
				<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
					<?php echo "<p class='text-danger'>$errHuman</p>";?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<?php echo $result; ?>	
				</div>
			</div>
		</form> 
		<!-- end Contact form -->

	</div>
	<!-- /#content --> 
	
	
	<aside id="sidebar">

		<section class="widget">
			<h4 class="widgettitle">Sidebar</h4>
			<?php require('sidebar.php'); ?>
		</section>
		<!-- /.widget -->

	</aside>
	<!-- /#sidebar -->

	<footer id="footer">
		<p>Tutorial by <a href="http://webdesignerwall.com">Web Designer Wall</a></p>
	</footer>
	<!-- /#footer --> 
	
</div>
<!-- /#pagewrap -->

</body>
</html>
