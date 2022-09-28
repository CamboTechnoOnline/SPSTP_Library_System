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
            <h5 class="page-header">ទំព័រកែប្រែទំតាំង ឬ សាខា</h5>
          </div>
        </div>
        <!-- ... Your content goes here ... -->
        <!-- Modal Add -->
        <div class="modal fade" id="form_data" tabindex="-1" role="dialog" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h5 class="modal-title" id="exampleModalLongTitle">ទម្រង់បញ្ចូលសិស្សអានសៀវភៅប្រចាំថ្ងៃ</h5>
            </div>
            ​​​  <div class="modal-body">
              <form id="form-branchdata" class="form-horizontal" method="post" role="form">
                <div class="form-group">                                 
                  <label class="col-sm-4 control-label">ឈ្មោះសាខា ឬ ទីតាំង</label>               
                  <div class="col-sm-8">
                    <input type="text" name="txtbranch" id="txtbranch" required=""/>
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
          <div class="panel-heading">ព័តមានទីតាំង ឬ សាខា</div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="table-responsive">
              <table style="text-align: center;" class="table table-striped table-bordered table-hover" id="tblshow">
                <thead>
                  <tr>
                    <th>ល.រ</th>
                    <th>ឈ្មោះទីតាំង ឬ សាខា</th>
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
    getBranch();
  });
//Function getBookData  
function getBranch(){       
  var oTable = $('#tblshow').dataTable(); 
  $.ajax({           
    url: 'branchdata.php?data=get-branch',           
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
//Function getdata to textbox  
var branchId;  
function editBranch(row){ 
 $('#btnsubmit').text('កែប្រែ');    
 $('#form-branchdata').removeClass('form-add');      
 $('#form-branchdata').addClass('form-edit'); 
 branchId=row;      
     // get data to form      
     $.ajax({          
      url:        'branchdata.php?data=get-branchat',          
      data:       'id=' + row,        
      dataType:   'json',          
      success: function(s){              
        console.log(s);        
        $('#txtbranch').val(s[0][0]);   
      }, error: function(e){               
        console.log(e.responseText);           
      }      
    });   
}

// submit on edit  
$(document).on('submit', '#form-branchdata.form-edit', function(e){ 
  var form_data = $('#form-branchdata').serialize(); 
  $.ajax({          
    url:          'branchdata.php?data=updatebranch',          
    cache:        false,          
    data:         form_data + '&id='+branchId,          
    success: function(e){              
      console.log(e);              
      alert("កែប្រែបានជោគជ័យ");              
      getBranch();
      $('#form_data').modal('hide'); 
  }, error: function(e){              
      console.log(e.responseText);           
  }        
});      
  return false; 
});
</script>
 </html>
