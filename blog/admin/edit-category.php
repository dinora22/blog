<?php require_once('../includes/admin-partials.php'); ?>

	<div id="pagewrap">

	<h2 class="top-style">Edit Category</h2>


	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($catID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($catTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if(!isset($error)){

			try {

				$catSlug = slug($catTitle);

				//insert into database
				$stmt = $db->prepare('UPDATE blog_cats SET catTitle = :catTitle, catSlug = :catSlug WHERE catID = :catID') ;
				$stmt->execute(array(
					':catTitle' => $catTitle,
					':catSlug' => $catSlug,
					':catID' => $catID
				));

				//redirect to index page
				header('Location: categories.php?action=updated');
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

			$stmt = $db->prepare('SELECT catID, catTitle FROM blog_cats WHERE catID = :catID') ;
			$stmt->execute(array(':catID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post'>
		<input type='hidden' name='catID' value='<?php echo $row['catID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='catTitle' value='<?php echo $row['catTitle'];?>'></p>

		<p><input type='submit' name='submit' value='Update'></p>

	</form>

</div>

</body>
</html>	
