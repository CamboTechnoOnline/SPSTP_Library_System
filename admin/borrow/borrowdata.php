<?php 
require '../../db.php'; 

if($_GET['data']=='get-bookborrow'){    
  $sql = "SELECT tblstudent.studentid,tblstudent.username,tblbook.bookid,tblbook.booktitle,tblborrow.borrowdate,tblborrow.datereturn,tblborrow.ReturnStatus,tblborrow.id,tbl_year.studyyear FROM tblborrow INNER JOIN tblstudent ON tblstudent.studentid=tblborrow.studentid INNER JOIN tblbook ON tblbook.bookid=tblborrow.bookid INNER JOIN tbl_year ON tbl_year.id=tblborrow.year";
  $result = $conn->query($sql); 
  while($row=$result->fetch_assoc()){
   $option = '<a href="" id="borrow_'.$row['id'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editBorrow('. $row['id'] .');">កែប្រែ</a>';      
	$output='';
   if($row['ReturnStatus'] == 0){
     $output.='<p class="btn btn-danger btn-sm">មិនទាន់សង់</p>';
   }else{
    $output.='<p class="btn btn-success btn-sm">សងរូចរាល់</p>';
   }
    $outputday='';
  	$borrowdate = strtotime($row['borrowdate']);
   	$returnday = strtotime($row['datereturn']);
   	$today = strtotime(date('Y-m-d'));
   		if($row['ReturnStatus'] == 1){
   			$outputday.='<p class="btn btn-primary btn-sm">ការខ្ចីធម្មតា</p>';
   		}else if($today>$returnday){
   			$diff=$today-$returnday;
   			$expire = abs(floor($diff / (60*60*24)));
   			$outputday.='<p class="btn btn-danger btn-sm">លើស '.$expire.' ថ្ងៃ</p>';
   		}else{
   			$diff=$today-$returnday;
   			$expire = abs(floor($diff / (60*60*24)));
   			$outputday.='<p class="btn btn-success btn-sm">សល់ '.$expire.' ថ្ងៃ</p>';
 		}

    $Bookdata[] = array($row['studentid'],$row['username'],$row['bookid'],$row['booktitle'], $row['borrowdate'], $row['datereturn'], $outputday,$output,$row['studyyear'],$option); 
  } 

  echo json_encode($Bookdata);   
}

//2-Add New borrower   
if($_GET['data']=='addborrow'){ 
   try{  
    $studentid = strtoupper($_GET["txtstudentid"]);
    $bookid = $_GET["txtbookid"];
    $dateborrow = $_GET["txtdateborrow"];
    $datereturn = $_GET["txtdatereturn"]; 
    $returnstatus = 0; 
    $year = $_GET["txtyear"];        
    $sql = "INSERT INTO tblborrow VALUES (null,'$studentid',$bookid,'$dateborrow','$datereturn',$returnstatus,$year);";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 
//2-change isissued on tblbook
if($_GET['data']=='editbook'){ 
   try{  
    $bookid = $_GET["txtbookid"];      
    $returnstatus = 0;
    $sql ="UPDATE tblbook SET isIssued=$returnstatus WHERE bookid=$bookid";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 

//2-change isissued on tblbook
if($_GET['data']=='editisIssuedbook'){ 
   try{  
    $bookid = $_GET["txtbookid"];      
   	$returnstatus = $_GET["txtreturnstatus"]; 
    $sql ="UPDATE tblbook SET isIssued=$returnstatus WHERE bookid=$bookid";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
}
//3-Get Book By ID   
if($_GET['data']=='get-borrowat'){ 
 $output='';   
  $sql = "SELECT tblstudent.studentid,tblstudent.username,tblbook.bookid,tblbook.booktitle,tblborrow.borrowdate,tblborrow.datereturn,tblborrow.ReturnStatus,tblborrow.year FROM tblborrow INNER JOIN tblstudent ON tblstudent.studentid=tblborrow.studentid INNER JOIN tblbook ON tblbook.bookid=tblborrow.bookid INNER JOIN tbl_year ON tbl_year.id=tblborrow.year WHERE tblborrow.id=?;";    
  $stmt = $conn->prepare($sql);    
  $stmt->bind_param("i",$id);    
  $id = $_GET["id"];    
  $stmt->execute();    
  $result = $stmt->get_result();   
  if($row=$result->fetch_assoc()){      
    $bookdata[] = array(
      $row['studentid'], 
      $row['username'], 
      $row['bookid'],
      $row['booktitle'],
      $row['borrowdate'],
      $row['datereturn'],
      $row['ReturnStatus'],
      $row['year']
    );    
  }    
  echo json_encode($bookdata);   
}
 //5-Update borrow 
if($_GET['data']=='updateborrow'){    
  try{ 
    $id = $_GET["id"];
    $datereturn = $_GET["txtdatereturn"]; 
    $returnstatus = $_GET["txtreturnstatus"]; 
    $year = $_GET["txtyear"];        
    $sql = "UPDATE tblborrow SET 
    datereturn='$datereturn',
    ReturnStatus=$returnstatus,
    year=$year
    WHERE tblborrow.id=$id; ";     
    if($conn->query($sql) == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 
//get student to select box auto
if(!empty($_POST["studentid"])) {
	$outputcountstu='';
	$output='';
	$studentid= strtoupper($_POST["studentid"]);

	$sqlcount=("SELECT COUNT(*) as studentcount FROM tblborrow WHERE studentid='$studentid' AND ReturnStatus=0");
	$resultcount = $conn->query($sqlcount);	 	
 	while($rowcount=$resultcount->fetch_assoc()){
 		if($rowcount['studentcount'] >= 2) {
	  		$outputcountstu.='<option value="" >មិនអាចខ្ចីលើសពី​ ២ បានទេ</option>';
	  		$outputcountstu.="<script>$('#btnsubmit').prop('disabled',true);</script>";
	  		$outputcountstu.="<script>$('#txtbookid').prop('disabled',true);</script>";
	  		echo $outputcountstu;
	 	}else{
			$sql=("SELECT * FROM tblstudent WHERE studentid='$studentid'");
			$result = $conn->query($sql);
	 		if(mysqli_num_rows($result) > 0){
			 	while($row=$result->fetch_assoc()){
			 		if($row['status'] == 0) {
				  		$output.='<option value="" >ត្រូវបានផ្អាកដំណើរការ</option>';
				  		$output.="<script>$('#btnsubmit').prop('disabled',true);</script>";
				  		$output.="<script>$('#txtbookid').prop('disabled',true);</script>";
				  	}else if($row['status'] == 1){
				  		$output.='<option value="" >'.$row['username'].'</option>';
				  		$output.="<script>$('#btnsubmit').prop('disabled',false);</script>";
				  		$output.="<script>$('#txtbookid').prop('disabled',false);</script>";
				  	}
		  		}
		  	}else{
		  		$output.='<option value="" >លេខកូខមិនត្រឹមត្រូវ</option>';
				$output.="<script>$('#btnsubmit').prop('disabled',true);</script>";
				$output.="<script>$('#txtbookid').prop('disabled',true);</script>";
		  	}
		  echo $output;
	 	}
	}
		 
}

//get book title to select box auto
if(!empty($_POST["bookid"])) {
	$bookid= strtoupper($_POST["bookid"]);
	 $output='';
	 $sql=("SELECT * FROM tblbook WHERE bookid='$bookid'");
	 $result = $conn->query($sql);
	 if(mysqli_num_rows($result) > 0){
	 	while($row=$result->fetch_assoc()){
	 		if($row['isIssued'] == 0) {
		  		$output.='<option value="" >មិនទំនេរ</option>';
		  		$output.="<script>$('#btnsubmit').prop('disabled',true);</script>";
		  	}else if($row['isIssued'] == 1){
		  		$output.='<option value="" >'.$row['booktitle'].'</option>';
		  		$output.="<script>$('#btnsubmit').prop('disabled',false);</script>";
		  	}
  		}
  	}else{
  		$output.='<option value="" >លេខកូខមិនត្រឹមត្រូវ</option>';
		$output.="<script>$('#btnsubmit').prop('disabled',true);</script>";
  	}
  echo $output;
}


if($_GET['data']=='get-bookborrownotrepaid'){    
  $sql = "SELECT tblstudent.studentid,tblstudent.username,tblbook.bookid,tblbook.booktitle,tblborrow.borrowdate,tblborrow.datereturn,tblborrow.ReturnStatus,tblborrow.id,tbl_year.studyyear FROM tblborrow INNER JOIN tblstudent ON tblstudent.studentid=tblborrow.studentid INNER JOIN tblbook ON tblbook.bookid=tblborrow.bookid INNER JOIN tbl_year ON tbl_year.id=tblborrow.year WHERE ReturnStatus=0";
  $result = $conn->query($sql); 
  while($row=$result->fetch_assoc()){   
	$output='';
   if($row['ReturnStatus'] == 0){
     $output.='<p class="btn btn-danger btn-sm">មិនទាន់សង់</p>';
   }else{
    $output.='<p class="btn btn-success btn-sm">សងរូចរាល់</p>';
   }
    $outputday='';
  	$borrowdate = strtotime($row['borrowdate']);
   	$returnday = strtotime($row['datereturn']);
   	$today = strtotime(date('Y-m-d'));
   		if($row['ReturnStatus'] == 1){
   			$outputday.='<p class="btn btn-primary btn-sm">ការខ្ចីធម្មតា</p>';
   		}else if($today>$returnday){
   			$diff=$today-$returnday;
   			$expire = abs(floor($diff / (60*60*24)));
   			$outputday.='<p class="btn btn-danger btn-sm">លើស '.$expire.' ថ្ងៃ</p>';
   		}else{
   			$diff=$today-$returnday;
   			$expire = abs(floor($diff / (60*60*24)));
   			$outputday.='<p class="btn btn-success btn-sm">សល់ '.$expire.' ថ្ងៃ</p>';
 		}

    $Bookdata[] = array($row['studentid'],$row['username'],$row['bookid'],$row['booktitle'], $row['borrowdate'], $row['datereturn'], $outputday,$output,$row['studyyear']); 
  } 

  echo json_encode($Bookdata);   
}
?>