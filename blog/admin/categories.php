<?php require_once('../includes/admin-partials.php'); ?>

	<div id="pagewrap">

	<?php 
	//show message from add / edit page
	if(isset($_GET['action'])){ 
		echo '<h3 class="message">Category '.$_GET['action'].'.</h3>'; 
	} 
	?>
	
	<p style="text-align:right;">
		<a href='add-category.php'><button class="button-secondary pure-button">Add Category</button></a>
	</p>
	
	<table>
	  <thead>
		<tr>
		  <th>Title</th>
		  <th>Action</th>
		</tr>
	  </thead>

	<?php
		try {

			$stmt = $db->query('SELECT catID, catTitle, catSlug FROM blog_cats ORDER BY catTitle DESC');
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['catTitle'].'</td>';
				?>

				<td>
					<a href="edit-category.php?id=<?php echo $row['catID'];?>">Edit</a> | 
					<a href="javascript:delcat('<?php echo $row['catID'];?>','<?php echo $row['catSlug'];?>')">Delete</a>
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
