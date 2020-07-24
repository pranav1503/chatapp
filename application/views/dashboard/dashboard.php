<?php
  include 'header.php';
 ?>

 <div class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1 class="m-0 text-dark">Dashboard</h1>
       </div><!-- /.col -->
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="#">Home</a></li>
           <li class="breadcrumb-item active">Dashboard</li>
         </ol>
       </div><!-- /.col -->
     </div><!-- /.row -->
   </div><!-- /.container-fluid -->
 </div>

 <section class="content">
   <div class="container-fluid">
     <div class="row">
       <div class="col-lg-12">

       </div>
     </div>
     <!-- Small boxes (Stat box) -->
     <div class="row">
       <?php
         if ($user['type'] == "student") {
        ?>
        <div class="col-lg-3 col-12" style="cursor:pointer;" onclick="window.location.href='book_l/client'">
          <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Your Questions</h3>

            <p>past questions</p>
          </div>
          <div class="icon">
            <i class="fas fa-binoculars"></i>
          </div>
          <a href="<?php echo base_url(); ?>/book_l/client" class="small-box-footer">Click To View &nbsp;<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-5 col-12" style="cursor:pointer;">
        <h3>Questions asked: 1000</h3>
        <h3>Questions answered: 999</h3>
      </div>
       <?php } ?>

       <?php
         if ($user['type'] == "teacher") {
        ?>
        <div class="col-lg-3 col-12" style="cursor:pointer;" onclick="window.location.href='book_l/viewClients'">
          <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>View Bookings</h3>

            <p>Today's bookings</p>
          </div>
          <div class="icon">
            <i class="fas fa-binoculars"></i>
          </div>
          <a href="<?php echo base_url(); ?>/book_l/viewClients" class="small-box-footer">Click To Add <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
       <?php } ?>

     </div>
   </div>
 </section>




<?php
  include 'footer.php';
 ?>
