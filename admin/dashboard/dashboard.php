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
    <?php 
    include('../include/navbar.php'); 
    require '../../db.php';
    $query="SELECT COUNT(classid) as ClassId FROM tblclass";
    $result=$conn->query($query);
    $row=$result->fetch_array();
    $class=$row["ClassId"];
    $query="SELECT COUNT(userid) as userid FROM tbluser";
    $result=$conn->query($query);
    $row=$result->fetch_array();
    $user=$row["userid"];
    $query="SELECT COUNT(bookid) as bookid FROM tblbook";
    $result=$conn->query($query);
    $row=$result->fetch_array();
    $book=$row["bookid"];
    $query="SELECT COUNT(id) as id FROM tblstudent";
    $result=$conn->query($query);
    $row=$result->fetch_array();
    $student=$row["id"];
    $query="SELECT COUNT(id) as id FROM tblborrow";
    $result=$conn->query($query);
    $row=$result->fetch_array();
    $studentborrow=$row["id"];
    ?>
    <?php if (isset($_GET['success'])) { 
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
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-home fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $class; ?> ថ្នាក់</div>
                                    <div>ថ្នាក់សរុប</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="../class/class.php"><span class="pull-left">ព័តមានលំអិត</span></a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-home fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $user; ?> នាក់</div>
                                    <div>អ្នកប្រើប្រាស់សរុប</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="../user/user.php"><span class="pull-left">ព័តមានលំអិត</span></a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $student; ?> នាក់</div>
                                    <div>សិស្សសរុប</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="../book/book.php"><span class="pull-left">ព័តមានលំអិត</span></a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $book; ?> ក្បាល</div>
                                    <div>សៀវភៅសរុប</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="../student/student.php"><span class="pull-left">ព័តមានលំអិត</span></a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-home fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $studentborrow; ?> នាក់</div>
                                    <div>សិស្សខ្ចីសរុប</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="../class/class.php"><span class="pull-left">ព័តមានលំអិត</span></a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-home fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $user; ?> នាក់</div>
                                    <div>អ្នកប្រើប្រាស់សរុប</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="../user/user.php"><span class="pull-left">ព័តមានលំអិត</span></a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $student; ?> នាក់</div>
                                    <div>សិស្សសរុប</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="../book/book.php"><span class="pull-left">ព័តមានលំអិត</span></a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $book; ?> ក្បាល</div>
                                    <div>សៀវភៅសរុប</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="../student/student.php"><span class="pull-left">ព័តមានលំអិត</span></a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ...End Your content goes here ... -->
        </div>
    </div>
    <!-- ... End wrapper ... -->
</div>
<?php include('../include/script.php') ?>
</body>
</html>
