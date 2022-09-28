<?php 
require 'db.php';
//1-Get User   
if($_GET['data']=='get-book'){    
  $sql = "SELECT bookid,booktitle,quality,cabinet_type,authorname,numcabinet,numberingbook,isIssued from tblbook inner JOIN tblauthor ON tblauthor.authorid=tblbook.authorid INNER JOIN tblcabinet ON tblcabinet.cabinetid = tblbook.cabinetid;";    
  $result = $conn->query($sql); 
  while($row=$result->fetch_assoc()){      

   $option = '<a href="" id="book_'.$row['bookid'].'" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="showdata('. $row['bookid'] .');">ព័ត៌មានលំអិត</a>'; 
  $output='';
   if($row['isIssued'] == 0){
     $output.='<p class="btn btn-success btn-sm">ទំនេរ</p>';
   }else{
    $output.='<p class="btn btn-danger btn-sm">មិនទំនេរ</p>';
   }
  
   $Bookdata[] = array($row['bookid'], $row['booktitle'], $row['quality'], $row['cabinet_type'], $row['numcabinet'], $row['numberingbook'],$output, $option); 
  
 } 

 echo json_encode($Bookdata);   
}
// Get ShowData to button View
if($_GET['data']=='showdata'){ 
 try{ 
  $output = '';  
  $sql = "SELECT bookid,booktitle,quality,cabinet_type,authorname,numcabinet,numberingbook,devenum,devebooktype,colorname,bookcolortype,publishinghouse,yearpublication,datein from tblbook inner JOIN tblauthor ON tblauthor.authorid=tblbook.authorid INNER JOIN tblcabinet ON tblcabinet.cabinetid = tblbook.cabinetid INNER JOIN tblbooktype_deve ON tblbooktype_deve.id=tblbook.codedeveid INNER JOIN tblbooktype_color ON tblbooktype_color.id=tblbook.codecolorid WHERE bookid=" . $_GET['bookid'];  
  $result = $conn->query($sql); 
  $output .= '  
  <div class="table-responsive">  
  <table class="table table-bordered">';  
  while($row=$result->fetch_assoc()) {
   $output .= '  
   <tr>  
   <td width="40%"><label>លេខកូដសៀវភៅ</label></td>  
   <td width="60%">'.$row["bookid"].'</td>  
   </tr>
   <tr>  
   <td width="40%"><label>ចំណងជើងសៀវភៅ</label></td>  
   <td width="60%">'.$row["booktitle"].'</td>  
   </tr>
   <tr>  
   <td width="40%"><label>លេខកូដពណ៌</label></td>  
   <td width="60%">'.$row["devenum"].' / '.$row["devebooktype"].'</td>  
   </tr>
   <tr>  
   <td width="40%"><label>លេខកូដដឺវេ</label></td>  
   <td width="60%">'.$row["colorname"].' / '.$row["bookcolortype"].'</td>  
   </tr>
   <tr>  
   <td width="40%"><label>អ្នកនិពន្ធ</label></td>  
   <td width="60%">'.$row["authorname"].'</td>  
   </tr>
   <tr>  
   <td width="40%"><label>គ្រឹះស្ថានបោះពុម្ភ</label></td>  
   <td width="60%">'.$row["publishinghouse"].'</td>  
   </tr>
   <tr>  
   <td width="40%"><label>ឆ្នាំបោះពុម្ភ</label></td>  
   <td width="60%">'.$row["yearpublication"].'</td>  
   </tr>
   <tr>  
   <td width="40%"><label>ថ្ងៃខែឆ្នាំនាំចូល</label></td>  
   <td width="60%">'.$row["datein"].'</td>  
   </tr>
   <tr>  
   <td width="40%"><label>ស្ថានភាពសៀវភៅ</label></td>  
   <td width="60%">'.$row["quality"].'</td>  
   </tr>
   <tr>  
   <td width="40%"><label>ប្រភេទទូ</label></td>  
   <td width="60%">'.$row["cabinet_type"].'</td>  
   </tr>
   <tr>  
   <td width="40%"><label>លេខទូ</label></td>  
   <td width="60%">'.$row["numcabinet"].'</td>  
   </tr>
   <tr>  
   <td width="40%"><label>លេខរៀងសៀវភៅនៃទូ</label></td>  
   <td width="60%">'.$row["numberingbook"].'</td>  
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
?>