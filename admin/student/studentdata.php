<?php 
require '../../db.php';
//1-Get class   
if($_GET['data']=='get-student'){    
  $sql = "SELECT tblstudent.id, tblstudent.studentid,tblstudent.username,tblstudent.gender,tblstudent.phone,tblteacher.teachername,tblstudent.status FROM tblstudent INNER JOIN tblteacher ON tblstudent.teacherid=tblteacher.teacherid";    
  $result = $conn->query($sql); 
  while($row=$result->fetch_assoc()){      
      $option = '<a href="#" id="student_'.$row['id'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editStudent('. $row['id'] .');">កែប្រែ</a>';
   $output='';
   if($row['status'] == 0){
     $output.='<p class="btn btn-danger btn-sm">ផ្អាកដំណើរការ</p>';
   }else{
    $output.='<p class="btn btn-success btn-sm">ដំណើរការធម្មតា</p>';
   }

    $option.= '&nbsp; <a href="#" id="student_'.$row['id'].'" class="btn btn-danger btn-rounded"  onclick="deleteStudent('. $row['id'] .');">លុប</span></a>';

        $studentdata[] = array($row['studentid'], $row['username'], $row['gender'], $row['phone'], $row['teachername'], $output ,$option);  

    } 
    echo json_encode($studentdata);   
}

//4-Add User
  if($_GET['data']=='get-addstudent'){ 
    try{
	$count_my_page = ("../../HomePage/studentid.txt");
  	$hits = file($count_my_page);
  	$hits[0] ++;
  	$fp = fopen($count_my_page , "w");
  	fputs($fp , "$hits[0]");
  	fclose($fp); 
  	$StudentId= $hits[0];   
  	$username=$_POST['username'];
  	$gender=$_POST['txtgender'];
  	$password=md5($_POST['txtpassword']);
  	$phone=($_POST['txtphone']);
  	$teacherid=($_POST['txtteachername']);  
  	$status=($_POST['txtstatus']);
  	$sql="INSERT INTO tblborrow (id,studentid,bookid,returndate,ReturnStatus) VALUES (null,'SPSTP0001',50,'11/11/22',0);UPDATE tblbook set isIssued=1 where bookid=50;";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}

//3-Get Class By ID   
if($_GET['data']=='get-studentat'){    
	$sql = "select * from tblstudent where id=?";    
	$stmt = $conn->prepare($sql);    
	$stmt->bind_param("i",$id);    
	$id = $_GET["studentid"];    
	$stmt->execute();    
	$result = $stmt->get_result(); 
 	 	if($row=$result->fetch_assoc()){      
    $classdata[] = array($row['id'], $row['username'],$row['gender'],$row['password'],$row['teacherid'],$row['phone'],$row['status']);    
   }    
  echo json_encode($classdata);   
}

//5-Update Book   
if($_GET['data']=='updatestudent'){    
  try{ 
    $id = $_GET["id"];
    $username = $_GET['username'];
    $gender = $_GET["txtgender"];
    $password = md5($_GET["txtpassword"]);
    $teacherid = $_GET["txtteachername"];
    $phone = $_GET["txtphone"];
    $status = $_GET["txtstatus"];
    $sql = "UPDATE tblstudent SET 
    username='$username',
    gender='$gender',
    password='$password',
    teacherid=$teacherid,
    phone='$phone',
    status='$status' 
    WHERE id=$id; ";     
    if($conn->query($sql) == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}

//5-Delete class   
if($_GET['data']=='deletestudent'){    
  try{     
    $sql = "delete from tblstudent where id=?";     
    $stmt = $conn->prepare($sql);     
    $stmt->bind_param("i",$id);     
    $id = $_GET["studentid"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}   
?>