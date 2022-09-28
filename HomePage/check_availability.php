<?php 
require_once("../db.php");
// code user email availablity
if(!empty($_POST["username"])) {
	$username= $_POST["username"];
	$sql ="SELECT * FROM tblstudent WHERE username ='$username'";
	$result = $conn->query($sql); 
	$row=$result->fetch_assoc();
	if(mysqli_num_rows($result) > 0){
		echo "<span style='color:red'> ឈ្មោះគណនីនេះមានក្នុងប្រព័ន្ធហើយ .</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	}else{
		echo "<span style='color:green'> ឈ្មោះគណនីត្រឹមត្រូវ .</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
	

}

?>
