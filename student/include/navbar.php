
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
    include('../db.php');
    session_start();
    ob_start();
    $select = "(SELECT * from tblstudent);";
 ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #800000">
    <div class="navbar-header">
        <img src="../image/l.png" width="50px">
    </div>
    <div class="navbar-header">
        <a class="navbar-brand" style="color: yellow; font-family:'Moul', cursive;">
            ប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យ
        </a>
    </div>

    <!-- Top Navigation: Right Menu -->
    <ul class="nav navbar-right navbar-top-links">
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
                    header("Location:../index.php");
                }else{
                    echo($_SESSION["username"]);
                }
                ?> <b class="caret"></b> 
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Sidebar -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="dashboard.php" class="active"><i class="fa fa-dashboard fa-fw"></i> ទំព័រដើម</a>
                </li>
                <li>
                    <a href="../borrower/borrower.php" class="active"><i class="fa fa-book fa-fw"></i> បញ្ជីសៀវភៅក្នុងបណ្ណាល័យ</a>
                </li>
                <li>
                    <a href="../borrower/borrowernotrepaid.php" class="active"><i class="fa fa-book fa-fw">
                    </i> បញ្ជីសៀវភៅដែលបានខ្ចី</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
