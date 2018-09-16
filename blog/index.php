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

		<hgroup>
			<h1 id="site-logo"><a href="#"><img width="60px" src="/images/favico.ico"></a></h1>
<!--
			<h2 id="site-description">My Blog</h2>
-->
		</hgroup>

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

		<article class="post clearfix">

			<!--header>
				<h1 class="post-title"><a href="#">Just a Post Title</a></h1>
				<p class="post-meta"><time class="post-date" datetime="2011-05-08" pubdate>May 8, 2011</time> <em>in</em> <a href="#">Category</a></p>
			</header-->
			
			<?php
				try {

					$stmt = $db->query('SELECT postID, postTitle, postSlug, postDesc, postDate FROM blog_posts_seo ORDER BY postID DESC');
					while($row = $stmt->fetch()){

							echo '<h1><a href="'.$row['postSlug'].'">'.$row['postTitle'].'</a></h1>';
							echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).' in ';

								$stmt2 = $db->prepare('SELECT catTitle, catSlug	FROM blog_cats, blog_post_cats WHERE blog_cats.catID = blog_post_cats.catID AND blog_post_cats.postID = :postID');
								$stmt2->execute(array(':postID' => $row['postID']));

								$catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);

								$links = array();
								foreach ($catRow as $cat)
								{
									$links[] = "<a href='c-".$cat['catSlug']."'>".$cat['catTitle']."</a>";
								}
								echo implode(", ", $links);

							echo '</p>';
							echo '<p>'.$row['postDesc'].'</p>';				
							echo '<p><a href="'.$row['postSlug'].'">Read More</a></p>';
					}

				} catch(PDOException $e) {
					echo $e->getMessage();
				}
			?>
			
			
			<figure class="post-image"> 
				<img src="images/sample-image.jpg" /> 
			</figure>
			<p>Fusce ut sem est. In eu sagittis felis. In gravida arcu ut neque ornare vitae rutrum turpis vehicula. Nunc ultrices sem mollis metus rutrum non malesuada metus fermentum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque interdum rutrum quam, a pharetra est pulvinar ac. Vestibulum congue nisl magna. Ut vulputate odio id dui convallis in adipiscing libero condimentum. Nunc et pharetra enim. Praesent pharetra, neque et luctus tempor, leo sapien faucibus leo, a dignissim turpis ipsum sed libero. Sed sed luctus purus. Aliquam faucibus turpis at libero consectetur euismod. Nam nunc lectus, congue non egestas quis, condimentum ut arcu. Nulla placerat, tortor non egestas rutrum, mi turpis adipiscing dui, et mollis turpis tortor vel orci. Cras a fringilla nunc. Suspendisse volutpat, eros congue scelerisque iaculis, magna odio sodales dui, vitae vulputate elit metus ac arcu. Mauris consequat rhoncus dolor id sagittis. Cras tortor elit, aliquet quis tincidunt eget, dignissim non tortor.</p>

			<h3>Vimeo Video</h3>
			<div class="video">
				<iframe src="http://player.vimeo.com/video/6284199" width="550" height="400" frameborder="0"></iframe>
			</div>

		</article>
		<!-- /.post -->

	</div>
	<!-- /#content --> 
	
	
	<aside id="sidebar">

		<section class="widget">
			<h4 class="widgettitle">Sidebar</h4>
			<?php require('sidebar.php'); ?>
<!--
			<ul>
				<li><a href="#">WordPress</a> (3)</li>
				<li><a href="#">Design</a> (23)</li>
				<li><a href="#">Design </a>(18)</li>
			</ul>
-->
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
