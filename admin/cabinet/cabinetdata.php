<?php 
require '../../db.php';
//1-Get User   
if($_GET['data']=='get-cabinet'){    
    $sql = "select * from tblcabinet";    
    $result = $conn->query($sql); 
    while($row=$result->fetch_assoc()){      
        $option = '<a href="#" id="cabinet'.$row['cabinetid'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editCabinet('. $row['cabinetid'] .');">កែប្រែ</a>'; 
 
        $option.= '&nbsp; <a href="#" id="cabinet'.$row['cabinetid'].'" class="btn btn-danger btn-rounded"  onclick="deleteCabinet('. $row['cabinetid'] .');">លុប</span></a>'; 
 
    $cabinet[] = array($row['cabinetid'], $row['cabinet_type'], $option); 
  } 

   echo json_encode($cabinet);   
 }

 //2-Add New Cabinet
if($_GET['data']=='addcabinet'){ 
   try{     
    $cabinet = $_GET["txtcabinet"];        
    $sql = "INSERT INTO tblcabinet VALUES (null,'$cabinet')";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 

//3-Get Cabinet By ID   
 if($_GET['data']=='get-cabinetat'){    
  $sql = "select * from tblcabinet where cabinetid=?";    
  $stmt = $conn->prepare($sql);    
  $stmt->bind_param("i",$id);    
  $id = $_GET["cabinetid"];    
  $stmt->execute();    
  $result = $stmt->get_result();    
  if($row=$result->fetch_assoc()){      
    $Cabinet[] = array($row['cabinetid'], $row['cabinet_type'] );    
  }    
  echo json_encode($Cabinet);   
}

//4-Update Cabinet 
if($_GET['data']=='updatecabinet'){    
  try{     
    $sql = "update tblcabinet set cabinet_type=? where cabinetid=?";     
    $stmt = $conn->prepare($sql);       
    $stmt->bind_param("si",$colorname,$id); 
    $colorname = $_GET["txtcabinet"];      
    $id = $_GET["id"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}

//5-Delete Cabinet  
if($_GET['data']=='deletecabinet'){    
  try{     
    $sql = "delete from tblcabinet where cabinetid=?";     
    $stmt = $conn->prepare($sql);     
    $stmt->bind_param("i",$id);     
    $id = $_GET["cabinetid"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}
?>