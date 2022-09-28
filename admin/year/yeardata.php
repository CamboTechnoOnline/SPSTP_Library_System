<?php 
require '../../db.php';
//1-Get User   
if($_GET['data']=='get-year'){    
    $sql = "select * from tbl_year";    
    $result = $conn->query($sql); 
    while($row=$result->fetch_assoc()){      
        $option = '<a href="#" id="year_'.$row['id'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editYear('. $row['id'] .');">កែប្រែ</a>'; 
 
        $option.= '&nbsp; <a href="#" id="year_'.$row['id'].'" class="btn btn-danger btn-rounded"  onclick="deleteYear('. $row['id'] .');">លុប</span></a>'; 
 
    $yeardata[] = array($row['id'], $row['studyyear'], $option); 
  } 

   echo json_encode($yeardata);   
 }
//2-Add New Year   
if($_GET['data']=='addyear'){ 
   try{     
    $studyyear = $_GET["txtstudyyear"];       
    $sql = "INSERT INTO tbl_year VALUES (null,'$studyyear')";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 

//3-Get Year By ID   
 if($_GET['data']=='get-yearat'){    
  $sql = "select * from tbl_year where id=?";    
  $stmt = $conn->prepare($sql);    
  $stmt->bind_param("i",$id);    
  $id = $_GET["yearid"];    
  $stmt->execute();    
  $result = $stmt->get_result(); 
   //$sql = "select * from tblcourse where courseid=" . $_GET['courseid'];    
   //$result = $conn->query($sql);    
  if($row=$result->fetch_assoc()){      
    $yeardata[] = array($row['id'], $row['studyyear']);    
  }    
  echo json_encode($yeardata);   
}

//4-Update Year   
if($_GET['data']=='updateyear'){    
  try{     
    $sql = "update tbl_year set studyyear=? where id=?";     
    $stmt = $conn->prepare($sql);       
    $stmt->bind_param("si", $studyyear,$id); 
    $studyyear = $_GET["txtstudyyear"];    
    $id = $_GET["id"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}

//5-Delete class   
if($_GET['data']=='deleteyear'){    
  try{     
    $sql = "delete from tbl_year where id=?";     
    $stmt = $conn->prepare($sql);     
    $stmt->bind_param("i",$id);     
    $id = $_GET["yearid"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 
?>