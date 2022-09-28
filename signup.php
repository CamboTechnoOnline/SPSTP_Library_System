<!DOCTYPE html>
<html>
<head>
  <title>ទម្រង់ចុះឈ្មោះ</title>
  <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@900&family=Khmer&family=Moul&display=swap" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="HomePage/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="HomePage/css/sb-admin.css" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="image/l.png">
</head>

<body>
 <?php include('headerhomepage.php'); ?>
<?php 
include('db.php');
if(isset($_POST['submit'])){
//Code for student ID
  $count_my_page = ("HomePage/studentid.txt");
  $hits = file($count_my_page);
  $hits[0] ++;
  $fp = fopen($count_my_page , "w");
  fputs($fp , "$hits[0]");
  fclose($fp); 
  $StudentId= $hits[0];   
  $username=$_POST['username'];
  $gender=$_POST['txtgender'];
  $password=md5($_POST['txtpassword']);
  $phone=($_POST['txtphone']);
  $teacherid=($_POST['txtteachername']);  
  $status='1'; 
  $sql="INSERT INTO tblstudent (studentid,username,gender,password,phone,teacherid,status) VALUES('$StudentId','$username','$gender','$password','$phone',$teacherid,$status);";   
    if($conn->query($sql) == true){      
     echo '<script>alert("អបអរសាទ័រការចុះឈ្មោះទទូលបានជោគជ័យ នេះជាលេខគណនីរបស់អ្នក is  "+"'.$StudentId.'")</script>';
    }else{
    echo "<script>alert('Something went wrong. Please try again');</script>";
  }
}

?>
 <div class="cotainer" style="margin-top: 20px;">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header"​ style="font-family:Moul;color: #2B3990; font-size: 20px; text-align: center;">ទម្រង់ចុះឈ្មោះចូលប្រើប្រាស់ប្រព័ន្ធសម្រាប់សិស្ស</div>
        <div class="card-body">
          <form name="signup" method="POST" onSubmit="return valid();">
            <div class="form-group row">
              <label for="user_name" class="col-md-4 col-form-label text-md-right">ឈ្មោះគណនី</label>
              <div class="col-md-6">
                <input type="text" id="username" class="form-control" name="username" onBlur="checkAvailability()"  autocomplete="off" required>
                <span id="user-availability-status" style="font-size:12px;"></span> 
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">ភេទ</label>
              <div class="col-md-6">
                <select name="txtgender"​ class="form-control" id="txtgender">
                  <option required>ជ្រើសរើស</option​>
                    <option value="male">ប្រុស</option>
                    <option value="female">ស្រី</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="user_name" class="col-md-4 col-form-label text-md-right">លេខសម្ងាត់</label>
                <div class="col-md-6">
                  <input type="password" id="txtpassword" class="form-control" name="txtpassword" autocomplete="off" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="user_name" class="col-md-4 col-form-label text-md-right">បញ្ជាក់លេខសម្ងាត់</label>
                <div class="col-md-6">
                  <input type="password" id="txtcomfirmpassword" class="form-control" name="txtcomfirmpassword" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="phone_number" class="col-md-4 col-form-label text-md-right">លេខទូរស័ព្ទ</label>
                <div class="col-md-6">
                  <input type="text" id="txtphone" name="txtphone" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label for="phone_number" class="col-md-4 col-form-label text-md-right">ឈ្មោះគ្រូបង្រៀន</label>
                <div class="col-md-6">
                  <select name="txtteachername"​ class="form-control" id="txtteachername">
                    <option value="1" required >ជ្រើសរើស</option>
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
              <div class="col-md-6 offset-md-5">
                <button type="submit" id="submit" name="submit" class="btn btn-warning">ចុះឈ្មោះ</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


</body>
<script>
  function valid(){
    if(document.signup.txtpassword.value!= document.signup.txtcomfirmpassword.value){
      alert("លេខសម្ងាត់បញ្ជាក់មិនត្រឹមត្រូវគ្នា");
      document.signup.confirmpassword.focus();
      return false;
    }
    return true;
  }

  function checkAvailability() {
    jQuery.ajax({
      url: "HomePage/check_availability.php",
      data:'username='+$("#username").val(),
      type: "POST",
      success:function(data){
        $("#user-availability-status").html(data);
      },
      error:function (){}
    });
  }
</script>
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