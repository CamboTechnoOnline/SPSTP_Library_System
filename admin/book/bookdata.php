<?php 
require '../../db.php';
//1-Get User   
if($_GET['data']=='get-book'){    
  $sql = "SELECT tblbook.bookid, tblbook.booktitle, tblbooktype_deve.devebooktype, tblcabinet.cabinet_type, tblauthor.authorname, tblbook.publishinghouse, tblbook.yearpublication, tblbook.datein, tblbook.quality, tblcabinet.cabinet_type, tblbook.numcabinet, tblbook.numberingbook,tblbook.isIssued
FROM tblcabinet INNER JOIN (tblbooktype_deve INNER JOIN (tblbooktype_color INNER JOIN (tblauthor INNER JOIN tblbook ON tblauthor.authorid = tblbook.authorid) ON tblbooktype_color.id = tblbook.codecolorid) ON tblbooktype_deve.id = tblbook.codedeveid) ON tblcabinet.cabinetid = tblbook.cabinetid;
";;    
  $result = $conn->query($sql); 
  while($row=$result->fetch_assoc()){      
    $option = '<a href="" id="book_'.$row['bookid'].'" class="btn btn-info"  data-toggle="modal" data-target="#form_data" onclick="editBook('. $row['bookid'] .');">កែប្រែ</a>'; 

    $option.= '&nbsp; <a href="" id="book_'.$row['bookid'].'" class="btn btn-danger btn-rounded" 
    onclick="deleteBook('. $row['bookid'] .');">លុប</a>'; 

    $option.= '&nbsp; <a href="" id="book_'.$row['bookid'].'" class="btn btn-success" data-toggle="modal" data-target="#dataModal" onclick="showdata('. $row['bookid'] .');">លំអិត</a>'; 
  $output='';
   if($row['isIssued'] == 1){
     $output.='<p class="btn btn-success btn-sm">ទំនេរ</p>';
   }else{
    $output.='<p class="btn btn-danger btn-sm">មិនទំនេរ</p>';
   }
    $Bookdata[] = array($row['bookid'], $row['booktitle'], $row['quality'], $row['authorname'], $row['numcabinet'], $row['numberingbook'],$output, $option); 
  } 

  echo json_encode($Bookdata);   
}

//2-Add New Author   
if($_GET['data']=='addbook'){ 
   try{
    $bookid = $_GET["txtbookid"];     
    $booktitle = $_GET["txtbooktitle"];
    $codecolor = $_GET["txtcodecolor"];
    $codedeve = $_GET["txtcodedeve"];       
    $author = $_GET["txtauthor"];
    $publishinghouse = $_GET["txtpublishinghouse"];
    $yearpublication = $_GET["txtyearpublication"];
    $datein = $_GET["txtdatein"];
    $quality = $_GET["txtquality"];
    $cabinetype = $_GET["txtcabinetype"];
    $numcabinet = $_GET["txtnumcabinet"];
    $numberingbook = $_GET["txtnumberingbook"];
    $isIssued =0;
    $sql = "INSERT INTO tblbook VALUES ($bookid,'$booktitle',$codecolor,$codedeve,$author,'$publishinghouse','$yearpublication','$datein','$quality',$cabinetype,'$numcabinet','$numberingbook',$isIssued)";     
    if($conn->query($sql) == true){      
      echo json_encode($conn->insert_id);     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 

//3-Get Book By ID   
if($_GET['data']=='get-bookat'){    
  $sql = "SELECT * from tblbook inner JOIN tblauthor ON tblauthor.authorid=tblbook.authorid INNER JOIN tblcabinet ON tblcabinet.cabinetid = tblbook.cabinetid where bookid=?";    
  $stmt = $conn->prepare($sql);    
  $stmt->bind_param("i",$id);    
  $id = $_GET["bookid"];    
  $stmt->execute();    
  $result = $stmt->get_result();   
  if($row=$result->fetch_assoc()){      
    $bookdata[] = array(
      $row['bookid'],
      $row['booktitle'], 
      $row['codecolorid'], 
      $row['codedeveid'],
      $row['authorid'],  
      $row['publishinghouse'], 
      $row['yearpublication'], 
      $row['datein'],  
      $row['quality'],       
      $row['cabinetid'],
      $row['numcabinet'], 
      $row['numberingbook']
    );    
  }    
  echo json_encode($bookdata);   
}
 //5-Update Book   
if($_GET['data']=='updatebook'){    
  try{ 
    $id = $_GET["id"];
    $bookid = $_GET['txtbookid'];
    $booktitle = $_GET['txtbooktitle'];
    $codecolor = $_GET["txtcodecolor"];
    $codedeve = $_GET["txtcodedeve"];
    $author = $_GET["txtauthor"];
    $publishinghouse = $_GET["txtpublishinghouse"];
    $yearpublication = $_GET["txtyearpublication"];
    $datein = $_GET["txtdatein"];
    $quality = $_GET["txtquality"];
    $cabinetype = $_GET["txtcabinetype"];
    $numcabinet = $_GET["txtnumcabinet"];
    $numberingbook = $_GET["txtnumberingbook"];
    $sql = "UPDATE tblbook SET
    bookid=$bookid, 
    booktitle='$booktitle',
    codecolorid=$codecolor,
    codedeveid=$codedeve,
    authorid=$author,
    publishinghouse='$publishinghouse',
    yearpublication=$yearpublication,
    datein='$datein',
    quality='$quality',
    cabinetid='$cabinetype',
    numcabinet='$numcabinet',
    numberingbook='$numberingbook' 
    WHERE bookid=$id; ";     
    if($conn->query($sql) == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 

//5-Delete Book   
if($_GET['data']=='deletebook'){    
  try{     
    $sql = "delete from tblbook where bookid=?";     
    $stmt = $conn->prepare($sql);     
    $stmt->bind_param("i",$id);     
    $id = $_GET["bookid"]; 

    if($stmt->execute() == true){      
      echo "success";     
    }    
  }catch(Exception $e) {     
    die($e->getMessage());    
  }   
} 

// Get ShowData to button View
if($_GET['data']=='showdata'){ 
 try{ 
  $output = '';  
  $sql = "SELECT tblbooktype_color.bookcolortype,tblbooktype_color.colorname,tblbooktype_deve.devenum, tblbook.bookid, tblbook.booktitle, tblbooktype_deve.devebooktype, tblcabinet.cabinet_type, tblauthor.authorname, tblbook.publishinghouse, tblbook.yearpublication, tblbook.datein, tblbook.quality, tblcabinet.cabinet_type, tblbook.numcabinet, tblbook.numberingbook
FROM tblcabinet INNER JOIN (tblbooktype_deve INNER JOIN (tblbooktype_color INNER JOIN (tblauthor INNER JOIN tblbook ON tblauthor.authorid = tblbook.authorid) ON tblbooktype_color.id = tblbook.codecolorid) ON tblbooktype_deve.id = tblbook.codedeveid) ON tblcabinet.cabinetid = tblbook.cabinetid WHERE bookid=" . $_GET['bookid'];  
  $result = $conn->query($sql); 
  $output .= '  
  <div class="table-responsive">  
  <table class="table table-bordered">';  
  while($row=$result->fetch_assoc()) {
   $output .= '  
   <tr>  
   <td width="30%"><label>លេខកូដសៀវភៅ</label></td>  
   <td width="70%">'.$row["bookid"].'</td>  
   </tr>
   <tr>  
   <td width="30%"><label>ចំណងជើងសៀវភៅ</label></td>  
   <td width="70%">'.$row["booktitle"].'</td>  
   </tr>
   <tr>  
   <td width="30%"><label>លេខកូដពណ៌</label></td>  
   <td width="70%">'.$row["devenum"].' / '.$row["devebooktype"].'</td>  
   </tr>
   <tr>  
   <td width="30%"><label>លេខកូដដឺវេ</label></td>  
   <td width="70%">'.$row["colorname"].' / '.$row["bookcolortype"].'</td>  
   </tr>
   <tr>  
   <td width="30%"><label>អ្នកនិពន្ធ</label></td>  
   <td width="70%">'.$row["authorname"].'</td>  
   </tr>
   <tr>  
   <td width="30%"><label>គ្រឹះស្ថានបោះពុម្ភ</label></td>  
   <td width="70%">'.$row["publishinghouse"].'</td>  
   </tr>
   <tr>  
   <td width="30%"><label>ឆ្នាំបោះពុម្ភ</label></td>  
   <td width="70%">'.$row["yearpublication"].'</td>  
   </tr>
   <tr>  
   <td width="30%"><label>ថ្ងៃខែឆ្នាំនាំចូល</label></td>  
   <td width="70%">'.$row["datein"].'</td>  
   </tr>
   <tr>  
   <td width="30%"><label>ស្ថានភាពសៀវភៅ</label></td>  
   <td width="70%">'.$row["quality"].'</td>  
   </tr>
   <tr>  
   <td width="30%"><label>ប្រភេទទូ</label></td>  
   <td width="70%">'.$row["cabinet_type"].'</td>  
   </tr>
   <tr>  
   <td width="30%"><label>លេខទូ</label></td>  
   <td width="70%">'.$row["numcabinet"].'</td>  
   </tr>
   <tr>  
   <td width="30%"><label>លេខរៀងសៀវភៅនៃទូ</label></td>  
   <td width="70%">'.$row["numberingbook"].'</td>  
   </tr>
   ';  
 }  
 $output .= "</table>
 </div>";  
 echo $output;      
}catch(Exception $e) {     
  echo $e->getMessage();    
}   
}

if(!empty($_POST["codecolorid"])) {
  $output='';
  $sql=("SELECT * FROM tblbooktype_color WHERE id=". $_POST['codecolorid']);
  $result = $conn->query($sql); 
  while($row=$result->fetch_assoc()){
    $output.='<option value="" >'.$row['bookcolortype'].'</option>';
  }
  echo $output;
}
if(!empty($_POST["codedeveid"])) {
  $output='';
  $sql=("SELECT * FROM tblbooktype_deve WHERE id=". $_POST['codedeveid']);
  $result = $conn->query($sql); 
  while($row=$result->fetch_assoc()){
    $output.='<option value="" >'.$row['devebooktype'].'</option>';
  }
  echo $output;
}
?>