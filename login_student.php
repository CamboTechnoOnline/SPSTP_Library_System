<!DOCTYPE html>
<html>
<head>
  <title>ទម្រង់ចូលប្រើប្រព័ន្ធ</title>
  <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@900&family=Khmer&family=Moul&display=swap" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="HomePage/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="HomePage/css/sb-admin.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="image/l.png">
</head>
<body>
  <?php 
  include('db.php');
  include('headerhomepage.php');
  ?>

    <div class="cotainer" style="margin-top: 20px;">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header"​ style="font-family:Moul;color: #2B3990; font-size: 20px; text-align: center;">ទម្រង់ចូលប្រើប្រាស់ប្រព័ន្ធសិស្ស</div>
            <div class="card-body">
             <form role="form" action="student/checkloginstudent.php" method="post">
              <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                  <?=$_GET['error']?>
                </div>
              <?php } ?>
              <div class="form-group row">
                <label for="full_name" class="col-md-4 col-form-label text-md-right">ឈ្មោះគណនី</label>
                <div class="col-md-6">
                  <input type="text" id="txtu" class="form-control" placeholder="បញ្ចូលឈ្មោះគណនី" name="txtu">
                </div>
              </div>

              <div class="form-group row">
                <label for="email_address" class="col-md-4 col-form-label text-md-right">លេខសម្ងាត់</label>
                <div class="col-md-6">
                  <input type="password" id="txtp" name="txtp"​​ placeholder="បញ្ចូលលេខសម្ងាត់" class="form-control">
                </div>
              </div>

             <br>
             <div class="col-md-6 offset-md-5">
              <input type="submit" name="submit" class="btn btn-primary" value="ចូលប្រើ" />
              <a href="signup.php"><button type="button" class="btn btn-warning">ចុះឈ្មោះ</button></a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>
<!-- Bootstrap core JavaScript-->
<script src="HomePage/vendor/jquery/jquery.min.js"></script>
<script src="HomePage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="HomePage/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="HomePage/vendor/chart.js/Chart.min.js"></script>
<script src="HomePage/vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="HomePage/js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="HomePage/js/demo/datatables-demo.js"></script>
<script src="HomePage/js/demo/chart-area-demo.js"></script>
</html>