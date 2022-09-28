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
            <h5 class="page-header">ទំព័រសិស្សអានសៀវភៅឆ្នើមប្រចាំ</h5>
          </div>
        </div>
        <!-- ... Your content goes here ... -->
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">ព័តមានឈ្មោះសិស្សអានសៀវភៅប្រចាំថ្ងៃទាំងអស់</div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="table-responsive">
                  <table style="text-align: center;" class="table table-striped table-bordered table-hover" id="tblshow">
                    <thead>
                      <tr>
                        <th>ល.រ</th>
                        <th>កូដសិស្ស</th>
                        <th>ឈ្មោះសិស្ស</th>
                        <th>កូដសៀវភៅ</th>
                        <th>ចំណងជើងសៀវភៅ</th>
                        <th>កាលបរិច្ឆេទអាន</th>
                        <th>ថ្នាក់រៀន</th>
                        <th>ឆ្នាំសិក្សា</th>
                        <th>ចំនួនការចូលអាន</th>
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
    getStudentCountData();
  });
//Function getBookData  
function getStudentCountData(){       
  var oTable = $('#tblshow').dataTable(); 
  $.ajax({           
    url: 'readdailydata.php?data=get-studentcout',           
    dataType: 'json',           
    success: function(s){               
      console.log(s); 
      oTable.fnClearTable();               
      for(var i = 0; i < s.length; i++) {                   
        oTable.fnAddData([s[i][0], s[i][1], s[i][2], s[i][3],s[i][4],s[i][5],s[i][6],s[i][7],s[i][8],s[i][9] ]);                
      }           
    }, error: function(e){                    
      console.log(e.responseText);            
    }       
  });
}
</script>
</html>
