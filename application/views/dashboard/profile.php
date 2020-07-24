<?php
  include 'header.php';
  $pic_url = base_url() . "back_static/profile/student/".$user['photo'];
 ?>

<div>
</div>
<div class="row">

<div class="col-lg-3">
    
</div>
<div class="col-lg-7">
<div class="card card-danger card-outline">
             <center><h2 align="center">Profile</h2></center>
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo $pic_url; ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $user['name'];?></h3>

                <p class="text-muted text-center"><?php echo $user['type'];?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email-Id</b> <a class="float-right"><?php echo $user['email_id'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Department</b> <a class="float-right"><?php echo $user['dept'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone No.</b> <a class="float-right"><?php echo $user['phone_no'];?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
</div>
</div>



<?php
  include 'footer.php';
 ?>
