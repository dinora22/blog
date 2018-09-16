<?php require_once('../includes/admin-partials.php'); ?>

	<div id="pagewrap">
	<h2 class="top-style">Edit Post</h2>


	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

			$_POST = array_map( 'stripslashes', $_POST );
	
		//collect form data
		extract($_POST);

		//very basic validation
		if($postID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)){

			try {

				$postSlug = slug($postTitle);

				//insert into database
				$stmt = $db->prepare('UPDATE blog_posts_seo SET postTitle = :postTitle, postSlug = :postSlug, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postSlug' => $postSlug,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postID' => $postID
				));

				//delete all items with the current postID
				$stmt = $db->prepare('DELETE FROM blog_post_cats WHERE postID = :postID');
				$stmt->execute(array(':postID' => $postID));

				if(is_array($catID)){
					foreach($_POST['catID'] as $catID){
						$stmt = $db->prepare('INSERT INTO blog_post_cats (postID,catID)VALUES(:postID,:catID)');
						$stmt->execute(array(
							':postID' => $postID,
							':catID' => $catID
						));
					}
				}

				//redirect to index page
				header('Location: index.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>


	<?php
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {

			$stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont FROM blog_posts_seo WHERE postID = :postID') ;
			$stmt->execute(array(':postID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post'>
		<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

		<p><label>Description</label><br />
		<textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p>

		<fieldset>
			<legend>Categories</legend>

			<?php

			$stmt2 = $db->query('SELECT catID, catTitle FROM blog_cats ORDER BY catTitle');
			while($row2 = $stmt2->fetch()){

				$stmt3 = $db->prepare('SELECT catID FROM blog_post_cats WHERE catID = :catID AND postID = :postID') ;
				$stmt3->execute(array(':catID' => $row2['catID'], ':postID' => $row['postID']));
				$row3 = $stmt3->fetch(); 

				if($row3['catID'] == $row2['catID']){
					$checked = 'checked=checked';
				} else {
					$checked = null;
				}

			    echo "<input type='checkbox' name='catID[]' value='".$row2['catID']."' $checked> ".$row2['catTitle']."<br />";
			}

			?>

		</fieldset>

		<p><input type='submit' name='submit' value='Update'></p>

		

	</form>

</div>

</body>
</html>	
