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
                        <h5 class="page-header">ទំព័រគ្រប់គ្រងថ្នាក់រៀន</h5>
                    </div>
                </div>
                <!-- ... Your content goes here ... -->
                <!-- Modal -->
                <button class="btn btn-success" data-toggle="modal" 
                data-target="#form_data" onClick="addClass();"​ style="margin-bottom: 5px;">
                  បន្ថែមថ្នាក់ថ្មី
                </button>

                <!-- Modal -->
                <div class="modal fade" id="form_data" tabindex="-1" role="dialog" 
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title" id="exampleModalLongTitle">ទម្រង់បញ្ចូលថ្នាក់ថ្មី</h5>
                        </div>
                          ​​​  <div class="modal-body">
                                <form id="form-classdata" class="form-horizontal" method="post" role="form">
                                    <div class="form-group">                                 
                                        <label class="col-sm-3 control-label">ឈ្មោះថ្នាក់</label>                                 
                                        <div class="col-sm-9">                                     
                                            <input type="text" name="txtclassname" id="txtclassname" class="form-control" value="" />
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
                                                <th>ឈ្មោះថ្នាក់</th>
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
    getClassData();  
});   
 //Function getCourseData  
function getClassData(){       
    var oTable = $('#tblshow').dataTable(); 
        $.ajax({           
        url: 'classdata.php?data=get-class',           
        dataType: 'json',           
        success: function(s){               
            console.log(s); 
            oTable.fnClearTable();               
            for(var i = 0; i < s.length; i++) {                   
                oTable.fnAddData([s[i][0], s[i][1], s[i][2] ]);                
            }           
        }, error: function(e){                    
          console.log(e.responseText);            
        }          
    });  
}
//Function addClass  
function addClass(){       
 $('#txtclassname').val('');
 $('#btnsubmit').text('បញ្ចូល');       
 $('#form-classdata').removeClass('form-edit');       
 $('#form-classdata').addClass('form-add');  
}
// submit on add  
$(document).on('submit', '#form-classdata.form-add', function(e){ 
   var form_data = $('#form-classdata').serialize(); 
    $.ajax({          
        url:          'classdata.php?data=addclass',          
        cache:        false,          
        data:         form_data,          
        success: function(e){              
            console.log(e);              
            alert("បញ្ចូលបានជោគជ័យ");              
            getClassData();      
            $('#form_data').modal('hide');
        }, error: function(e){              
          console.log(e.responseText);           
        }        
    });      
    return false;  
});
//Function Get Data To editClass  
var classId;  
function editClass(row){ 
    $('#btnsubmit').text('កែប្រែ');      
    $('#form-classdata').removeClass('form-add');      
    $('#form-classdata').addClass('form-edit');      
    classId=row;      
     // get data to form      
    $.ajax({          
        url:        'classdata.php?data=get-classat',          
        data:       'classid=' + row,          
        dataType:   'json', 
        success: function(s){              
            console.log(s);        
            $('#txtclassname').val(s[0][1]);        
          }, error: function(e){               
            console.log(e.responseText);           
        }      
    });  
}
// submit on edit  
$(document).on('submit', '#form-classdata.form-edit', function(e){ 
   var form_data = $('#form-classdata').serialize(); 
    $.ajax({          
        url:          'classdata.php?data=updateclass',          
        cache:        false,          
        data:         form_data + '&id='+classId,          
        success: function(e){              
        console.log(e);              
        alert("កែប្រែបានជោគជ័យ");              
        getClassData(); 
        $('#form_data').modal('hide'); 
    }, error: function(e){              
      console.log(e.responseText);           
    }        
   });      
   return false;  
});

//Delete Class  
function deleteClass(row){ 
   var r = confirm("តើអ្នកប្រាកដហើយថាចង់លុបចេញ ?");     
   if (r == true) {             
        //proccess delete on ajax          
        $.ajax({              
           url:        'classdata.php?data=deleteclass',              
           data:       'classid=' + row,              
           success: function(s){                  
                console.log(s);                  
                alert("លុបបានជោគជ័យ");              
          }, error: function(e){                   
            console.log(e.responseText);               
          }          
        });
        $("#class_"+row).parent().parent().hide("slow",function(){              
          $(this).remove();          
        });      
    }    
}   
</script>
</html>
