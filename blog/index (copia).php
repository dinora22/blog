<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <!-- disable iPhone inital scale -->
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" href="style/normalize.css">
    <!-- media queries css -->
	<link href="style/media-queries.css" rel="stylesheet" type="text/css">
	 <!-- main style css -->
    <link rel="stylesheet" href="style/main.css">
<!--
    <link rel="icon" href="/images/favico.ico" type="image/x-icon"/>
-->

</head>
<body>

<div id="pagewrap">
	<header id="header">
		<hgroup>
			<h1 id="site-logo"><a href="#">Blog</a></h1>
			<h2 id="site-description">Site Description</h2>
		</hgroup>
	</header>
	
	<!--NAVBAR-->
	<!--NAVBAR-->
	<div id='content'>
		<article class="post clearfix">
		
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
		</article>
	</div>

	<aside id='sidebar'>
		<section class="widget">
			<?php require('sidebar.php'); ?>
		</section>
	</aside>

	<footer id="footer">
		<p>Copyright @2016</p>
	</footer>

</div> <!-- /#pagewrap-->

</body>
</html>
