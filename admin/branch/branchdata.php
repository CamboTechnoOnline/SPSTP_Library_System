<?php 
include '../../db.php';
if($_GET['data']=='get-branch'){    
	$sql = "SELECT * FROM tblbranch";
	$result = $conn->query($sql); 
	while($row=$result->fetch_assoc()){
		$option = '<a href="#" id="branch_'.$row['id'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editBranch('. $row['id'] .');">កែប្រែ</a>'; 

		$stureaddata[] = array($row['id'],$row['branchname'],$option); 
	} 

	echo json_encode($stureaddata);   
}

//3-Get Book By ID   
if($_GET['data']=='get-branchat'){ 
	$output='';   
	$sql = "SELECT * FROM tblbranch WHERE id=?;";    
	$stmt = $conn->prepare($sql);    
	$stmt->bind_param("i",$id);    
	$id = $_GET["id"];    
	$stmt->execute();    
	$result = $stmt->get_result();   
	if($row=$result->fetch_assoc()){      
		$bookdata[] = array(
			$row['branchname']);    
	}    
	echo json_encode($bookdata);   
}

 //5-Update Branch
if($_GET['data']=='updatebranch'){    
	try{ 
		$id = $_GET["id"];
		$branch = $_GET["txtbranch"];      
		$sql = "UPDATE tblbranch SET branchname='$branch' WHERE id=$id; ";     
		if($conn->query($sql) == true){      
			echo "success";     
		}    
	}catch(Exception $e) {     
		die($e->getMessage());    
	}   
} 
?>