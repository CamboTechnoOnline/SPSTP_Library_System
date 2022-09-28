<?php 
require '../../db.php';
session_start();
$upload_dir = '../../image/';
//1-Get User   
if($_GET['data']=='get-user'){    
    $sql = "select * from tbluser";    
    $result = $conn->query($sql); 
    while($row=$result->fetch_assoc()){      
        $option = '<a href="#" id="user_'.$row['userid'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editUser('. $row['userid'] .');">កែប្រែ</a>'; 
 
    $option.= '&nbsp; <a href="#" id="user_'.$row['userid'].'" class="btn btn-danger btn-rounded" onclick="deleteUser('. $row['userid'] .');">លុប</span></a>'; 
 
    $userdata[] = array($row['userid'], $row['name'], $row['gender'], $row['address'], $row['username'],$row['photo'], $row['phone'],$row['user_type'],$option); 
    // session for unlink image on directory beacause outside score 
    $_SESSION["row2"]= $row['photo'];
  } 

   echo json_encode($userdata);   
 }  

//2-Get User By ID input to textbox on form  
   if($_GET['data']=='get-userat'){    
        $sql = "select * from tbluser where userid=" . $_GET['userid'];    
        $result = $conn->query($sql);    
        if($row=$result->fetch_assoc()){      
            $userdata[] =array(
                $row['name'], 
                $row['gender'],
                $row['address'], 
                $row['username'],
                $row['password'],
                $row['photo'],
                $row['phone'],
                $row['user_type']); 
       }    
       echo json_encode($userdata);   
 }
//4-Add User
  if($_GET['data']=='get-adduser'){ 
    try{
    //Upload image     
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); 
    // valid extensions     
    $path = ''; // upload directory     
    $img = '';     
    if($_FILES['txtphoto']){      
        $img = $_FILES['txtphoto']['name'];      
        $tmp = $_FILES['txtphoto']['tmp_name'];// get uploaded file's extension      
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));// can upload same image using rand function      
        $final_image = $img;// check's valid format      
        if(in_array($ext, $valid_extensions)){        
            $path = $upload_dir.strtolower($final_image);       
            move_uploaded_file($tmp,$path);      
        }      
    } 
     
    $name = $_POST["txtname"];     
    $gender = $_POST["txtgender"];     
    $address = $_POST["txtaddress"];   
    $username = $_POST["txtusername"];
    $password = md5($_POST["txtpassword"]);
    $photo = $_POST["txtphotoname"];
    $phone = $_POST["txtphone"];
    $usertype = $_POST["txtusertype"];
    $sql = "INSERT INTO tbluser VALUES(NULL,'$name','$gender','$address','$username','$password','$photo','$phone','$usertype')";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}

//5-Update User   
if($_GET['data']=='updateuser'){    
    try{
        $id = $_POST["userid"];     
        $name = $_POST["txtname"];     
        $gender = $_POST["txtgender"];     
        $address = $_POST["txtaddress"];  
        $username = $_POST["txtusername"];
        $password = md5($_POST["txtpassword"]);
        $photo = $_POST["txtphotoname"];
        $phone = $_POST["txtphone"];
        $usertype = $_POST["txtusertype"];
        //Upload image     
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions     
        $path = ''; // upload directory     
        $img = '';     
        if($_FILES['txtphoto']){      
            $img = $_FILES['txtphoto']['name'];      
            $tmp = $_FILES['txtphoto']['tmp_name'];// get uploaded file's extension      
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));//can upload same image using rand function      
            $final_image = $img;// check's valid format 
                if(in_array($ext, $valid_extensions))       {        
                  $path = $upload_dir.strtolower($final_image); 
                  unlink($upload_dir.$_SESSION["row2"]); //session on //1-Get User     
                  move_uploaded_file($tmp,$path);
            }      
        }      
            
        $sql = "UPDATE tbluser SET name='$name',gender='$gender',address='$address',username='$username',password='$password',photo='$photo',phone='$phone',user_type='$usertype' WHERE userid = $id";   
        if($conn->query($sql) == true){      
          echo "success";     
        }    
    }catch(Exception $e) {     
        die($e->getMessage());    
    }   
}

//6-Delete User   
if($_GET['data']=='deleteuser'){    
  try{     
    $id = $_GET["userid"];     
    $sql = "delete from tbluser where userid=$id";     
        if($conn->query($sql) == true){
            unlink($upload_dir.$_SESSION["row2"]); //session on //1-Get User      
            echo "success";     
        }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 
?>