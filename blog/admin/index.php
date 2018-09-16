<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['delpost'])){ 

	$stmt = $db->prepare('DELETE FROM blog_posts_seo WHERE postID = :postID') ;
	$stmt->execute(array(':postID' => $_GET['delpost']));

	//delete post categories. 
	$stmt = $db->prepare('DELETE FROM blog_post_cats WHERE postID = :postID');
	$stmt->execute(array(':postID' => $_GET['delpost']));

	header('Location: index.php?action=deleted');
	exit;
} 

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin</title>
	<link rel="stylesheet" href="../style/normalize.css">
	<!-- main css -->
	<link href="../style/style.css" rel="stylesheet" type="text/css">

	<!-- media queries css -->
	<link href="../style/media-queries.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel="icon" href="/images/favico.ico" type="image/x-icon"/>
	
	  <script language="JavaScript" type="text/javascript">
	  function delpost(id, title)
	  {
		  if (confirm("Are you sure you want to delete '" + title + "'"))
		  {
			window.location.href = 'index.php?delpost=' + id;
		  }
	  }
	  </script>
	  <style>


	  </style>
</head>
<body style="background-color:#F4F4F4">

	<div id="pagewrap" style="margin-top:40px;">

	<?php include('menu.php');?>

	<?php 
	//show message from add / edit page
	if(isset($_GET['action'])){ 
		echo '<h3 class="message">Post '.$_GET['action'].'.</h3>'; 
	} 
	?>
	</div>
	
	<div id="pagewrap">
	<div style="clear:both"></div>
	
<!--
	<p style="text-align:right;">
		<a href='add-post.php'><button class="button-secondary pure-button">Add Post</button></a>
	</p>
	
-->
	<table>
	  <thead>
		<tr>
		  <th>Title</th>
		  <th>Date</th>
		  <th>Action</th>
		</tr>
	  </thead>
	<?php
		try {

			$stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts_seo ORDER BY postID DESC');
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['postTitle'].'</td>';
				echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
				?>

				<td>
					<a href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> | 
					<a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
				</td>
				
				<?php 
				echo '</tr>';

			}

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	?>
	</table>

</div>

</body>
</html>
