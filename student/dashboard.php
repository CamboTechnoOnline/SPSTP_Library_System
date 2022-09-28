<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ប្រព័ន្ធគ្រប់គ្រង់បណ្ណាល័យ</title>
    <?php include('include/css.php') ?>
    <link rel="icon" type="image/x-icon" href="../../image/l.png">
</head>
<body>

<?php 
include('include/navbar.php'); 
if (isset($_GET['success'])) { 
     echo("<script language=\"javascript\" >
        alert(\"សូមស្វាគមន៍ការចូលមកកាន់ប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យ\");
        </script>
        ");
 } 
 ?>
 <div id="wrapper">
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="page-header">ទំព័ររបាយការណ៍</h5>
                </div>
            </div>

            <!-- ... Your content goes here ... -->

            <!-- ...End Your content goes here ... -->
        </div>
    </div>
    <!-- ... End wrapper ... -->
</div>
<?php include('include/script.php') ?>
</body>
</html>
