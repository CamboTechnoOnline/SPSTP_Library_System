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
                        <h5 class="page-header">ទំព័រគ្រប់គ្រងគ្រូបង្រៀន</h5>
                    </div>
                </div>
                <!-- ... Your content goes here ... -->
                <!-- Modal -->
                <button class="btn btn-success" data-toggle="modal" 
                data-target="#form_data" onClick="addTeacher();"​ style="margin-bottom: 5px;">
                បន្ថែមគ្រូថ្មី
            </button>

            <!-- Modal -->
            <div class="modal fade" id="form_data" tabindex="-1" role="dialog" 
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title" id="exampleModalLongTitle">ទម្រង់បញ្ចូលគ្រូថ្មី</h5>
                    </div>
                    ​​​ <div class="modal-body">
                        <form id="form-teacherdata" class="form-horizontal" method="post" role="form">
                            <div class="form-group">                                 
                                <label class="col-sm-3 control-label">ឈ្មោះគ្រូ</label>                 
                                <div class="col-sm-9">                                     
                                    <input type="text" name="txtteachername" id="txtteachername"/>
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
                                <label class="col-sm-3 control-label">កាន់ថ្នាក់</label>                 
                                <div class="col-sm-3">
                                    <select name="txtclassteacher" id="txtclassteacher" required="">
                                        <option value="">ជ្រើសរើស</option>
                                        <?php 
                                        $sql = ("Select * from tblclass;");
                                        $result = $conn->query($sql); 
                                        while($row=$result->fetch_assoc()){
                                          echo '<option value="'.$row['classid'].'">'.$row['classname'].'</option>' ;
                                      }
                                      ?>
                                  </select> 
                              </div>
                          </div>
                          <div class="form-group">                                 
                           <label class="col-md-3 control-label">ពេលបង្រៀន</label>         
                           <div class="col-sm-3">
                            <select name="txttimeteach" id="txttimeteach" required="">
                                <option value="" disabled="" >ជ្រើសរើស</option>
                                <option value="ព្រឹក">ព្រឹក</option>
                                <option value="រសៀល">រសៀល</option>
                                <option value="ពេញម៉ោង">ពេញម៉ោង</option>
                            </select> 
                        </div>
                        <label class="col-sm-3 control-label">បង្រៀនភាសា</label>                 
                        <div class="col-sm-3">
                           <select name="txtteachlanguage" id="txtteachlanguage" required="">
                            <option value="" disabled="">ជ្រើសរើស</option>
                            <option value="ភាសាខ្មែរ">ភាសាខ្មែរ</option>
                            <option value="ភាសាអង់គ្លេស">ភាសាអង់គ្លេស</option>
                        </select>
                    </div> 
                </div>
                <div class="form-group">                                 
                    <label class="col-md-3 control-label">លេខទូរស័ព្ទ</label>         
                    <div class="col-sm-9">
                     <input type="text" name="txtphone" id="txtphone"/>
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
                                <th>លេខរៀង</th>
                                <th>ឈ្មោះគ្រូ</th>
                                <th>ភេទ</th>
                                <th>កាន់ថ្នាក់</th>
                                <th>ពេលបង្រៀន</th>
                                <th>បង្រៀនភាសា</th>
                                <th>លេខទូរស័ព្ទ</th>
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
 //page load  
 $(document).ready(function() {        
    getTeacherData();  
});   
 //Function getCourseData  
 function getTeacherData(){       
    var oTable = $('#tblshow').dataTable(); 
    $.ajax({           
        url: 'teacherdata.php?data=get-teacher',           
        dataType: 'json',           
        success: function(s){               
            console.log(s); 
            oTable.fnClearTable();               
            for(var i = 0; i < s.length; i++) {                   
                oTable.fnAddData([s[i][0], s[i][1], s[i][2],s[i][3] ,s[i][4] ,s[i][5] ,s[i][6],s[i][7] ]);                
            }           
        }, error: function(e){                    
          console.log(e.responseText);            
      }          
  });  
}

//Function clear data addTeacher  
function addTeacher(){       
    $('#txtteachername').val('');
    $('#txtgender').val('');
    $('#txtclass').val('');
    $('#txttimeteach').val('');
    $('#txtteachlanguage').val('');
    $('#txtphone').val('');
    $('#btnsubmit').text('បញ្ចូល');       
    $('#form-teacherdata').removeClass('form-edit');       
    $('#form-teacherdata').addClass('form-add');  
}
// submit on add  
$(document).on('submit', '#form-teacherdata.form-add', function(e){ 
   var form_data = $('#form-teacherdata').serialize(); 
    $.ajax({          
        url:          'teacherdata.php?data=addteacher',          
        cache:        false,          
        data:         form_data,          
        success: function(e){              
            console.log(e);              
            alert("បញ្ចូលបានជោគជ័យ");              
            getTeacherData();      
            $('#form_data').modal('hide');
        }, error: function(e){              
          console.log(e.responseText);           
        }        
    });      
    return false;  
});

//Function Get Data To editClass  
var teacherId;  
function editTeacher(row){ 
    $('#btnsubmit').text('កែប្រែ');      
    $('#form-teacherdata').removeClass('form-add');      
    $('#form-teacherdata').addClass('form-edit');      
    teacherId=row;      
     // get data to form      
    $.ajax({          
        url:        'teacherdata.php?data=get-teacherat',          
        data:       'teacherid=' + row,          
        dataType:   'json', 
        success: function(s){              
            console.log(s);        
            $('#txtteachername').val(s[0][1]);
            $('#txtgender').val(s[0][2]);
            $('#txtclassteacher').val(s[0][3]);
            $('#txttimeteach').val(s[0][4]);
            $('#txtteachlanguage').val(s[0][5]);
            $('#txtphone').val(s[0][6]); 
          }, error: function(e){               
            console.log(e.responseText);           
        }      
    });  
}

// submit on edit Class To datatable  
$(document).on('submit', '#form-teacherdata.form-edit', function(e){ 
 e.preventDefault();      
 var form_data = new FormData($("#form-teacherdata")[0]);      
 form_data.append('teacherid', teacherId); 
 $.ajax({          
   url:          'teacherdata.php?data=updateteacher',          
   type:         "POST",          
   data:         form_data,          
   contentType: false,          
   cache: false,          
   processData:false,          
   success: function(e){              
     console.log(e);              
     alert("កែប្រែបានជោគជ័យ");              
     getTeacherData();   
    $('#form_data').modal('hide'); 
  }, error: function(e){              
    console.log(e.responseText);           
  }        
});      
 return false;  
});

//Delete Teacher  
function deleteTeacher(row){ 
   var r = confirm("តើអ្នកប្រាកដហើយថាចង់លុបចេញ ?");     
   if (r == true) {             
        //proccess delete on ajax          
        $.ajax({              
           url:        'teacherdata.php?data=deleteteacher',              
           data:       'teacherid=' + row,              
           success: function(s){                  
                console.log(s);                  
                alert("លុបបានជោគជ័យ");              
          }, error: function(e){                   
            console.log(e.responseText);               
          }          
        });
          getTeacherData();  
        $("#teacher_"+row).parent().parent().hide("slow",function(){              
          $(this).remove();          
        });      
    }    
}  
</script>
</html>
