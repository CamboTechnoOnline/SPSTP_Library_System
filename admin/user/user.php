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
                        <h5 class="page-header">ទំព័រគ្រប់គ្រងអ្នកប្រើប្រាស់ប្រព័ន្ធ</h5>
                    </div>
                </div>
                <!-- ... Your content goes here ... -->
                    <!-- Modal -->
                  <button class="btn btn-success" data-toggle="modal" data-target="#form_data" onClick="addUser();"​ style="margin-bottom: 5px;">
                    បន្ថែមអ្នកប្រើប្រាស់ប្រព័ន្ធថ្មី
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="form_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h5 class="modal-title" id="exampleModalLongTitle">ទម្រង់បញ្ចូលអ្នកប្រើប្រាស់ថ្មី</h5>
                        </div>
                        ​​​  <div class="modal-body">
                          <form id="form-userdata" class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
                            <div class="form-group">                                 
                              <label class="col-sm-3 control-label">ឈ្មោះ</label>         
                              <div class="col-sm-9">                                     
                                <input type="text" name="txtname" id="txtname" value="" required="" />
                              </div>                             
                            </div>
                            <div class="form-group">                                 
                              <label class="col-md-3 control-label">ភេទ</label>         
                              <div class="col-sm-3">
                                <select name="txtgender" id="txtgender" required="">
                                  <option value="" disabled="">ជ្រើសរើស</option>
                                  <option value="ប្រុស">ប្រុស</option>
                                  <option value="ស្រី">ស្រី</option>
                                </select> 
                              </div>
                              <label class="col-sm-3 control-label">លេខទូរស័ព្ទ</label>         
                              <div class="col-sm-3">                                     
                                <input type="text" name="txtphone" id="txtphone" value="" required="" />
                              </div>                                       
                            </div>
                            <div class="form-group">                                 
                              <label class="col-sm-3 control-label">អាស័យដ្ឋាន</label>         
                              <div class="col-sm-3">                                     
                                <input type="text" name="txtaddress" id="txtaddress" value="" />
                              </div>
                              <label class="col-sm-3 control-label">ប្រភេទអ្នកប្រើប្រាស់</label>         
                              <div class="col-sm-3">                                     
                                <select name="txtusertype" id="txtusertype" required="">
                                  <option value=""​disabled="">ជ្រើសរើស</option>
                                  <option value="user">បណ្ណារ័ក្ស</option>
                                  <option value="admin">Admin</option>
                                </select>
                              </div>                                     
                            </div>
                            <div class="form-group">                                 
                              <label class="col-sm-3 control-label">ឈ្មោះគណនី</label>         
                              <div class="col-sm-3">                                     
                                <input type="text" name="txtusername" id="txtusername" value="" required="" />
                              </div>                                         
                              <label class="col-sm-3 control-label">លេខសំងាត់</label>         
                              <div class="col-sm-3">                                     
                                <input type="password" name="txtpassword" id="txtpassword" value="" required="" />
                              </div>                             
                            </div>

                            <div class="form-group">      
                              <label class="col-sm-3 control-label">រូបភាព</label>         
                              <div class="col-sm-9">                                     
                               <input type="file" id="txtphoto" name="txtphoto" />                                  
                               <input type="hidden" name="txtphotoname" id="txtphotoname" class="form-control" value="" />                   
                             </div>
                           </div>
                         </div>
                         <div class="modal-footer">
                          <button type="submit" id="btnsubmit" class="btn btn-primary">បញ្ចូល</button>            
                          <button type="reset" class="btn btn-default" data-dismiss="modal">បោះបង់</button>
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
                        ព័តមានឈ្មោះថ្នាក់ទាំងអស់
                      </div>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                        <div class="table-responsive">
                          <table style="text-align: center;" class="table table-striped table-bordered table-hover" id="tblshow">
                            <thead>
                              <tr>
                                <th>លេខរៀង</th>
                                <th>ឈ្មោះផ្ទាល់ខ្លួន</th>
                                <th>ភេទ</th>
                                <th>អាស័យដ្ឋាន</th>
                                <th>ឈ្មោះគណនី</th>
                                <th>រូបភាព</th>
                                <th>លេខទូរស័ព្ទ</th>
                                <th>ប្រភេទអ្នកប្រើប្រាស់</th>
                                <th>កំណែប្រែទន្និន័យ</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                      <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                  </div>
                  <!-- /.col-lg-12 -->
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
    //page load  
    $(document).ready(function() {        
      getUserData();
      $("#txtphoto").fileinput('refresh',{ 
        showUpload: false,
        showCaption: false,                                     
        browseClass: "btn btn-primary",                             
        fileType: "any"               
      });                       
    //Event Change on txtphoto   
    $("#txtphoto").change(function() {                   
      var photo = $('#txtphoto').prop('files')[0];           
      if(photo!=null){            
        $('#txtphotoname').val(photo.name);           
      }else{            
        $('#txtphotoname').val('');           
      }       
    });   
  });

  //Function getCourseData  
function getUserData(){       
  var oTable = $('#tblshow').dataTable(); 
  $.ajax({           
    url: 'userdata.php?data=get-user',           
    dataType: 'json',           
    success: function(s){               
      console.log(s); 
      oTable.fnClearTable();               
      for(var i = 0; i < s.length; i++) { 
        var photo = "<img src='../../image/" + s[i][5] + "' width='90px' height='70px'>";   
        oTable.fnAddData([s[i][0], s[i][1], s[i][2], s[i][3], s[i][4],photo,s[i][6], s[i][7],s[i][8] ]);            
      }           
    }, error: function(e){                    
      console.log(e.responseText);            
    }       
  });  
}
//addUser function  
function addUser(){       
  $('#txtname').val('');       
  $('#txtgender').val('');       
  $('#txtaddress').val('');       
  $('#txtusername').val('');
  $('#txtpassword').val('');        
  $('#txtphoto').fileinput('clear');       
  $('#txtphotoname').val('');
  $('#txtphone').val(''); 
  $('#txtusertype').val('');  
  $('#btnsubmit').text('បញ្ចូល');       
  $('#form-userdata').removeClass('form-edit');       
  $('#form-userdata').addClass('form-add');  
} 

// submit on add Class To datatable
$(document).on('submit', '#form-userdata.form-add', function(e){   
 e.preventDefault();      
 var form_data = new FormData($("#form-userdata")[0]);      
 $.ajax({          
   url:          'userdata.php?data=get-adduser',          
   type:         "POST",          
   data:         form_data,          
   contentType: false,          
   cache: false,          
   processData:false,          
   success: function(e){              
     console.log(e);              
     alert("Insert Successfully");
     getUserData();      
    $('#form_data').modal('hide'); 
  }, error: function(e){              
    console.log(e.responseText);           
  }        
});      
 return false;  
}); 
//editUser function On Datatable  
var userId;  function editUser(row){ 
  $('#btnsubmit').text('កែប្រែ');      
  $('#form-userdata').removeClass('form-add');      
  $('#form-userdata').addClass('form-edit');      
  userId=row;      
     // get data to form      
     $.ajax({          
      url:        'userdata.php?data=get-userat',          
      data:       'userid=' + row,        
      dataType:   'json',          
      success: function(s){              
        console.log(s);              
        $('#txtname').val(s[0][0]);        
        $('#txtgender').val(s[0][1]);        
        $('#txtaddress').val(s[0][2]);          
        $('#txtusername').val(s[0][3]);        
        $('#txtpassword').val(s[0][4]);
        $('#txtphotoname').val(s[0][5]);        
        if (s[0][5]!=null) {                  
          $("#txtphoto").fileinput('refresh',{                          
            initialPreview: [                             
            "<img src='../../image/" + s[0][5] + "' class='file-preview-image' title='Image' width='120' height='120px' >"                   
            ],                         
            showUpload: false,                         
            showCaption: false,                         
            browseClass: "btn btn-danger",                         
            fileType: "any"                     
          });              
        } else {                  
          $("#txtphoto").fileinput('clear');              
        }        
        $('#txtphone').val(s[0][6]);
        $('#txtusertype').val(s[0][7]);         
      }, error: function(e){               
        console.log(e.responseText);           
      }      
    });  
   } 
// submit on edit Class To datatable  
$(document).on('submit', '#form-userdata.form-edit', function(e){ 
 e.preventDefault();      
 var form_data = new FormData($("#form-userdata")[0]);      
 form_data.append('userid', userId); 
 $.ajax({          
   url:          'userdata.php?data=updateuser',          
   type:         "POST",          
   data:         form_data,          
   contentType: false,          
   cache: false,          
   processData:false,          
   success: function(e){              
     console.log(e);              
     alert("Update Successfully");              
     getUserData();   
    $('#form_data').modal('hide'); 
  }, error: function(e){              
    console.log(e.responseText);           
  }        
});      
 return false;  
}); 

//deleteUser function  
function deleteUser(row){   
  var txt;     
  var r = confirm("Are you sure");     
  if (r == true) {             
        //proccess delete on ajax          
        $.ajax({              
          url:        'userdata.php?data=deleteuser',              
          data:       'userid=' + row,              
          success: function(s){                  
            console.log(s);                  
            alert("Delete Successfully");              
          }, error: function(e){                   
            console.log(e.responseText);               
          }          
        }); 
        $("#user_"+row).parent().parent().hide("slow",function(){ 
          $(this).remove();          
        });      
      }    
    } 
</script>
</html>