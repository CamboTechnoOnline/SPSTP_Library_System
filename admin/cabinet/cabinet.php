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
                        <h5 class="page-header">ទំព័រគ្រប់គ្រងទូដាក់សៀវភៅ</h5>
                    </div>
                </div>
                <!-- ... Your content goes here ... -->
                <!-- Modal -->
                <button class="btn btn-success" data-toggle="modal" 
                data-target="#form_data" onClick="addCabinet();"​ style="margin-bottom: 5px;">
                  បន្ថែមទូដាក់សៀវភៅថ្មី
                </button>

                    <!-- Modal -->
                    <div class="modal fade" id="form_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title" id="exampleModalLongTitle">ទម្រង់បញ្ចូលប្រភេទទូថ្មី</h5>
                          </div>
                          ​​​  <div class="modal-body">
                            <form id="form-cabinetdata" class="form-horizontal" method="post" role="form">
                              <div class="form-group">                                 
                                <label class="col-sm-4 control-label">ប្រភេទទូដាក់សៀវភៅ</label>                                 
                                <div class="col-sm-8">                                     
                                  <input type="text" name="txtcabinet" id="txtcabinet" value="" />
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
                            <div class="panel-heading">ព័តមានទូដាក់សៀវភៅទាំងអស់</div>
                              <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table style="text-align: center;" class="table table-striped table-bordered table-hover" id="tblshow">
                                        <thead>
                                            <tr>
                                                <th>លេខរៀង</th>
                                                <th>ទូដាក់សៀវភៅ</th>
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
 getCabinetData();  
});   
 //Function getCabinetData  
 function getCabinetData(){       
  var oTable = $('#tblshow').dataTable(); 
  $.ajax({           
    url: 'cabinetdata.php?data=get-cabinet',           
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

//Function addbooktypecolor  
function addCabinet(){      
  $('#txtcabinet').val('');
  $('#btnsubmit').text('បញ្ចូល');       
  $('#form-cabinetdata').removeClass('form-edit');       
  $('#form-cabinetdata').addClass('form-add');  
} 

// submit on add  
$(document).on('submit', '#form-cabinetdata.form-add', function(e){ 
 var form_data = $('#form-cabinetdata').serialize(); 

 $.ajax({          
   url:          'cabinetdata.php?data=addcabinet',          
   cache:        false,          
   data:         form_data,          
   success: function(e){              
     console.log(e);              
     alert("Insert Successfully");              
     getCabinetData();   
     $('#form_data').modal('hide');
   }, error: function(e){              
    console.log(e.responseText);           
  }        
});      
 return false;  
});

 //Function edit cabinet
 var cabinetId;  
 function editCabinet(row){ 
   $('#btnsubmit').text('កែប្រែ');      
   $('#form-cabinetdata').removeClass('form-add');      
   $('#form-cabinetdata').addClass('form-edit');      
   cabinetId=row;      
     // get data to form      
     $.ajax({          
      url:        'cabinetdata.php?data=get-cabinetat',          
      data:       'cabinetid=' + row,          
      dataType:   'json', 
      success: function(s){              
        console.log(s);        
        $('#txtcabinet').val(s[0][1]);       
      }, error: function(e){               
        console.log(e.responseText);           
      }      
    });  
   }

   // submit on edit  
   $(document).on('submit', '#form-cabinetdata.form-edit', function(e){ 

    var form_data = $('#form-cabinetdata').serialize(); 

    $.ajax({          
      url:          'cabinetdata.php?data=updatecabinet',          
      cache:        false,          
      data:         form_data + '&id='+cabinetId,          
      success: function(e){              
        console.log(e);              
        alert("Update Successfully");              
    getCabinetData();           
    
    $('#form_data').modal('hide'); 
  }, error: function(e){              
    console.log(e.responseText);           
  }        
  });      
    return false;  
  });

 //Delete Cabinet 
 function deleteCabinet(row){   
  var txt;     
  var r = confirm("តើអ្នកប្រាកដហើយថាចង់លុបចេញ ?");     
  if (r == true) {             
        //proccess delete on ajax          
        $.ajax({              
          url:        'cabinetdata.php?data=deletecabinet',              
          data:       'cabinetid=' + row,              
          success: function(s){                  
            console.log(s);                  
            alert("Delete Successfully");              
          }, error: function(e){                   
            console.log(e.responseText);               
          }          
        }); 
        $("#cabinet"+row).parent().parent().hide("slow",function(){              
          $(this).remove();          
        });      
      }    
    } 
  </script>