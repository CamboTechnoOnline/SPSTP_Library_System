<?php 
require '../../db.php';
//1-Get User   
if($_GET['data']=='get-author'){    
    $sql = "select * from tblauthor";    
    $result = $conn->query($sql); 
    while($row=$result->fetch_assoc()){      
        $option = '<a href="#" id="author_'.$row['authorid'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editAuthor('. $row['authorid'] .');">កែប្រែ</a>'; 
 
        $option.= '&nbsp; <a href="#" id="author_'.$row['authorid'].'" class="btn btn-danger btn-rounded"  onclick="deleteAuthor('. $row['authorid'] .');">លុប</span></a>'; 
 
    $authordata[] = array($row['authorid'], $row['authorname'], $option); 
  } 

   echo json_encode($authordata);   
 }

//2-Add New Author   
if($_GET['data']=='addauthor'){ 
   try{     
    $authorname = $_GET["txtauthorname"];       
    $sql = "INSERT INTO tblauthor VALUES (null,'$authorname')";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 

//3-Get Author By ID   
 if($_GET['data']=='get-authorat'){    
  $sql = "select * from tblauthor where authorid=?";    
  $stmt = $conn->prepare($sql);    
  $stmt->bind_param("i",$id);    
  $id = $_GET["authorid"];    
  $stmt->execute();    
  $result = $stmt->get_result();  
  if($row=$result->fetch_assoc()){      
    $anthordata[] = array($row['authorid'], $row['authorname']);    
  }    
  echo json_encode($anthordata);   
}

//4-Update Author   
if($_GET['data']=='updateauthor'){    
  try{     
    $sql = "update tblauthor set authorname=? where authorid=?";     
    $stmt = $conn->prepare($sql);       
    $stmt->bind_param("si", $authorname,$id); 
    $authorname = $_GET["txtauthorname"];    
    $id = $_GET["id"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}

//5-Delete Author   
if($_GET['data']=='deleteauthor'){    
  try{     
    $sql = "delete from tblauthor where authorid=?";     
    $stmt = $conn->prepare($sql);     
    $stmt->bind_param("i",$id);     
    $id = $_GET["authorid"]; 
 
    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}
 ?>