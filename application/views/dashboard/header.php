<?php
  $this->load->helper('url');
  $this->load->library('session');
  $user = $this->session->all_userdata();
  if(empty($user['name'])){
    redirect(base_url());
  }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel = "icon" type = "image/png" href = "<?php echo base_url(); ?>front_static/images/logo.png">
  <!-- For apple devices -->
  <link rel = "apple-touch-icon" type = "image/png" href = "<?php echo base_url(); ?>front_static/images/logo.png"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Leon Maestro De Fitness</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>back_static/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>back_static/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>back_static/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>back_static/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>back_static/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>back_static/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>back_static/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>back_static/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>back_static/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url(); ?>back_static/plugins/jquery-ui/jquery-ui.min.js"></script>
  <style media="screen">
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button,input[type=date]::-webkit-inner-spin-button,
  input[type=date]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  #customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;

  }

  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:nth-child(even){background-color: #f2f2f2;}

  #customers tr:hover {background-color: #ddd;}

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
  }

  .iframe-container{
  position: relative;
  width: 100%;
  padding-bottom: 56.25%;
  height: 0;
}
.iframe-container iframe{
  position: absolute;
  top:0;
  left: 0;
  width: 100%;
  height: 100%;
}

#loading-me{
  position: fixed;
  width: 100%;
  height: 100vh;
  background: #fff
      url('<?php echo base_url(); ?>back_static/images/loader.gif')
      no-repeat center;
  z-index: 9999;
}

  </style>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed" onload="endLoad()">
<div id="loading-me">

</div>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-black navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url() ?>/login/logout" class="nav-link">Logout</a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">0 Notifications</span>

      </li>
  
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo base_url(); ?>back_static/images/logo/logo.png" alt="LMDF Logo" class="brand-image img-circle elevation-3"
           style="opacity: 1">
      <span class="brand-text font-weight-light">LMDF</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
              if($user['type'] == 'student'){
                $pic_url = base_url() . "back_static/profile/student/";
              }else{
                $pic_url = base_url() . "back_static/profile/teacher/";
              }
           ?>
          <img src="<?php echo $pic_url; ?><?php echo $user['photo']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <?php
              echo ucwords($user['name']);
            ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>user/details" class="nav-link">
              <i class="fas fa-user-circle nav-icon"></i>
              <p>Profile</p>
            </a>
          </li>
          <?php
              if ($user['type'] == "student") {
           ?>
           <li class="nav-item">
             <a href="<?php echo base_url(); ?>user/details" class="nav-link">
               <i class="fas fa-question-circle nav-icon"></i>
               <p>Your Questions</p>
             </a>
           </li>

        <?php } ?>

        <?php
            if ($user['type'] == "teacher") {
         ?>


      <?php } ?>

  <!-- <li class="nav-header">SETTINGS</li> -->
  <li class="nav-item">
    <a href="<?php echo base_url() ?>/login/logout" class="nav-link">
      <i class="fas fa-sign-out-alt"></i>
      <p class="text">Logout</p>
    </a>
  </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
