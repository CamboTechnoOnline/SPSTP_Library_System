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
                        <h5 class="page-header">ទំព័រគ្រប់គ្រងឆ្នាំសិក្សា</h5>
                    </div>
                </div>
                <!-- ... Your content goes here ... -->
              <!-- Modal -->
                  <div class="modal fade" id="form_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h5 class="modal-title" id="exampleModalLongTitle">ទម្រង់បញ្ចូលឆ្នាំសិក្សាថ្មី</h5>
                        </div>
                        ​​​  <div class="modal-body">
                          <form id="form-yeardata" class="form-horizontal" method="post" role="form">
                            <div class="form-group">                                 
                              <label class="col-sm-3 control-label">ឆ្នាំសិក្សាថ្មី</label>                                 
                              <div class="col-sm-9">                                     
                                <input type="text" name="txtstudyyear" id="txtstudyyear" class="form-control" value="" />
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
                          ព័តមានឆ្នាំសិក្សាទាំងអស់
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <div class="table-responsive">
                            <table style="text-align: center;" class="table table-striped table-bordered table-hover" id="tblshow">
                              <thead>
                                <tr>
                                  <th>លេខរៀង</th>
                                  <th>ឆ្នាំសិក្សា</th>
                                  <th>កំណែប្រែ</th>
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
 getYearData();  
});   
 //Function getyearData  
 function getYearData(){       
  var oTable = $('#tblshow').dataTable(); 
  $.ajax({           
    url: 'yeardata.php?data=get-year',           
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
//Function addYear  
function addYear(){       
 $('#txtstudyyear').val('');
 $('#btnsubmit').text('បញ្ចូល');       
 $('#form-yeardata').removeClass('form-edit');       
 $('#form-yeardata').addClass('form-add');  
}  

// submit on add  
$(document).on('submit', '#form-yeardata.form-add', function(e){ 
 var form_data = $('#form-yeardata').serialize(); 
 $.ajax({          
   url:          'yeardata.php?data=addyear',          
   cache:        false,          
   data:         form_data,          
   success: function(e){              
     console.log(e);              
     alert("Insert Successfully");              
     getYearData();              
     $('#form_data').modal('hide');
   }, error: function(e){              
    console.log(e.responseText);           
  }        
});      
 return false;  
});

 //Function editYear  
 var yearId;  
 function editYear(row){ 
   $('#btnsubmit').text('កែប្រែ');      
   $('#form-yeardata').removeClass('form-add');      
   $('#form-yeardata').addClass('form-edit');      
   yearId=row;      
     // get data to form      
     $.ajax({          
      url:        'yeardata.php?data=get-yearat',          
      data:       'yearid=' + row,          
      dataType:   'json', 
      success: function(s){              
        console.log(s);        
        $('#txtstudyyear').val(s[0][1]);        
      }, error: function(e){               
        console.log(e.responseText);           
      }      
    });  
   } 

// submit on edit  
$(document).on('submit', '#form-yeardata.form-edit', function(e){ 
  var form_data = $('#form-yeardata').serialize(); 
  $.ajax({          
    url:          'yeardata.php?data=updateyear',          
    cache:        false,          
    data:         form_data + '&id='+yearId,          
    success: function(e){              
      console.log(e);              
      alert("កែប្រែបានជោគជ័យ");              
    getYearData();           

    $('#form_data').modal('hide'); 
  }, error: function(e){              
    console.log(e.responseText);           
  }        
});      
  return false;  
});


//Delete Year  
function deleteYear(row){   
  var txt;     
  var r = confirm("តើអ្នកប្រាកដហើយថាចង់លុបចេញ ?");     
  if (r == true) {             
        //proccess delete on ajax          
        $.ajax({              
          url:        'yeardata.php?data=deleteyear',              
          data:       'yearid=' + row,              
          success: function(s){                  
            console.log(s);                  
            alert("លុបបានជោគជ័យ");              
          }, error: function(e){                   
            console.log(e.responseText);               
          }          
        }); 
        $("#year_"+row).parent().parent().hide("slow",function(){              
          $(this).remove();          
        });      
      }    
    } 
</script>
</html>