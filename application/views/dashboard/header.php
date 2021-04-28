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
  <link rel = "icon" type = "image/png" href = "<?php echo base_url(); ?>back_static/images/logo/logo.png">
  <!-- For apple devices -->
  <link rel = "apple-touch-icon" type = "image/png" href = "<?php echo base_url(); ?>back_static/images/logo/logo.png"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Server Monks</title>
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
        <a href="<?php echo base_url(); ?>dashboard" class="nav-link">Home</a>
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
          <span class="badge badge-warning navbar-badge" id="noty-count">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header" id="noty-count-in">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <div id="noty-items">
          </div>

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

    </ul>
  </nav>

  <script type="text/javascript">
    function getNoty() {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>dashboard/notification/getNotyCount",
        data: {
          "user" : "<?php echo $user["email_id"]; ?>"
        },
        success: function (data) {
            document.getElementById("noty-count").innerHTML = data;
            document.getElementById("noty-count-in").innerHTML = data +" Notifications";
        },
        error: function (data) {
          alert("Error");
          // console.log(data);
        }
      });

      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>dashboard/notification/getNoty",
        data: {
          "user" : "<?php echo $user["email_id"]; ?>"
        },
        success: function (data) {
            console.log("hi");
            data = JSON.parse(data);
            output = "";
            for (var i = 0; i < data.length; i++) {
              output += `
              <a href="<?php echo base_url()."question" ?>/`+data[i].qid+`" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i>`+ data[i].message.substring(0,30) + "...." +`
                <!-- <span class="float-right text-muted text-sm">3 mins</span>-->
              </a>
              `
            }
            document.getElementById("noty-items").innerHTML = output;
        },
        error: function (data) {
          alert("Error");
          // console.log(data);
        }
      });
      setTimeout(getNoty, 5000);
    }
    getNoty();
  </script>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo base_url(); ?>back_static/images/logo/logo.png" alt="LMDF Logo" class="brand-image img-circle elevation-3"
           style="opacity: 1">
      <span class="brand-text font-weight-light">Server Monks</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
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
            <a href="<?php echo base_url(); ?>" class="nav-link">
              <i class="fas fa-home nav-icon"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>profile" class="nav-link">
              <i class="fas fa-user-circle nav-icon"></i>
              <p>Profile</p>
            </a>
          </li>
          <?php
              if ($user['type'] == "student") {
           ?>
           <li class="nav-item">
             <a href="<?php echo base_url(); ?>dashboard/quespost" class="nav-link">
               <i class="fas fa-question-circle nav-icon"></i>
               <p>Your Questions</p>
             </a>
           </li>

           <li class="nav-item">
             <a href="<?php echo base_url(); ?>dashboard/ask" class="nav-link">
               <i class="fas fa-question nav-icon"></i>
               <p>Ask a question</p>
             </a>
           </li>

        <?php } ?>

        <?php
            if ($user['type'] == "teacher") {
         ?>
         <li class="nav-item">
           <a href="<?php echo base_url(); ?>questions" class="nav-link">
             <i class="fas fa-question-circle nav-icon"></i>
             <p>Question to you</p>
           </a>
         </li>

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
