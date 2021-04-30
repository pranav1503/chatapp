<head>
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
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

    .searchBtnUI:hover{
      cursor: pointer;
    }

    .searchBtnLogo:hover{
      cursor: pointer;
      background-color: #0069D9;
      color: white;
    }

  </style>
</head>
<?php
  include 'header.php';
 ?>

 <div class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-7">
         <h1 class="m-0 text-dark">All Questions</h1>

       </div><!-- /.col -->
       <div class="col-sm-3">
            <div class="input-group input-group-sm float-sm-right">
              <input class="form-control" type="search" id="searchInput" placeholder="Search" aria-label="Search">
              <div class="input-group-append searchBtnUI" onclick="displayQuestions()">
                <span class="input-group-text searchBtnLogo">
                  <i class="fas fa-search"></i>
                </span>
              </div>
            </div>
       </div>
       <div class="col-sm-2">
            <div class="input-group input-group-sm float-sm-right">
              <select class="form-control" name="" id="myTag" onchange="displayQuestions()">
                <option value="">ALL</option>
                <option value="java">JAVA</option>
                <option value="git">GIT</option>
                <option value="placements">PLACEMENTS</option>
                <option value="academics">ACADEMICS</option>
                <option value="python">PYTHON</option>
                <option value="sql">SQL</option>
                <option value="c">C</option>
                <option value="web">WEB</option>
                <option value="casual">Casual</option>
              </select>
            </div>
       </div><!-- /.col -->
     </div><!-- /.row -->
   </div><!-- /.container-fluid -->
 </div>

 <!-- <section class="content">

 </section> -->



 <section class="content">
   <div class="container-fluid">
     <div class="row">
       <div class="col-6">

       </div>
     </div>
   </div>
   <div class="container-fluid" id="public-questions">

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


</script>
<script type="text/javascript">

  function questionList(public_questions) {
    if(public_questions.length == 0){
      document.getElementById("public-questions").innerHTML="<h3 align='center'>No public questions available</h3>";
    }else{
        var output = ``;
        var imgRegex = new RegExp($("#searchInput").val(),"i", "g");
        for(var i=0;i<public_questions.length;i++){
          var myDate = new Date(public_questions[i].date);
          console.log(public_questions[i].date);
          var options = { year: 'numeric', month: 'short', day: 'numeric' };

          output += `<div class="container-fluid">
                        <div class="row">
                          <div class="col-lg-8">
                            <div class="card card-info">
                              <div class="card-body">
                                <div class="row">
                                  <h4 style="overflow:hidden;white-space:nowrap;text-overflow: ellipsis;">`+ public_questions[i].question +`</h4>
                                </div>
                                <div class="row">
                                  <div class="col-9">
                                    <p style="color:grey"><span class="badge badge-secondary">`+public_questions[i].tag+` </span> &nbsp;&nbsp;`+ ((public_questions[i].ansCount==0)?`No answers`: ((public_questions[i].ansCount == 1)?(public_questions[i].ansCount+` answer`):(public_questions[i].ansCount+` answers`))) +`</p>
                                    <a href="<?php echo base_url() ?>public/question/`+public_questions[i].id+`" class="btn btn-primary">View Answer(s)&nbsp;&nbsp;&nbsp;<i class="fas fa-hand-point-right"></i></a>
                                  </div>
                                  <div class="col-3">
                                    <div class="row">
                                       <div class="col-12">
                                         <span style="color:grey;">asked `+ myDate.toLocaleDateString('en-US',options) +`</span>
                                       </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-2">
                                        <img src="<?php echo base_url()?>/back_static/profile/student/default.png" alt="" style="height:40px;border-radius:5px;">
                                      </div>
                                      <div class="col-10">
                                        <p style="color:grey;overflow-x:hidden;white-space:nowrap;text-overflow: ellipsis">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`+public_questions[i].asked_by+`</p>
                                      <div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- /.card-body -->
                            </div>
                          </div>
                        </div>
                        <!-- Small boxes (Stat box) -->
                      </div>
                    </div>
                   </div>`;
         if($("#searchInput").val() != ""){
            output = output.replaceAll(output.match(imgRegex),"<b>"+output.match(imgRegex)+"</b>");
          }
          document.getElementById("public-questions").innerHTML=output;
        }
    }
  }

  function displayQuestions() {
    console.log();
    $.ajax({
      type: "POST",
      url : "<?php echo base_url()."dashboard/Dashboard/searchBar"; ?>",
      async: false,
      data: {
        "pattern" : $("#searchInput").val(),
        "tagPattern" : $("#myTag").val(),
        "userId" : <?php echo $user['id']; ?>
      },
      success:function (data) {
        data = JSON.parse(data);
        questionList(data);
      },
      error: function(data) {
        console.log(data);
        alert("Error");
      }
    });
  }
  var public_questions_php = <?php echo $public_questions; ?>;
  questionList(public_questions_php);

</script>

<?php
  include 'footer.php';
 ?>
