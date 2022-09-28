<?php  
session_start();
include "../db.php";

if (isset($_POST['txtu']) && isset($_POST['txtp'])) {

	$username = $_POST['txtu'];
	$password = md5($_POST['txtp']);

	if (empty($username)) {
		header("Location: ../login_student.php?error=សូមបញ្ចូលឈ្មោះគណនី");
	}else if (empty($password)) {
		header("Location: ../login_student.php?error=សូមបញ្ចូលលេខសម្ងាត់");
	}else{
		// Hashing the password
		$sql = "SELECT * FROM tblstudent WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $sql);
        $row=$result->fetch_assoc();
		if ($username==$row['username'] && $password==$row['password']){
				$_SESSION['username'] = $row['username'];
				echo("<script language=\"javascript\" >
					alert(\"ឈ្មោះគណនី និង​លេខសំងាត់មិនត្រឹមត្រូវ\");
					</script>");
				header("Location: ../student/dashboard.php?success");
			}else {
			header("Location: ../login_student.php?error=គណនីនិងលេខសម្ងាត់មិនត្រឹមត្រូវ");
		}

	}
	
}else {
	header("Location: ../index.php");
}