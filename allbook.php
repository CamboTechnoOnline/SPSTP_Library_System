<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>ព័ត៌មានសៀវភៅទាំងអស់</title>
  <link rel="icon" type="image/x-icon" href="image/l.png">
</head>
<body>
  <?php include('headerhomepage.php'); ?>
  <div id="content-wrapper">
    <div class="container-fluid">
      <!-- DataTables Example -->
      <div class="card mb-3">
        <div class="card-header" style="font-family:Moul;color: #2B3990; font-size: 15px;">
          <i class="fas fa-book"></i>
        ព័ត៌មានសៀវភៅទាំងអស់ក្នុងបណ្ណាល័យ</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="tblshow" width="100%" cellspacing="0" style="text-align: center;">
              <thead>
                <tr>
                  <th>ល.រ</th>
                  <th>ចំណងជើង</th>
                  <th>ស្ថានភាព</th>
                  <th>ប្រភេទទូ</th>
                  <th>ល.រទូ</th>
                  <th>ល.រសៀវភៅនៃទូ</th>
                  <th>ស្ថានភាព</th>
                  <th>ព័តមានលំអិត</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Today at <?php echo (date('Y/m/d'));  ?></div>
      </div>
    </div>
    <!-- /.container-fluid -->
    <div class="modal" id="dataModal" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">ពត៌មានសំអិតនៃសៀវភៅ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="book_detail">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

</div>

  <!-- /#wrapper -->
</body>
</html>
<script type="text/javascript">
//page load  
$(document).ready(function() {        
  getBookData();

});

//Function getBookData  
function getBookData(){       
  var oTable = $('#tblshow').dataTable(); 
  $.ajax({           
    url: 'bookdata.php?data=get-book',           
    dataType: 'json',           
    success: function(s){               
      console.log(s); 
      oTable.fnClearTable();               
      for(var i = 0; i < s.length; i++) {                   
        oTable.fnAddData([s[i][0], s[i][1], s[i][2], s[i][3], s[i][4],s[i][5], s[i][6] , s[i][7]]);                
      }           
    }, error: function(e){                    
      console.log(e.responseText);            
    }       
  });
}

var bookId; function showdata(row){
  bookId = row;
  $.ajax({              
    url:        'bookdata.php?data=showdata',           
    data:       '&bookid=' +bookId,             
    success:function(data){
      $('#dataModal').modal("show");
      $('#book_detail').html(data);  
    },error: function(e){                   
      console.log(e.responseText);               
    }          
  }); 
}
</script>
