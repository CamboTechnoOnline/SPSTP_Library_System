<?php 
require '../../db.php';
//1-Get class   
if($_GET['data']=='get-class'){    
  $sql = "SELECT * FROM tblclass";    
  $result = $conn->query($sql); 
  while($row=$result->fetch_assoc()){      
      $option = '<a href="#" id="class_'.$row['classid'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editClass('. $row['classid'] .');">កែប្រែ</a>'; 
 
    $option.= '&nbsp; <a href="#" id="class_'.$row['classid'].'" class="btn btn-danger btn-rounded"  onclick="deleteClass('. $row['classid'] .');">លុប</span></a>'; 
        $classdata[] = array($row['classid'], $row['classname'] ,$option);  
    } 
    echo json_encode($classdata);   
}
//2-Add New Class   
if($_GET['data']=='addclass'){ 
   try{     
    $classname = $_GET["txtclassname"];       
    $sql = "INSERT INTO tblclass VALUES (null,'$classname')";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}
//3-Get Class By ID   
if($_GET['data']=='get-classat'){    
	$sql = "select * from tblclass where classid=?";    
	$stmt = $conn->prepare($sql);    
	$stmt->bind_param("i",$id);    
	$id = $_GET["classid"];    
	$stmt->execute();    
	$result = $stmt->get_result(); 
 	 	if($row=$result->fetch_assoc()){      
    $classdata[] = array($row['classid'], $row['classname']);    
   }    
  echo json_encode($classdata);   
}

//4-Update Class   
if($_GET['data']=='updateclass'){    
  try{     
    $sql = "update tblclass set classname=? where classid=?";     
    $stmt = $conn->prepare($sql);       
    $stmt->bind_param("si", $classname,$id); 
    $classname = $_GET["txtclassname"];    
    $id = $_GET["id"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}

//5-Delete class   
if($_GET['data']=='deleteclass'){    
  try{     
    $sql = "delete from tblclass where classid=?";     
    $stmt = $conn->prepare($sql);     
    $stmt->bind_param("i",$id);     
    $id = $_GET["classid"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}  
?>	