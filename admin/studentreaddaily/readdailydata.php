<?php 
include '../../db.php';
if($_GET['data']=='get-studentread'){    
	$sql = "SELECT tblstureaddaily.id,tblstureaddaily.studentid,tblstudent.username,tblbook.bookid,tblbook.booktitle,tblstureaddaily.date,tbl_year.studyyear,tblclass.classname FROM tblstureaddaily INNER JOIN tblstudent ON tblstudent.studentid=tblstureaddaily.studentid INNER JOIN tblbook ON tblbook.bookid=tblstureaddaily.bookid INNER JOIN tbl_year ON tbl_year.id=tblstureaddaily.yearid INNER JOIN tblclass ON tblstureaddaily.classid=tblclass.classid";
	$result = $conn->query($sql); 
	while($row=$result->fetch_assoc()){
		$option = '<a href="#" id="studentread_'.$row['id'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editStudentRead('. $row['id'] .');">កែប្រែ</a>'; 

		$stureaddata[] = array($row['id'],$row['studentid'],$row['username'],$row['bookid'],$row['booktitle'], $row['date'],$row['classname'],$row['studyyear'],$option); 
	} 

	echo json_encode($stureaddata);   
}

//2-Add New StudentRead   
if($_GET['data']=='addstudentread'){ 
	try{  
		$studentid = strtoupper($_GET["txtstudentid"]);
		$bookid = $_GET["txtbookid"];
		$class = $_GET["txtclass"];
		$year = $_GET["txtyear"];        
		$sql = "INSERT INTO tblstureaddaily (id,studentid,bookid,classid,yearid) VALUES (null,'$studentid',$bookid,$class,$year);";     
		if($conn->query($sql) == true){      
			echo json_encode($conn->insert_id);     
		}    
	}catch(Exception $e) {     
		die($e->getMessage());    
	}   
}

//3-Get Book By ID   
if($_GET['data']=='get-stureadat'){ 
	$output='';   
	$sql = "SELECT tblstureaddaily.studentid,tblstudent.username,tblbook.bookid,tblbook.booktitle,tblstureaddaily.yearid,tblclass.classid FROM tblstureaddaily INNER JOIN tblstudent ON tblstudent.studentid=tblstureaddaily.studentid INNER JOIN tblbook ON tblbook.bookid=tblstureaddaily.bookid INNER JOIN tbl_year ON tbl_year.id=tblstureaddaily.yearid INNER JOIN tblclass ON tblstureaddaily.classid=tblclass.classid WHERE tblstureaddaily.id=?;";    
	$stmt = $conn->prepare($sql);    
	$stmt->bind_param("i",$id);    
	$id = $_GET["id"];    
	$stmt->execute();    
	$result = $stmt->get_result();   
	if($row=$result->fetch_assoc()){      
		$bookdata[] = array(
			$row['studentid'], 
			$row['username'], 
			$row['bookid'],
			$row['booktitle'],
			$row['classid'],
			$row['yearid']
		);    
	}    
	echo json_encode($bookdata);   
}

 //5-Update Student Read 
if($_GET['data']=='updatestudentread'){    
	try{ 
		$id = $_GET["id"];
		$studentid = strtoupper($_GET["txtstudentid"]);
		$bookid = $_GET["txtbookid"];
		$class = $_GET["txtclass"];
		$year = $_GET["txtyear"];      
		$sql = "UPDATE tblstureaddaily SET 
		studentid='$studentid',
		bookid=$bookid,
		classid=$class,
		yearid=$year
		WHERE tblstureaddaily.id=$id; ";     
		if($conn->query($sql) == true){      
			echo "success";     
		}    
	}catch(Exception $e) {     
		die($e->getMessage());    
	}   
} 

//get book title to select box auto
if(!empty($_POST["bookid"])) {
	$bookid= strtoupper($_POST["bookid"]);
	$output='';
	$sql=("SELECT * FROM tblbook WHERE bookid='$bookid'");
	$result = $conn->query($sql);
	if(mysqli_num_rows($result) > 0){
		while($row=$result->fetch_assoc()){
			$output.='<option value="" >'.$row['booktitle'].'</option>';
			$output.="<script>$('#btnsubmit').prop('disabled',false);</script>";
		}
	}else{
		$output.='<option value="" >លេខកូខមិនត្រឹមត្រូវ</option>';
		$output.="<script>$('#btnsubmit').prop('disabled',true);</script>";
	}	
	echo $output;
}

//get student to select box auto
if(!empty($_POST["studentid"])) {
	$studentid= strtoupper($_POST["studentid"]);
	$output='';
	$sql=("SELECT * FROM tblstudent WHERE studentid='$studentid'");
	$result = $conn->query($sql);
	if(mysqli_num_rows($result) > 0){
		while($row=$result->fetch_assoc()){
			if($row['status'] == 0) {
				$output.='<option value="" >ត្រូវបានផ្អាកដំណើរការ</option>';
				$output.="<script>$('#btnsubmit').prop('disabled',true);</script>";
				$output.="<script>$('#txtbookid').prop('disabled',true);</script>";
			}else if($row['status'] == 1){
				$output.='<option value="" >'.$row['username'].'</option>';
				$output.="<script>$('#btnsubmit').prop('disabled',false);</script>";
				$output.="<script>$('#txtbookid').prop('disabled',false);</script>";
			}
		}
	}else{
		$output.='<option value="" >លេខកូខមិនត្រឹមត្រូវ</option>';
		$output.="<script>$('#btnsubmit').prop('disabled',true);</script>";
		$output.="<script>$('#txtbookid').prop('disabled',true);</script>";
	}
	echo $output;
}


if($_GET['data']=='get-studentcout'){    
	$sql = "SELECT tblstureaddaily.id,tblstureaddaily.date,tblstureaddaily.studentid,COUNT(tblstureaddaily.studentid) AS countstuid,tbl_year.studyyear,tblstudent.username,tblbook.booktitle,tblstureaddaily.bookid,tblclass.classname FROM tblstureaddaily INNER JOIN tbl_year ON tblstureaddaily.yearid=tbl_year.id INNER JOIN tblbook ON tblbook.bookid=tblstureaddaily.bookid INNER JOIN tblstudent ON tblstureaddaily.studentid=tblstudent.studentid INNER JOIN tblclass ON tblstureaddaily.classid=tblclass.classid GROUP BY tblstureaddaily.studentid HAVING COUNT(tblstureaddaily.studentid)>0 ";
	$result = $conn->query($sql); 
	while($row=$result->fetch_assoc()){
		$stucountdata[] = array($row['id'],$row['studentid'],$row['username'],$row['bookid'],$row['booktitle'], $row['date'],$row['classname'],$row['studyyear'] ,$row['countstuid']); 
	} 
	echo json_encode($stucountdata);   
}
?>