<?php
ob_start();
session_start();

include('functions.php');

$servername = "localhost";
$user = "blog_bootstrap";
$pass = "1234";

// Create connection
//$db = new mysqli($servername, $username, $password);
$db = new PDO('mysql:host=localhost;dbname=blog_bootstrap', $user, $pass);



//set timezone
date_default_timezone_set('Europe/London');

//load classes as needed
function __autoload($class) {
   
   $class = strtolower($class);
	//if call from within assets adjust the path
   $classpath = 'classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 	
	
	//if call from within admin adjust the path
   $classpath = '../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	}
	
	//if call from within admin adjust the path
   $classpath = '../../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 		
	 
}
$user = new User($db); 
?>
