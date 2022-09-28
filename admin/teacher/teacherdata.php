<?php 
require '../../db.php';
//1-Get class   
if($_GET['data']=='get-teacher'){    
  $sql = "SELECT tblteacher.teacherid,tblteacher.teachername,tblteacher.gender,tblclass.classname,tblteacher.timeteach,tblteacher.teachlanguage,tblteacher.phone FROM tblteacher INNER JOIN tblclass ON tblteacher.classteacher=tblclass.classid ";    
  $result = $conn->query($sql); 
  while($row=$result->fetch_assoc()){      
      $option = '<a href="#" id="teacher_'.$row['teacherid'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editTeacher('. $row['teacherid'] .');">កែប្រែ</a>'; 
 
    $option.= '&nbsp; <a href="#" id="teacher_'.$row['teacherid'].'" class="btn btn-danger btn-rounded"  onclick="deleteTeacher('. $row['teacherid'] .');">លុប</span></a>'; 
        $teacherdata[] = array($row['teacherid'], $row['teachername'],$row['gender'],$row['classname'],$row['timeteach'],$row['teachlanguage'],$row['phone'] ,$option);  
    } 
    echo json_encode($teacherdata);   
}
//2-Add New Teacher   
if($_GET['data']=='addteacher'){ 
   try{     
    $teachername = $_GET["txtteachername"];
    $gender = $_GET["txtgender"];
    $classteacher = $_GET["txtclassteacher"];
    $timeteach = $_GET["txttimeteach"];
    $teachlanguage = $_GET["txtteachlanguage"];
    $phone = $_GET["txtphone"];             
    $sql = "INSERT INTO tblteacher VALUES (null,'$teachername','$gender',$classteacher,'$timeteach','$teachlanguage','$phone')";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}

//3-Get Teacher By ID   
if($_GET['data']=='get-teacherat'){    
	$sql = "select * from tblteacher where teacherid=?";    
	$stmt = $conn->prepare($sql);    
	$stmt->bind_param("i",$id);    
	$id = $_GET["teacherid"];    
	$stmt->execute();    
	$result = $stmt->get_result(); 
 	 	if($row=$result->fetch_assoc()){      
    $classdata[] = array($row['teacherid'], $row['teachername'], $row['gender'], $row['classteacher'], $row['timeteach'], $row['teachlanguage'], $row['phone']);    
   }    
  echo json_encode($classdata);   
}

//5-Update updateteacher   
if($_GET['data']=='updateteacher'){    
    try{
        $id = $_POST["teacherid"];     
        $teachername = $_POST["txtteachername"];     
        $gender = $_POST["txtgender"];     
        $classteacher = $_POST["txtclassteacher"];  
        $timeteach = $_POST["txttimeteach"];
        $teachlanguage = ($_POST["txtteachlanguage"]);
        $phone = $_POST["txtphone"];
        $sql = "UPDATE tblteacher SET teachername='$teachername',gender='$gender',classteacher=$classteacher,timeteach='$timeteach',teachlanguage='$teachlanguage',phone='$phone' WHERE teacherid = $id";   
        if($conn->query($sql) == true){      
          echo "success";     
        }    
    }catch(Exception $e) {     
        die($e->getMessage());    
    }   
}

//5-Delete Teacher   
if($_GET['data']=='deleteteacher'){    
  try{     
    $sql = "delete from tblteacher where teacherid=?";     
    $stmt = $conn->prepare($sql);     
    $stmt->bind_param("i",$id);     
    $id = $_GET["teacherid"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 
?>