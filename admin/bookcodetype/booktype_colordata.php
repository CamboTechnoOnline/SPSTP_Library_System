<?php 
require '../../db.php';
//1-Get User   
if($_GET['data']=='get-booktypecolor'){    
    $sql = "select * from tblbooktype_color";    
    $result = $conn->query($sql); 
    while($row=$result->fetch_assoc()){      
        $option = '<a href="#" id="booktype_color'.$row['id'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editBooktype_Color('. $row['id'] .');">កែប្រែ</a>'; 
 
        $option.= '&nbsp; <a href="#" id="booktype_color'.$row['id'].'" class="btn btn-danger btn-rounded "  onclick="deleteBooktype_Color('. $row['id'] .');">លុប</span></a>'; 
 
    $Booktype_Color[] = array($row['id'], $row['colorname'],$row['bookcolortype'], $option); 
  } 

   echo json_encode($Booktype_Color);   
 }

//2-Add New Booktype_color   
if($_GET['data']=='addbooktypecolor'){ 
   try{     
    $bookcolor = $_GET["txtbookcolor"];   
    $bookcolortype = $_GET["txtbookcolortype"];    
    $sql = "INSERT INTO tblbooktype_color VALUES (null,'$bookcolor','$bookcolortype')";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 

//3-Get booktypecolor By ID   
 if($_GET['data']=='get-booktypecolorat'){    
  $sql = "select * from tblbooktype_color where id=?";    
  $stmt = $conn->prepare($sql);    
  $stmt->bind_param("i",$id);    
  $id = $_GET["booktypeid"];    
  $stmt->execute();    
  $result = $stmt->get_result();    
  if($row=$result->fetch_assoc()){      
    $Booktype_Color[] = array($row['id'], $row['colorname'],$row['bookcolortype']);    
  }    
  echo json_encode($Booktype_Color);   
}

//4-Update booktypecolor   
if($_GET['data']=='updatebooktypecolor'){    
  try{     
    $sql = "update tblbooktype_color set colorname=? , bookcolortype=? where id=?";     
    $stmt = $conn->prepare($sql);       
    $stmt->bind_param("ssi",$colorname,$bookcolortype,$id); 
    $colorname = $_GET["txtbookcolor"]; 
    $bookcolortype = $_GET["txtbookcolortype"];   
    $id = $_GET["id"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}

//5-Delete booktypecolor   
if($_GET['data']=='deletebooktypecolor'){    
  try{     
    $sql = "delete from tblbooktype_color where id=?";     
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