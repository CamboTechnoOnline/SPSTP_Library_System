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
                        <h5 class="page-header">ទំព័រគ្រប់គ្រងសិស្ស</h5>
                    </div>
                </div>
                <!-- ... Your content goes here ... -->
                <!-- Modal -->
                <button class="btn btn-success" data-toggle="modal" 
                data-target="#form_data" onClick="addStudent();"​ style="margin-bottom: 5px;">
                បន្ថែមសិស្សថ្មី
            </button>

            <!-- Modal -->
            <div class="modal fade" id="form_data" tabindex="-1" role="dialog" 
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title" id="exampleModalLongTitle">ទម្រង់បញ្ចូលសិស្សថ្មី</h5>
                    </div>
                    ​​​  <div class="modal-body">
                        <form name="signup" method="POST" id="form-studentdata" onSubmit="return valid();">
                            <div class="form-group row">
                              <label for="user_name" class="col-md-3 col-form-label text-md-right">ឈ្មោះគណនី</label>
                              <div class="col-md-9">
                                <input type="text" id="username" name="username" onBlur="checkAvailability()" autocomplete="off" required>
                                <span id="user-availability-status" style="font-size:12px;"></span> 
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label text-md-right">ភេទ</label>
                          <div class="col-md-9">
                            <select name="txtgender"​ id="txtgender">
                              <option value="" disabled="">ជ្រើសរើស</option​>
                                <option value="ប្រុស">ប្រុស</option>
                                <option value="ស្រី">ស្រី</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_name" class="col-md-3 col-form-label text-md-right">លេខសម្ងាត់</label>
                        <div class="col-md-9">
                          <input type="password" id="txtpassword" name="txtpassword" autocomplete="off" required>
                      </div>
                  </div>
              <div class="form-group row">
                <label for="phone_number" class="col-md-3 col-form-label text-md-right">លេខទូរស័ព្ទ</label>
                <div class="col-md-9">
                  <input type="text" id="txtphone" name="txtphone">
              </div>
          </div>

          <div class="form-group row">
            <label for="phone_number" class="col-md-3 col-form-label text-md-right">ឈ្មោះគ្រូបង្រៀន</label>
            <div class="col-md-9">
              <select name="txtteachername"​ id="txtteachername">
                <option value="" disabled="">ជ្រើសរើស</option>
                <?php
                include('db.php');
                $sql = ("Select * from tblteacher;");
                $result = $conn->query($sql); 
                while($row=$result->fetch_assoc()){
                  echo '<option value="'.$row['teacherid'].'">'.$row['teachername'].'</option>' ;
              }
              ?>
          </select>
      </div>
  </div>
  <div class="form-group row">
      <label class="col-md-3 col-form-label text-md-right">ស្ថានភាព</label>
      <div class="col-md-9">
        <select name="txtstatus"​ id="txtstatus">
            <option value="" disabled="">ជ្រើសរើស</option​>
                <option value="0">ផ្អាកដំណើរការ</option>
                <option value="1">ដំណើរការ</option>
            </select>
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
            <div class="panel-heading">ព័តមានឈ្មោះថ្នាក់ទាំងអស់</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table style="text-align: center;" class="table table-striped table-bordered table-hover" id="tblshow">
                        <thead>
                            <tr>
                                <th>អត្តលេខ</th>
                                <th>ឈ្មោះ</th>
                                <th>ភេទ</th>
                                <th>លេខទូរស័ព្ទ</th>
                                <th>គ្រូបង្រៀន</th>
                                <th>ស្ថានភាព</th>
                                <th>កំណែប្រែ</th>
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
    getStudentData();  
});

function checkAvailability() {
    jQuery.ajax({
      url: "../../HomePage/check_availability.php",
      data:'username='+$("#username").val(),
      type: "POST",
      success:function(data){
        $("#user-availability-status").html(data);
    },
    error:function (){}
});
}

 //Function getCourseData  
 function getStudentData(){       
    var oTable = $('#tblshow').dataTable(); 
    $.ajax({           
        url: 'studentdata.php?data=get-student',           
        dataType: 'json',           
        success: function(s){               
            console.log(s); 
            oTable.fnClearTable();               
            for(var i = 0; i < s.length; i++) {                   
                oTable.fnAddData([s[i][0], s[i][1], s[i][2],s[i][3], s[i][4], s[i][5], s[i][6] ]);                
            }           
        }, error: function(e){                    
          console.log(e.responseText);            
      }          
  });  
}

//Function addStudent
function addStudent(){       
 $('#username').val('');
 $('#txtgender').val('');
 $('#txtpassword').val('');
 $('#txtphone').val('');
 $('#txtteachername').val('');
 $('#txtstatus').val('');
 $('#btnsubmit').text('បញ្ចូល');       
 $('#form-studentdata').removeClass('form-edit');       
 $('#form-studentdata').addClass('form-add');  
}

// submit on add Class To datatable
$(document).on('submit', '#form-studentdata.form-add', function(e){   
 e.preventDefault();      
 var form_data = new FormData($("#form-studentdata")[0]);      
 $.ajax({          
   url:          'studentdata.php?data=get-addstudent',          
   type:         "POST",          
   data:         form_data,          
   contentType: false,          
   cache: false,          
   processData:false,          
   success: function(e){              
     console.log(e); 
     alert("Insert Successfully");
     getStudentData();      
     $('#form_data').modal('hide'); 
 }, error: function(e){              
    console.log(e.responseText);           
}        
});      
 return false;  
}); 

//Function Get Data To editClass  
var studentId;  
function editStudent(row){ 
    $('#btnsubmit').text('កែប្រែ');      
    $('#form-studentdata').removeClass('form-add');      
    $('#form-studentdata').addClass('form-edit');      
    studentId=row;      
     // get data to form      
    $.ajax({          
        url:        'studentdata.php?data=get-studentat',          
        data:       'studentid=' + row,          
        dataType:   'json', 
        success: function(s){              
            console.log(s);        
            $('#username').val(s[0][1]);
            $('#txtgender').val(s[0][2]);
            $('#txtpassword').val(s[0][3]);  
            $('#txtteachername').val(s[0][4]);
            $('#txtphone').val(s[0][5]);
            $('#txtstatus').val(s[0][6]);
          }, error: function(e){               
            console.log(e.responseText);           
        }      
    });  
}
// submit on edit  
$(document).on('submit', '#form-studentdata.form-edit', function(e){ 
   var form_data = $('#form-studentdata').serialize(); 
    $.ajax({          
        url:          'studentdata.php?data=updatestudent',          
        cache:        false,          
        data:         form_data + '&id='+studentId,          
        success: function(e){              
        console.log(e);              
        alert("កែប្រែបានជោគជ័យ");              
       getStudentData(); 
        $('#form_data').modal('hide'); 
    }, error: function(e){              
      console.log(e.responseText);           
    }        
   });      
   return false;  
});

//Delete Class  
function deleteStudent(row){ 
   var r = confirm("តើអ្នកប្រាកដហើយថាចង់លុបចេញ ?");     
   if (r == true) {             
        //proccess delete on ajax          
        $.ajax({              
           url:        'studentdata.php?data=deletestudent',              
           data:       'studentid=' + row,              
           success: function(s){                  
                console.log(s);                  
                alert("លុបបានជោគជ័យ");              
          }, error: function(e){                   
            console.log(e.responseText);               
          }          
        });
        $("#student_"+row).parent().parent().hide("slow",function(){              
          $(this).remove();          
        });      
    }    
}
</script>
</html>
