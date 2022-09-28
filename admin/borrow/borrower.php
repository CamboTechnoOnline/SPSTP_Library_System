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
                        <h5 class="page-header">ទំព័រគ្រប់គ្រងសិស្សខ្ចីសៀវភៅ</h5>
                    </div>
                </div>
        <!-- ... Your content goes here ... -->
        <!-- Modal -->
        <button class="btn btn-success" data-toggle="modal" 
            data-target="#form_data" style="margin-bottom: 5px;" onclick="addborrow();">
            បញ្ចូលសិស្សខ្ចីសៀវភៅ
        </button>
        <!-- Modal Add -->
        <div class="modal fade" id="form_data" tabindex="-1" role="dialog" 
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title" id="exampleModalLongTitle">ទម្រង់បញ្ចូលសិស្សខ្ចីសៀវភៅ</h5>
                    </div>
                    ​​​  <div class="modal-body">
                            <form id="form-borrowdata" class="form-horizontal" method="post" role="form">
                                <div class="form-group">                                 
                                    <label class="col-sm-3 control-label">អត្តលេខសិស្ស</label>               
                                    <div class="col-sm-4">
                                        <input type="text" name="txtstudentid" id="txtstudentid" onBlur="getstudentname();" required=""/>
                                    </div>
                                    <div class="col-sm-5">                                     
                                      <select name="txtgetstudentname" id="txtgetstudentname" disabled="">
                                      </select>
                                    </div>                     
                                </div>

                                <div class="form-group">                                 
                                    <label class="col-sm-3 control-label">លេខកូដសៀវភៅ</label>               
                                    <div class="col-sm-4">
                                        <input type="text" name="txtbookid" id="txtbookid" onBlur="getbookname();" required=""/>
                                    </div>
                                    <div class="col-sm-5">                                     
                                      <select name="txtgetbookname" id="txtgetbookname" disabled="">
                                      </select>
                                    </div>                     
                                </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">កាលបរិច្ឆេទខ្ចី</label>               
                                <div class="col-sm-9">
                                    <input type="date" name="txtdateborrow" id="txtdateborrow" required=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">កាលបរិច្ឆេទសង</label>               
                                <div class="col-sm-9">
                                    <input type="date" name="txtdatereturn" id="txtdatereturn" required=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">ស្ថានភាព</label>               
                                <div class="col-sm-9">
                                    <select name="txtreturnstatus" id="txtreturnstatus"​>
                                        <option value="" disabled="">ជ្រើសរើស</option>
                                        <option value="0">មិនទាន់សង</option>
                                        <option value="1">សងរូចរាល់</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">ឆ្នាំសិក្សា</label>               
                                <div class="col-sm-9">
                                    <select name="txtyear" id="txtyear"​ required="">
                                        <option value="" disabled="">ជ្រើសរើស</option>
                                        <?php 
                                            $sql = ("Select * from tbl_year");
                                            $result = $conn->query($sql); 
                                            while($row=$result->fetch_assoc()){
                                                echo '<option value="'.$row['id'].'">'.$row['studyyear'].'</option>' ;
                                            }
                                        ?>
                                    </select>
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
        </div>
<!-- End Modal Add -->

<!-- DataTables Example -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">ព័តមានឈ្មោះថ្នាក់ទាំងអស់</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table style="text-align: center;" class="table table-striped table-bordered table-hover" id="tblshow">
                        <thead>
                            <tr>
                                <th>កូដសិស្ស</th>
                                <th>ឈ្មោះសិស្ស</th>
                                <th>កូដស.ភ</th>
                                <th>ចំ.ជើង</th>
                                <th>កាលបរិច្ឆេទខ្ចី</th>
                                <th>កាលបរិច្ឆេទសង</th>
                                <th>ស្ថានភាពថ្ងៃសង</th>
                                <th>ស្ថានភាព</th>
                                <th>ឆ្នាំសិក្សា</th>
                                <th>កែប្រែ</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.table-responsive -->


<!-- ...End Your content goes here ... -->
</div>
</div>

<!-- ... End wrapper ... -->
</div>
<?php include('../include/script.php') ?>
</body>
<script type="text/javascript">
    $(document).ready(function() {        
      getBookBorrowData();
  });
//Function getBookData  
function getBookBorrowData(){       
  var oTable = $('#tblshow').dataTable(); 
  $.ajax({           
    url: 'borrowdata.php?data=get-bookborrow',           
    dataType: 'json',           
    success: function(s){               
      console.log(s); 
      oTable.fnClearTable();               
      for(var i = 0; i < s.length; i++) {                   
        oTable.fnAddData([s[i][0], s[i][1], s[i][2], s[i][3],s[i][4],s[i][5],s[i][6],s[i][7],s[i][8],s[i][9],s[i][10] ]);                
    }           
}, error: function(e){                    
  console.log(e.responseText);            
}       
});
}
//add Book function  
function addborrow(){
    $('#txtstudentid').val('');
    $('#txtstudentid').prop('readonly', false);       
    $('#txtgetstudentname').val(0);  
    $('#txtbookid').val(''); 
    $('#txtbookid').prop('readonly', false);
    $('#txtgetbookname').val(0);
    $('#txtdatereturn').val('');
    $('#txtdateborrow').val('');
    $('#txtyear').val('');
    $('#btnsubmit').text('បញ្ចូល');
    $('#txtreturnstatus').val('');
    $('#btnsubmit').prop('disabled',false); 
    $('#txtstudentid').prop('disabled',false); 
    $('#txtbookid').prop('disabled',false); 
    $('#txtreturnstatus').prop('disabled',true);    
    $('#form-borrowdata').removeClass('form-edit');       
    $('#form-borrowdata').addClass('form-add');
}
// submit on add  
$(document).on('submit', '#form-borrowdata.form-add', function(e){ 
   var form_data = $('#form-borrowdata').serialize(); 

   $.ajax({          
       url:          'borrowdata.php?data=addborrow',          
       cache:        false,          
       data:         form_data,          
       success: function(e){              
           console.log(e);              
           alert("បញ្ចូលបានជោគជ័យ");              
           getBookBorrowData();      
           $('#form_data').modal('hide');
       }, error: function(e){              
        console.log(e.responseText);           
    }        
});      
   return false;  
});
$(document).on('submit', '#form-borrowdata.form-add', function(e){ 
   var form_data = $('#form-borrowdata').serialize(); 

   $.ajax({          
       url:          'borrowdata.php?data=editbook',          
       cache:        false,          
       data:         form_data,          
       success: function(e){              
           console.log(e);                           
           getBookBorrowData();      
           $('#form_data').modal('hide');
       }, error: function(e){              
        console.log(e.responseText);           
    }        
});      
   return false;  
});

//Function getdata to textbox  
var borrowId;  
function editBorrow(row){ 
   $('#btnsubmit').text('កែប្រែ');    
   $('#form-borrowdata').removeClass('form-add');      
   $('#form-borrowdata').addClass('form-edit'); 
   borrowId=row;      
     // get data to form      
     $.ajax({          
      url:        'borrowdata.php?data=get-borrowat',          
      data:       'id=' + row,        
      dataType:   'json',          
      success: function(s){              
        console.log(s);        
        $('#txtstudentid').val(s[0][0]);
        $('#txtstudentid').prop('readonly', true);        
        $('#txtgetstudentname').val(s[0][1]);
        $('#txtdateborrow').prop('disabled',true);  
        $('#txtbookid').val(s[0][2]); 
        $('#txtbookid').prop('readonly', true);
        $('#txtgetbookname').val(s[0][3]);
        $('#txtdateborrow').val(s[0][4]);
        $('#txtdatereturn').val(s[0][5]);
        $('#btnsubmit').prop('disabled',false); 
        $('#txtreturnstatus').prop('disabled',false);  
        $('#txtreturnstatus').val(s[0][6]);
        $('#txtyear').val(s[0][7]);
    }, error: function(e){               
        console.log(e.responseText);           
    }      
});   
 }

// submit on edit  
$(document).on('submit', '#form-borrowdata.form-edit', function(e){ 
  var form_data = $('#form-borrowdata').serialize(); 
  $.ajax({          
    url:          'borrowdata.php?data=updateborrow',          
    cache:        false,          
    data:         form_data + '&id='+borrowId,          
    success: function(e){              
      console.log(e);              
      alert("កែប្រែបានជោគជ័យ");              
      getBookBorrowData();
      $('#form_data').modal('hide'); 
  }, error: function(e){              
      console.log(e.responseText);           
  }        
});      
  return false; 
});

// submit on edit  
$(document).on('submit', '#form-borrowdata.form-edit', function(e){ 
  var form_data = $('#form-borrowdata').serialize(); 
  $.ajax({          
    url:          'borrowdata.php?data=editisIssuedbook',          
    cache:        false,          
    data:         form_data + '&id='+borrowId,          
    success: function(e){              
      console.log(e);                        
      getBookBorrowData();
      $('#form_data').modal('hide'); 
  }, error: function(e){              
      console.log(e.responseText);           
  }        
});      
  return false; 
});

function getbookname(){
  $("#loaderIcon").show();
  $.ajax({
    url: "borrowdata.php",
    data:'bookid='+$("#txtbookid").val(),
    type: "POST",
    success:function(data){
        $("#txtgetbookname").html(data);
        $("#loaderIcon").hide();
    },
    error:function (e){
     console.log(e.responseText);  
 }
});
}

function getstudentname(){
  $("#loaderIcon").show();
  $.ajax({
    url: "borrowdata.php",
    data:'studentid='+$("#txtstudentid").val(),
    type: "POST",
    success:function(data){
        $("#txtgetstudentname").html(data);
        $("#loaderIcon").hide();
    },
    error:function (e){
     console.log(e.responseText);  
 }
});
}

</script>
</html>
