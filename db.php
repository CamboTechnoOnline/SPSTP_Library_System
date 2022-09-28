<?php   $servername = "localhost";  $database  = "library_spstp";  $user = "root";  $password = ""; 
 
 // Create connection   
 $conn = new mysqli($servername, $user, $password,$database);  $conn->set_charset("utf8");  
 // Check connection   
 if ($conn->connect_error) {    
 	die("Connection failed: " . $conn->connect_error);   
 }  
 
 ?> 

 
 