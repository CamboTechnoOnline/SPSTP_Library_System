<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ប្រព័ន្ធគ្រប់គ្រង់បណ្ណាល័យ</title>
    <?php include('../include/css.php') ?>
    <link rel="icon" type="image/x-icon" href="../../image/l.png">
</head>
<body>
    <div id="wrapper">
        <?php 
        include('../include/navbar.php');
        require '../../db.php';  
        ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="page-header">ទំព័រគ្រប់គ្រងសៀវភៅ</h5>
                    </div>
                </div>
                <!-- ... Your content goes here ... -->
                <!-- Modal -->
                <button class="btn btn-success" data-toggle="modal" data-target="#form_data" onClick="addBook();"​ style="margin-bottom: 5px;">
                  បន្ថែមសៀវភៅថ្មី
              </button>

              <!-- Modal -->
              <div class="modal fade" id="form_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title" id="exampleModalLongTitle">ទម្រង់បញ្ចូលសៀវភៅថ្មី</h5>
                    </div>

                    ​​​  <div class="modal-body">
                        <form id="form-bookdata" class="form-horizontal" method="post" role="form">
                          <div class="form-group"> 
                          <label class="col-sm-3 control-label">លេខកូដ</label>                                 
                            <div class="col-sm-4">                                     
                              <input type="text" name="txtbookid" id="txtbookid" required="" />
                            </div>
                          </div>
                          <div class="form-group">
                          <label class="col-sm-3 control-label">ចំណងជើង</label>                                 
                            <div class="col-sm-9">                                     
                              <input type="text" name="txtbooktitle" id="txtbooktitle" required="" />
                            </div>
                          </div>

                      <div class="form-group">                                 
                        <label class="col-sm-3 control-label">កូដពណ៌</label>
                          <div class="col-sm-9">                                     
                            <select name="txtcodecolor" id="txtcodecolor"​​ onclick="getcolortype();" required="">
                              <option value="" disabled="">ជ្រើសរើស</option>
                              <?php 
                                $sql = ("Select * from tblbooktype_color;");
                                $result = $conn->query($sql); 
                                while($row=$result->fetch_assoc()){
                                  echo '<option value="'.$row['id'].'">'.$row['colorname'].'</option>' ;
                              }
                              ?>
                            </select>
                            </div>   
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">ប្រភេទកូដពណ៌</label>
                         <div class="col-sm-9">                                     
                              <select name="txtgetcodecolorname" id="txtgetcodecolorname" disabled="">
                              </select>
                          </div>  
                      </div>

              <div class="form-group">                                 
                  <label class="col-sm-3 control-label">កូដដឺវេ</label>                   
                    <div class="col-sm-9">                                     
                          <select name="txtcodedeve" id="txtcodedeve" onclick="getdevetype();">
                            <option value="" disabled="">ជ្រើសរើស</option>
                            <?php 
                            $sql = ("Select * from tblbooktype_deve;");
                            $result = $conn->query($sql); 
                            while($row=$result->fetch_assoc()){
                              echo '<option value="'.$row['id'].'">'.$row['devenum'].'</option>' ;
                          }
                          ?>
                      </select>
                  </div>       
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">ប្រភេទកូដដឺវេ</label>
                <div class="col-sm-9">                                     
                      <select name="txtgetcodedevename" id="txtgetcodedevename" disabled="">
                      </select>
                  </div>    
              </div>

      <div class="form-group">                                 
        <label class="col-sm-3 control-label">ឈ្មោះអ្នកនិពន្ធ</label>
        <div class="col-sm-9">                                     
          <select name="txtauthor" id="txtauthor" required="">
            <option value="" disabled="">ជ្រើសរើស</option>
            <?php 
            $sql = ("Select * from tblauthor;");
            $result = $conn->query($sql); 
            while($row=$result->fetch_assoc()){
              echo '<option value="'.$row['authorid'].'">'.$row['authorname'].'</option>' ;
          }
          ?>
      </select>
  </div>                             
</div>

<div class="form-group">                                 
    <label class="col-sm-3 control-label">គ្រឹះស្ថានបោះពុម្ភ</label>                                 
    <div class="col-sm-9">                                     
      <input type="text" name="txtpublishinghouse" id="txtpublishinghouse"/>
  </div>
</div>
<div class="form-group">                                 
    <label class="col-sm-3 control-label">ឆ្នាំបោះពុម្ភ</label>      
    <div class="col-sm-3">                                     
      <input type="text" name="txtyearpublication" id="txtyearpublication" />
  </div>                                 
  <label class="col-sm-3 control-label">ថ្ងៃខែឆ្នាំនាំចូល</label>         
  <div class="col-sm-3">                                     
   <input type="date" name="txtdatein" id="txtdatein"/>
</div>
</div>

<div class="form-group">                                 
  <label class="col-sm-3 control-label">គុណភាពសៀវភៅ</label>                                 
  <div class="col-sm-3">                                     
    <select name="txtquality" id="txtquality"​ required="">
      <option value=""​ disabled="">ជ្រើសរើស</option>
      <option value="ថ្មី">ថ្មី</option>
      <option value="មធ្យម">មធ្យម</option>
      <option value="ចាស់">ចាស់</option>

  </select> 
</div>                                 
<label class="col-sm-3 control-label">ប្រភេទទូរ</label>
<div class="col-sm-3">                                     
    <select name="txtcabinetype" id="txtcabinetype"​ required="">
      <option value="" disabled="">ជ្រើសរើស</option>
      <?php 
      $sql = ("Select * from tblcabinet;");
      $result = $conn->query($sql); 
      while($row=$result->fetch_assoc()){
        echo '<option value="'.$row['cabinetid'].'">'.$row['cabinet_type'].'</option>' ;
    }
    ?>
</select>
</div>                             
</div>

<div class="form-group">                                 
  <label class="col-sm-3 control-label">លេខទូរ</label>                 
  <div class="col-sm-3">                                     
    <input type="text" name="txtnumcabinet" id="txtnumcabinet"/>
</div>                                
<label class="col-sm-3 control-label">លេខរៀងសៀវភៅ</label>  
<div class="col-sm-3">                                     
    <input type="text" name="txtnumberingbook" id="txtnumberingbook"/>
</div>
</div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
    <button type="submit" id="btnsubmit" class="btn btn-primary">បញ្ចូល</button>
</div>
</form>
</div>
</div>
</div>
<!-- End Modal -->
<!-- DataTables Example -->
<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          ព័តមានឈ្មោះសៀវភៅទាំងអស់
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="tblshow" >
              <thead>
                <tr>
                  <th>កូដ</th>
                  <th>ចំណងជើង</th>
                  <th>គុ.ភាព</th>
                  <th>ប្រភេទទូ</th>
                  <th>ល.រទូ</th>
                  <th>ល.រសៀវភៅនៃទូ</th>
                  <th>ស្ថានភាព</th>
                  <th>កំណែប្រែសៀវភៅ</th>
              </tr>
          </thead>
      </table>
  </div>
</div>
</div>
</div>
</div>
<!-- /.table-responsive -->
<!-- modal show score all student -->
<div id="dataModal" class="modal fade">  
    <div class="modal-dialog">  
       <div class="modal-content">  
          <div class="modal-header">  
             <button type="button" class="close" data-dismiss="modal">&times;</button>  
             <h5 class="modal-title">ពត៌មានសំអិតនៃសៀវភៅ</h5>  
         </div>  
         <div class="modal-body" id="book_detail">  
         </div>  
         <div class="modal-footer">  
          <button type="button" class="btn btn-default" data-dismiss="modal">បិទ</button>  
      </div>  
  </div>  
</div> 
</div>

<!-- ...End Your content goes here ... -->
</div>
</div>
<!-- ... End wrapper ... -->
</div>
<?php include('../include/script.php') ?>
</body>
<script type="text/javascript">
//page load  
$(document).ready(function() {        
  getBookData();

});

//Function getBookData  
function getBookData(){       
  var oTable = $('#tblshow').dataTable(); 
  $.ajax({           
    url: 'bookdata.php?data=get-book',           
    dataType: 'json',           
    success: function(s){               
      console.log(s); 
      oTable.fnClearTable();               
      for(var i = 0; i < s.length; i++) {                   
        oTable.fnAddData([s[i][0], s[i][1], s[i][2], s[i][3], s[i][4],s[i][5], s[i][6], s[i][7] ]);                
    }           
}, error: function(e){                    
  console.log(e.responseText);            
}       
});
}
//add Book function  
function addBook(){
  $('#txtbookid').val(''); 
  $('#txtbooktitle').val('');       
  $('#txtcodecolor').val('');       
  $('#txtcodedeve').val('');   
  $('#txtauthor').val('');
  $('#txtpublishinghouse').val('');       
  $('#txtyearpublication').val('');
  $('#txtdatein').val('');
  $('#txtquality').val(''); 
  $('#txtcabinetype').val('');
  $('#txtgetcodecolorname').val('');
  $('#txtgetcodedevename').val('');
  $('#txtnumcabinet').val(''); 
  $('#txtnumberingbook').val('');  
  $('#btnsubmit').text('បញ្ចូល');       
  $('#form-bookdata').removeClass('form-edit');       
  $('#form-bookdata').addClass('form-add'); 
}

// submit on add  
$(document).on('submit', '#form-bookdata.form-add', function(e){ 
     var form_data = $('#form-bookdata').serialize(); 
 
     $.ajax({          
     url:          'bookdata.php?data=addbook',          
     cache:        false,          
     data:         form_data,          
     success: function(e){              
     console.log(e);              
     alert("បញ្ចូលបានជោគជ័យ");              
     getBookData();      
      $('#form_data').modal('hide');
              }, error: function(e){              
                console.log(e.responseText);           
              }        
            });      
     return false;  
 });


//Function editClass   
var bookId;  
function editBook(row){ 
   $('#btnsubmit').text('កែប្រែ');    
   $('#form-bookdata').removeClass('form-add');      
   $('#form-bookdata').addClass('form-edit');      
   bookId=row;      
     // get data to form      
     $.ajax({          
      url:        'bookdata.php?data=get-bookat',          
      data:       'bookid=' + row,        
      dataType:   'json',          
      success: function(s){              
        console.log(s);
        $('#txtbookid').val(s[0][0]);        
        $('#txtbooktitle').val(s[0][1]);               
        $('#txtcodecolor').val(s[0][2]);
        $('#txtcodedeve').val(s[0][3]);        
        $('#txtauthor').val(s[0][4]);
        $('#txtpublishinghouse').val(s[0][5]);
        $('#txtyearpublication').val(s[0][6]);
        $('#txtdatein').val(s[0][7]);
        $('#txtquality').val(s[0][8]);
        $('#txtcabinetype').val(s[0][9]);
        $('#txtnumcabinet').val(s[0][10]);
        $('#txtnumberingbook').val(s[0][11]);
    }, error: function(e){               
        console.log(e.responseText);           
    }      
});   
 }
// submit on edit  
$(document).on('submit', '#form-bookdata.form-edit', function(e){ 
  var form_data = $('#form-bookdata').serialize(); 
  $.ajax({          
    url:          'bookdata.php?data=updatebook',          
    cache:        false,          
    data:         form_data + '&id='+bookId,          
    success: function(e){              
      console.log(e);              
      alert("កែប្រែបានជោគជ័យ");              
      getBookData();           
      
      $('#form_data').modal('hide'); 
  }, error: function(e){              
      console.log(e.responseText);           
  }        
});      
  return false; 
});


//function Delete book
function deleteBook(row){ 
  var r = confirm("តើអ្នកប្រាកដហើយថាចង់លុបចេញ ?");     
  if (r == true) {             
        //proccess delete on ajax          
        $.ajax({              
          url:        'bookdata.php?data=deletebook',              
          data:       'bookid=' + row,              
          success: function(s){                  
            console.log(s);                  
            alert("លុបបានជោគជ័យ");              
        }, error: function(e){                   
            console.log(e.responseText);               
        }          
    }); 
        $("#book_"+row).parent().parent().hide("slow",function(){              
          $(this).remove();          
      });      
    }    
}

//Show more information
var bookId; function showdata(row){
  bookId = row;
  $.ajax({              
    url:        'bookdata.php?data=showdata',           
    data:       '&bookid=' +bookId,             
    success:function(data){
      $('#dataModal').modal("show");
      $('#book_detail').html(data);  
  },error: function(e){                   
      console.log(e.responseText);               
  }          
}); 
}



function getcolortype(){
  $("#loaderIcon").show();
  $.ajax({
    url: "bookdata.php",
    data:'codecolorid='+$("#txtcodecolor").val(),
    type: "POST",
    success:function(data){
        $("#txtgetcodecolorname").html(data);
        $("#loaderIcon").hide();
    },
    error:function (e){
     console.log(e.responseText);  
 }
});
}
function getdevetype(){
  $("#loaderIcon").show();
  $.ajax({
    url: "bookdata.php",
    data:'codedeveid='+$("#txtcodedeve").val(),
    type: "POST",
    success:function(data){
        $("#txtgetcodedevename").html(data);
        $("#loaderIcon").hide();
    },
    error:function (e){
     console.log(e.responseText);  
 }
});
}
</script>
</html>