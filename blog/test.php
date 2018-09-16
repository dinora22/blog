<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" href="style/normalize.css">
    <!--link rel="stylesheet" href="style/main.css"-->
    <link rel="icon" href="/images/favico.ico" type="image/x-icon"/>
	<style>
	 article{
		width:100%;
		max-width:1280px;
		margin:0 auto;
		}

		h1 {text-align:center;}
		
		img {
			 width: 100%;
			 height: auto;
		}
		
		.one {
			 background-color: #333;
			 min-width: 500px;
		}
		
		.two {background-color:#666}
		.three {background-color:#ccc}
		.float {
			 max-width: 350px;
			 float: left;
			 text-align: justify;
		}
	</style>
</head>
<body>

	<div id="wrapper">

	<article>
	  <h1>Responsive Layout with min and max width</h1>
	  <div class="one float">
	   	<img src="images/favicon.jpg">
	  </div>
	  <div class ="two float">Pellentesqueeleifendfacilisisodio ac 
	  ullamcorper. Nullamutenimutmassatinciduntluctus...
 	  </div>
	  <div class="three float">Pellentesqueeleifendfacilisisodio ac 
	  ullamcorper. Nullamutenimutmassatinciduntluctus. Utnullalibero, ...
	  </div>
	</article>

	</div>


</body>
</html>
