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
                        <h5 class="page-header">ទំព័រគ្រប់គ្រងអ្នកនិពន្ធ</h5>
                    </div>
                </div>
                <!-- ... Your content goes here ... -->
                <!-- Modal -->
                <button class="btn btn-success" data-toggle="modal" 
                data-target="#form_data" onClick="addAuthor();"​ style="margin-bottom: 5px;">
                  បន្ថែមឈ្មោះអ្នកនិពន្ធថ្មី
                </button>

                  <!-- Modal -->
            <div class="modal fade" id="form_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title" id="exampleModalLongTitle">ទម្រង់បញ្ចូលអ្នកនិព័ន្ធថ្មី</h5>
                          </div>
                  ​​​  <div class="modal-body">
                        <form id="form-authordata" class="form-horizontal" method="post" role="form">
                            <div class="form-group">                                 
                              <label class="col-sm-3 control-label">ឈ្មោះអ្នកនិពន្ធ</label>                                 
                              <div class="col-sm-9">                                     
                                <input type="text" name="txtauthorname" id="txtauthorname" class="form-control" value="" />
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
                            <div class="panel-heading">ព័តមានអ្នកនិពន្ធទាំងអស់</div>
                              <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table style="text-align: center;" class="table table-striped table-bordered table-hover" id="tblshow">
                                        <thead>
                                            <tr>
                                                <tr>
                                                <th>លេខរៀង</th>
                                                <th>ឈ្មោះអ្នកនិពន្ធ</th>
                                                <th>កំណែប្រែ</th>
                                              </tr>
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
     getAuthorData();  
});   
 //Function getAuthorData  
 function getAuthorData(){       
    var oTable = $('#tblshow').dataTable(); 
      $.ajax({           
        url: 'authordata.php?data=get-author',           
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
//Function addAuthor  
 function addAuthor(){       
 $('#txtauthorname').val('');
 $('#btnsubmit').text('បញ្ចូល');       
 $('#form-authordata').removeClass('form-edit');       
 $('#form-authordata').addClass('form-add');  
} 

// submit on add  
$(document).on('submit', '#form-authordata.form-add', function(e){ 
     var form_data = $('#form-authordata').serialize(); 
 
     $.ajax({          
     url:          'authordata.php?data=addauthor',          
     cache:        false,          
     data:         form_data,          
     success: function(e){              
     console.log(e);              
     alert("Insert Successfully");              
     //getCourseData();              
     var id=e;     
     var name = $('#txtauthorname').val();
     var option = "<a href='#' id='author_" + id + "' class='btn btn-info btn-sm'  data-toggle='modal'  data-target='#form_data' onclick='editAuthor(" + id + ");'>Edit</a>"; 
 
    option += "&nbsp; <a href='#' id='author_" + id + "' class='btn btn-danger btn-rounded btn-sm'   data-target='#form_data' onclick='deleteAuthor(" + id + ");'>Delete</a>"; 
 
    var oTable = $('#tblshow').dataTable();     
    oTable.fnAddData([id, name, option]); 
 
      $('#form_data').modal('hide');
              }, error: function(e){              
                console.log(e.responseText);           
              }        
            });      
     return false;  
 });

//Function editAuthor  
 var authorId;  
 function editAuthor(row){ 
     $('#btnsubmit').text('កែប្រែ');      
     $('#form-authordata').removeClass('form-add');      
     $('#form-authordata').addClass('form-edit');      
     authorId=row;      
     // get data to form      
     $.ajax({          
      url:        'authordata.php?data=get-authorat',          
      data:       'authorid=' + row,          
      dataType:   'json', 
         success: function(s){              
          console.log(s);        
          $('#txtauthorname').val(s[0][1]);        
        }, error: function(e){               
          console.log(e.responseText);           
        }      
      });  
   }

// submit on edit  
 $(document).on('submit', '#form-authordata.form-edit', function(e){ 
 
    var form_data = $('#form-authordata').serialize(); 
 
    $.ajax({          
    url:          'authordata.php?data=updateauthor',          
    cache:        false,          
    data:         form_data + '&id='+authorId,          
    success: function(e){              
    console.log(e);              
    alert("Update Successfully");              
    //getCourseData();           
    var id=authorId;     
    var name = $('#txtauthorname').val(); 
    var option = "<a href='#' id='author_" + id + "' class='btn btn-info btn-sm'  data-toggle='modal'  data-target='#form_data' onclick='editAuthor(" + id + ");'>Edit</a>"; 
 
    option += "&nbsp; <a href='#' id='author_" + id + "' class='btn btn-danger btn-rounded btn-sm' data-target='#form_data' onclick='deleteAuthor(" + id + ");'>Delete</a>"; 
 
          $("#author_"+authorId).parent().parent().html(function(){               
            $('#tblshow').dataTable().fnUpdate([id, name, option], this,null, false);        
          }); 
        $('#form_data').modal('hide'); 
        }, error: function(e){              
          console.log(e.responseText);           
        }        
      });      
     return false;  
   });

 //Delete Author  
function deleteAuthor(row){   
    var txt;     
    var r = confirm("តើអ្នកប្រាកដហើយថាចង់លុបចេញ ?");     
    if (r == true) {             
        //proccess delete on ajax          
        $.ajax({              
            url:        'authordata.php?data=deleteauthor',              
            data:       'authorid=' + row,              
            success: function(s){                  
                console.log(s);                  
                alert("Delete Successfully");              
            }, error: function(e){                   
                console.log(e.responseText);               
                }          
        }); 
           $("#author_"+row).parent().parent().hide("slow",function(){              
            $(this).remove();          
          });      
    }    
}
</script>
</html>