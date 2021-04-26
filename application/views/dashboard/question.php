<head>
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<?php

  include 'header.php';
  if ($question["teacher"] != $user["email_id"] && $question["student"] != $user["email_id"]) {
    redirect(base_url()."dashboard");
  }
 ?>

  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Question #<?php echo $qid; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Question</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
             <div class="card card-primary card-outline">
              <div class="card-body">
                <h2><?php echo $question["question"]; ?></h2>
                <p style="color:grey;">asked by: <?php echo $question["student"]; ?></p>

                <div class="row">
                  <div class="col-6">
                    <div class="description">

                    </div>

                    <?php if ($user['email_id'] == $question["student"]): ?>
                      <button type="button" class="btn btn-danger" onclick="deleteQuestionFun()" name="button"><i class="fa fa-trash"></i> Delete</button>
                    <?php endif; ?>

                    <script type="text/javascript">
                      $(".description").html(`<?php echo $question["description"]; ?>`);
                    </script>
                  </div>
                </div>
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <?php if($question["answered"] == 0 && $user["type"] == "student"){ ?>
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Not yet answered.</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    <?php } ?>
    <!-- /.content -->
    <?php if($question["answered"] == 0 && $user["type"] == "teacher"){ ?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Answer the Question</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Answer Form</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="row">
                  <div class="col-md-12">
                    <label>Answer</label><br>
                    <div class="mb-3">
                      <textarea class="textarea" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <button type="button" id="askBtn" class="btn btn-danger btn-lg btn-block" name="button" onclick="askFun()">Submit</button>
                  </div>
                </div>
                <script type="text/javascript">
                  function askFun() {
                    var ans = $(".note-editable").html();
                    if(ans.length == 0 || ans == "<p><br></p>"){

                    }else{
                      $.ajax({
                        type: "POST",
                        url : "<?php echo base_url()."dashboard/dashboard/answer"; ?>",
                        data: {
                          "id" : <?php echo $qid; ?>,
                          "answer" : ans,
                        },
                        success:function (data) {
                          // console.log(data);
                          window.location.href = "<?php echo base_url()."question/".$qid; ?>";
                        },
                        error: function() {
                          alert("Error");
                        }
                      });
                    }

                  }
                </script>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          </div>
          <!-- /.col (left) -->

          <!-- /.col (right) -->
        </div>
      </div>
    </section>
  <?php } ?>

  <?php if($question["answered"] == 1) {?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
             <div class="card card-danger card-outline">
              <div class="card-body">
                <h2>Answer</h2>
                <?php if ($question["teacher"] == $user['email_id']): ?>
                  <button type="button" class="btn btn-danger float-right" onclick="deletePrivateAnswer()" name="button"><i class="fa fa-trash"></i></button>
                <?php endif; ?>
                <p style="color:grey;">answered by: <?php echo $question["teacher"]; ?></p>
                <div class="row">
                  <div class="col-6">
                    <div class="answer">

                    </div>

                    <script type="text/javascript">
                      $(".answer").html(`<?php echo $question["answer"]; ?>`);
                    </script>
                  </div>
                </div>
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <!-- /.col-md-6 -->
        </div>
      </div>
    </section>
    <?php }?>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Summernote -->
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <script>
      $(function () {
        // Summernote
        $('.textarea').summernote()
      })

      function deleteQuestionFun() {
        var sure = confirm("Are you sure you want to delete?");
        if(sure){
          $.ajax({
            type: "POST",
            url : "<?php echo base_url()."dashboard/dashboard/deleteQuestion"; ?>",
            data: {
              "id" : <?php echo $qid; ?>,
            },
            success:function (data) {
              // console.log(data);
              window.location.href = "<?php echo base_url()."dashboard/quespost"; ?>";
            },
            error: function() {
              alert("Error");
            }
          });
        }
      }

      function deletePrivateAnswer() {
        var sure = confirm("Are you sure you want to delete?");
        if(sure){
          $.ajax({
            type: "POST",
            url : "<?php echo base_url()."dashboard/dashboard/deleteAnswer"; ?>",
            data: {
              "id" : <?php echo $qid; ?>,
            },
            success:function (data) {
              window.location.href = "<?php echo base_url()."question/".$qid; ?>";
            },
            error: function() {
              alert("Error");
            }
          });
        }
      }


    </script>



<?php
  include 'footer.php';
 ?>
