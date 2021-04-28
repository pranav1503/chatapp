<head>
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
  html {
    overflow: scroll;
    overflow-x: hidden;
}
::-webkit-scrollbar {
    width: 0;  /* Remove scrollbar space */
    background: transparent;  /* Optional: just make scrollbar invisible */
    height: 5px;
}
/* Optional: show position indicator in red */
::-webkit-scrollbar-thumb {
    background: grey;
}
    * {
      box-sizing: border-box;
    }

    body {
      font: 16px Arial;
    }

    /*the container must be positioned relative:*/
    .autocomplete {
      position: relative;
      display: inline-block;
    }

    input {
      border: 1px solid transparent;
      font-size: 16px;
    }

    input[type=text] {
      width: 100%;
    }

    input:focus {
    outline:none;
    }


    input[type=submit] {
      background-color: DodgerBlue;
      color: #fff;
      cursor: pointer;
    }

    .autocomplete-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      z-index: 99;
      /*position the autocomplete items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;
    }

    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff;
      border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
      background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
      background-color: DodgerBlue !important;
      color: #ffffff;
    }
  </style>
</head>
<?php
  include 'header.php';
 ?>

 <div class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1 class="m-0 text-dark">Question #<?php echo $id; ?></h1>
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

 <!-- <section class="content">

 </section> -->

<script type="text/javascript">
function diffVotes(answerId) {
  $.ajax({
    type: "POST",
    url : "<?php echo base_url()."dashboard/Vote/diffVotes"; ?>",
    async: false,
    data: {
      "answerId" : answerId,
    },
    success:function (data) {
      document.getElementById("diffVotes_"+answerId).innerHTML = data;
    },
    error: function(data) {
      console.log(data);
      alert("Error");
    }
  });
}
</script>


 <section class="content">
   <div class="container-fluid">
     <div class="row">
       <div class="col-md-6">
         <!-- Box Comment -->
         <div class="card card-widget">
           <div class="card-header">
             <div class="user-block">
               <img class="img-circle" src="<?php echo base_url() ?>/back_static/profile/student/default.png" alt="User Image">
               <span class="username"><a href="#"><?php echo $questionDetails["asked_by"]; ?></a></span>
               <span><i class="fa fa-arrow-alt-up"></i></span>
               <span class="description">Shared publicly - <?php
               $date = strtotime($questionDetails["date"]);
               echo date('d M Y', $date);?></span>
             </div>
             <!-- /.user-block -->

             <!-- /.card-tools -->
           </div>
           <!-- /.card-header -->
           <div class="card-body">
             <h3><?php echo $questionDetails["question"]; ?></h3>
             <?php echo $questionDetails["description"]; ?>
             <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
             <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
             <?php if ($user["id"] == $questionDetails["id"]): ?>
               <button type="button" class="btn btn-danger btn-sm" onclick="deleteQuestion()"><i class="fa fa-trash"></i> Delete</button>
             <?php endif; ?>
             <span class="float-right text-muted"><?php echo ($questionDetails["ansCount"]==0)?"No Answer":(($questionDetails["ansCount"]==1)?$questionDetails["ansCount"]." answer":$questionDetails["ansCount"]." answers") ?></span>
           </div>
           <!-- /.card-body -->
           <div class="card-footer card-comments">
             <?php foreach ($answers as $key => $value) {?>
             <div class="card-comment" style="overflow-x:scroll;">
               <!-- User image -->
               <img class="img-circle img-sm" src="<?php echo base_url() ?>/back_static/profile/student/default.png" alt="User Image">

               <div class="comment-text">
                 <span class="username">
                  <a href="#"><?php echo $value["answered_by"] ?></a>
                   <span class="text-muted float-right"><?php
                   $date = strtotime($value["date"] );
                   echo date('d M Y', $date);?></span>
                 </span><!-- /.username -->
                 <br>
                 <?php echo $value["answer"]  ?>
                 <hr>
                 <?php if ($user['id'] == $value["userId"]): ?>
                   <button type="button" class="btn btn-sm btn-default float-right" onclick="deleteAnswer(<?php echo $value["answerId"] ?>)" name="button"><i class="fa fa-trash"></i> Delete</button>
                   <?php endif; ?>
                   <script type="text/javascript">
                     console.log("<?php echo $value['voteStatus']?>");
                   </script>
                   <button type="button" id="upVoteBtn_<?php echo $value["answerId"]; ?>" class="btn btn-sm <?php echo ($value["voteStatus"] == 1)?"btn-success":"btn-default" ?>" onclick="upvoteAnswer(<?php echo $value["answerId"] ?>)" name="button"><i class="far fa-hand-point-up"></i> Upvote</button> <span id="diffVotes_<?php echo $value["answerId"];?>">1002</span>
                   <button type="button" id="downVoteBtn_<?php echo $value["answerId"]; ?>" class="btn btn-sm <?php echo ($value["voteStatus"] == 0)?"btn-danger":"btn-default" ?>" onclick="downvoteAnswer(<?php echo $value["answerId"] ?>)" name="button"><i class="far fa-hand-point-down"></i> Downvote</button>
                   <script type="text/javascript">
                     // var answerId
                     diffVotes(<?php echo $value["answerId"]; ?>);
                   </script>
               </div>
               <!-- /.comment-text -->
             </div>
           <?php } ?>
             <!-- /.card-comment -->
             <!-- /.card-comment -->
           </div>
           <!-- /.card-footer -->
           <!-- /.card-footer -->
         </div>
         <!-- /.card -->
       </div>
<?php if($user["id"] != $questionDetails["id"]){ ?>
       <div class="col-md-6">
         <!-- Box Comment -->
         <div class="card card-widget card-warning">
           <div class="card-header">
             <div class="user-block">
               <h3>Your Answer</h3>
             </div>
             <!-- /.user-block -->
             <!-- /.card-tools -->
           </div>
           <!-- /.card-header -->
           <!-- /.card-body -->

           <!-- /.card-footer -->
           <div class="card-footer">
             <form action="#" method="post">
               <img class="img-fluid img-circle img-sm" src="<?php echo base_url() ?>/back_static/profile/student/default.png" alt="Alt Text">
               <!-- .img-push is used to add margin to elements next to floating images -->
               <div class="img-push">
                 <textarea class="textarea" placeholder="Place some text here"
                           style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                           <button type="button" class="btn btn-block btn-primary" onclick="answerFun()" name="button">Submit</button>
               </div>

             </form>
           </div>
           <!-- /.card-footer -->
         </div>
         <!-- /.card -->
       </div>
<?php } ?>
     </div>
   </div>
 </section>

<!-- jQuery -->
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

  function answerFun() {
    $.ajax({
      type: "POST",
      url : "<?php echo base_url()."dashboard/PublicQuestion/answer"; ?>",
      data: {
        "question_id" : <?php echo $id; ?>,
        "user_id" :  <?php echo $user['id'] ?>,
        "answer" : $(".note-editable").html(),
      },
      success:function (data) {
        // alert(data);
        window.location.href = "<?php echo base_url()."public/question/".$id; ?>";
      },
      error: function() {
        alert("Error");
      }
    });
  }

</script>

<script type="text/javascript">
  function deleteAnswer(answerId) {
    var sure = confirm("Are you sure you want to delete?");
    console.log(answerId);
    if (sure) {
        $.ajax({
          type: "POST",
          url : "<?php echo base_url()."dashboard/PublicQuestion/delete"; ?>",
          data: {
            "id" : answerId,
          },
          success:function (data) {
            window.location.href = "<?php echo base_url()."public/question/".$id; ?>";
          },
          error: function() {
            alert("Error");
          }
        });
      }
    }

    function addVote(answerId,vote) {
      $.ajax({
        type: "POST",
        url : "<?php echo base_url()."dashboard/Vote/insertVote"; ?>",
        async: false,
        data: {
          "userId" : <?php echo $user['id'] ?>,
          "answerId" : answerId,
          "vote" : vote
        },
        success:function (data) {
          // alert(data);
          // window.location.href = "<?php echo base_url()."dashboard/quespost"; ?>";
        },
        error: function(data) {
          console.log(data);
          alert("Error");
        }
      });
    }

    function deleteVote(answerId) {
      $.ajax({
        type: "POST",
        url : "<?php echo base_url()."dashboard/Vote/deleteVote"; ?>",
        async: false,
        data: {
          "userId" : <?php echo $user['id'] ?>,
          "answerId" : answerId,
        },
        success:function (data) {
          // alert(data);
          // window.location.href = "<?php echo base_url()."dashboard/quespost"; ?>";
        },
        error: function(data) {
          console.log(data);
          alert("Error");
        }
      });
    }

    function upvoteAnswer(answerId) {
      var btn = document.getElementById("upVoteBtn_"+answerId);
      var btnD = document.getElementById("downVoteBtn_"+answerId);
      if(btn.classList.contains("btn-default")){
        if(btnD.classList.contains("btn-danger")){
          btnD.classList.remove("btn-danger");
          btnD.classList.add("btn-default");
          deleteVote(answerId);
          addVote(answerId,1);
          // ajax delete and insert
        }else{
          //  ajax insert
          addVote(answerId,1);
        }
        btn.classList.remove("btn-default");
        btn.classList.add("btn-success");
      }else{
        btn.classList.remove("btn-success");
        btn.classList.add("btn-default");
        // ajax to delete
        deleteVote(answerId);
      }
      diffVotes(answerId);
    }

    function downvoteAnswer(answerId) {
      var btn = document.getElementById("downVoteBtn_"+answerId);
      var btnU = document.getElementById("upVoteBtn_"+answerId);
      if(btn.classList.contains("btn-default")){
        if(btnU.classList.contains("btn-success")){
          btnU.classList.remove("btn-success");
          btnU.classList.add("btn-default");
          //ajax to delete and insert
          deleteVote(answerId);
          addVote(answerId,0);
        }else{
          //ajax to insert
          addVote(answerId,0);
        }
        btn.classList.remove("btn-default");
        btn.classList.add("btn-danger");
      }else{
        btn.classList.remove("btn-danger");
        btn.classList.add("btn-default");
        // ajax to delete
        deleteVote(answerId);
      }
      diffVotes(answerId);
    }

    function deleteQuestion() {
      var sure = confirm("Are you sure you want to delete?");
      if (sure) {
          $.ajax({
            type: "POST",
            url : "<?php echo base_url()."dashboard/PublicQuestion/deleteQuestion"; ?>",
            data: {
              "id" : <?php echo $id ?>,
            },
            success:function (data) {
              window.location.href = "<?php echo base_url()."dashboard/quespost"; ?>";
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
