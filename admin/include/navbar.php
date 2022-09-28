
<style type="text/css">
    body{
        font-family:'Khmer', cursive;
        font-size: 15px;
    }
    h1{
        color: #BA2031; 
        font-family:'Moul',cursive;
        font-size: 32px;
        text-align: center;
    }
    h5{
        color: #BA2031; 
        font-family:'Moul',cursive;
        font-size: 22px;
        text-align: center;
    }
    table thead th{
        color: #2B3990; 
        font-family:'Moul',cursive;
        font-size: 15px;
        text-align: center;
    } 
    input[type=text]{
      width: 100%;
      padding: 9px;
      height: 39px;
      border: 1px solid #2B3990;
      border-radius: 4px;
      resize: vertical;
  }
  input[type=password]{
      width: 100%;
      padding: 9px;
      border: 1px solid #2B3990;
      border-radius: 4px;
      resize: vertical;
  }
  input[type=date]{
      width: 100%;
      height: 42px;
      border: 1px solid #2B3990;
      border-radius: 4px;
  }
  select {
      width: 100%;
      padding: 5px;
      border: 1px solid #2B3990;
      border-radius: 4px;
      resize: vertical;
  }
</style>
<?php
include('../../db.php');
session_start();
ob_start();
$select = "(SELECT * from tbluser);";
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #800000">
    <div class="navbar-header">
        <img src="../../image/l.png" width="50px">
    </div>
    <div class="navbar-header">
        <a class="navbar-brand" style="color: yellow; font-family:'Moul', cursive;">
            ប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យ
        </a>
    </div>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <!-- Top Navigation: Left Menu -->




    <!-- Top Navigation: Right Menu -->
    <ul class="nav navbar-right navbar-top-links">
        <li>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: yellow; background-color: #800000">
                <?php 
                    $sql = ("Select * from tblbranch");
                    $result = $conn->query($sql); 
                        while($row=$result->fetch_assoc()){
                          echo '<i style="color: yellow; font-family:Moul, cursive;">'.$row['branchname'].'</i>' ;
                        }
                ?>
            </a>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: yellow; background-color: #800000">
                &nbsp&nbsp <i class="fa fa-calendar fa-fw"></i> 
                <?php
                date_default_timezone_set("Asia/Phnom_Penh"); 
                echo date("d-m-Y , h:i:sa"); 
                ?> 
                &nbsp&nbsp <i class="fa fa-user fa-fw"></i>
                <?php
                if(isset($_SESSION["username"])==""){
                    header("Location:../../index.php");
                }else{
                    echo($_SESSION["username"]);
                }
                ?>  <b class="caret"></b> 
            </a>
            <ul class="dropdown-menu dropdown-user">

                <li class="divider"></li>
                <li><a href="../../logout.php"><i class="fa fa-sign-out fa-fw"></i> ចាកចេញ</a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Sidebar -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="../dashboard/dashboard.php" class="active"><i class="fa fa-dashboard fa-fw"></i> ទំព័រដើម</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-plus-square"></i> ទម្រង់បន្ថែមថ្មី<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="../user/user.php"><i class="fa fa-user"></i> អ្នកប្រើប្រាស់ថ្មី</a>
                        </li>
                        <li>
                            <a href="../class/class.php"><i class="fa fa-home"></i> ថ្នាក់ថ្មី</a>
                        </li>
                        <li>
                            <a href="../book/book.php"><i class="fa fa-book"></i> សៀវភៅថ្មី</a>
                        </li>
                        <li>
                            <a href="../author/author.php"><i class="fa fa-users"></i> អ្នកនិពន្ធថ្មី</a>
                        </li>
                        <li>
                            <a href="../student/student.php"><i class="fa fa-mortar-board"></i> ឈ្មោះសិស្សថ្មី</a>
                        </li>
                        <li>
                            <a href="../year/year.php"><i class="fa fa-user"></i> ឆ្នាំសិក្សាថ្មី</a>
                        </li>
                        <li>
                            <a href="../cabinet/cabinet.php"><i class="fa fa-table"></i> ទូដាក់សៀវភៅថ្មី</a>
                        </li>
                        <li>
                            <a href="../teacher/teacher.php"><i class="fa fa-user"></i> គ្រូថ្មី</a>
                        </li>
                        <li>
                            <a href="../branch/branch.php"><i class="fa fa-fort-awesome"></i> សាខា ឬ ទីតាំង</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book"></i> ប្រភេទសៀវភៅតាមកូដ<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="../bookcodetype/booktype_color.php"><i class="fa fa-cube"></i> កូដពណ៌</a>
                                </li>
                                <li>
                                    <a href="../bookcodetype/booktype_deve.php"><i class="fa fa-cubes"></i> កូដដឺវេ</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-clipboard"></i> បញ្ចីសិស្សខ្ចី<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                     <li>
                        <a href="../borrow/borrower.php" class="active"><i class="fa fa-user-plus"></i> បញ្ជីសិស្សខ្ចីទាំងអស់</a>
                    </li>
                    <li>
                        <a href="../borrow/borrowernotrepaid.php" class="active"><i class="fa fa-user-times">
                        </i> បញ្ជីសិស្សខ្ចីមិនទាន់សង់</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="../studentreaddaily/studentreaddaily.php" class="active"><i class="fa fa-user-plus">
                </i> បញ្ជីសិស្សអានប្រចាំថ្ងៃ</a>
            </li>
            <li>
                <a href="../studentreaddaily/studentcount.php" class="active"><i class="fa fa-user-plus">
                </i> បញ្ជីសិស្សអានឆ្នើម</a>
            </li>
        </ul>
    </div>
</div>
</nav>
