<?php 
require '../../db.php';
//1-Get User   
if($_GET['data']=='get-booktypedeve'){    
    $sql = "select * from tblbooktype_deve";    
    $result = $conn->query($sql); 
    while($row=$result->fetch_assoc()){      
        $option = '<a href="#" id="booktype_deve'.$row['id'].'" class="btn btn-info" data-toggle="modal" data-target="#form_data" onclick="editBooktype_Deve('. $row['id'] .');">កែប្រែ</a>'; 
 
        $option.= '&nbsp; <a href="#" id="booktype_deve'.$row['id'].'" class="btn btn-danger btn-rounded"  onclick="deleteBooktype_Deve('. $row['id'] .');">លុប</span></a>'; 
 
    $Booktype_Deve[] = array($row['id'], $row['devenum'],$row['devebooktype'], $option); 
  } 

   echo json_encode($Booktype_Deve);   
 }

//2-Add New Booktype_deve  
if($_GET['data']=='addbooktypedeve'){ 
   try{     
    $numdeve = $_GET["txtnumdeve"];
    $bookdeve = $_GET["txtbookdeve"];        
    $sql = "INSERT INTO tblbooktype_deve VALUES (null,'$numdeve','$bookdeve')";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 

//3-Get booktypedeve By ID   
 if($_GET['data']=='get-booktypedeveat'){    
  $sql = "select * from tblbooktype_deve where id=?";    
  $stmt = $conn->prepare($sql);    
  $stmt->bind_param("i",$id);    
  $id = $_GET["booktypeid"];    
  $stmt->execute();    
  $result = $stmt->get_result();    
  if($row=$result->fetch_assoc()){      
    $Booktype_Deve[] = array($row['id'], $row['devenum'],$row['devebooktype'] );    
  }    
  echo json_encode($Booktype_Deve);   
}

//4-Update booktypeDeve  
if($_GET['data']=='updatebooktypedeve'){    
  try{     
    $sql = "update tblbooktype_deve set devenum=?, devebooktype=? where id=?";     
    $stmt = $conn->prepare($sql);       
    $stmt->bind_param("ssi",$numdeve,$bookdeve,$id); 
    $bookdeve = $_GET["txtbookdeve"];
    $numdeve = $_GET["txtnumdeve"];       
    $id = $_GET["id"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}

//5-Delete booktypedeve   
if($_GET['data']=='deletebooktypedeve'){    
  try{     
    $sql = "delete from tblbooktype_deve where id=?";     
    $stmt = $conn->prepare($sql);     
    $stmt->bind_param("i",$id);     
    $id = $_GET["booktypeid"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 
 ?>