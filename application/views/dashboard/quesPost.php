<?php
  include 'header.php';
 ?>





  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Your History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Of Questions</li>
            </ol>
          </div><!-- /.col -->
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class="form-group">
                <label for="dept">Private Questions:</label>
                <select name="dept" id="dept" class="form-control" onchange="selectQues();">
                  <option name="dept" value="all">All</option>
                  <option name="dept" value="ans">Answered</option>
                  <option name="dept" value="unans">Unaswered</option>
                </select>
            </div>
            <div  id="privateContainer">

            </div>
          </div><!-- /.col -->
          <?php
            if($user['type']=='student'){
           ?>
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
            <div class="form-group">
                <label for="dept">Public Questions:</label>
            </div>
          </div><!-- /.col -->
            <?php } ?>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<?php
    if($user['type']=='student'){
?>

    <!-- Main content -->
    <div id="CardContent">
      <div class="row">
        <div class="col-lg-6" id="privateCardContent">

        </div>
        <div class="col-lg-6" id="publicCardContent">

        </div>
      </div>

    </div>
    <!-- /.content -->
<script type="text/javascript">
var infos = <?php echo $info?>;
var publicInfos = <?php echo $publicInfo?>;
console.log(publicInfos);
console.log(infos);

if(publicInfos.length == 0){
  document.getElementById("publicContainer").innerHTML="<h1 align='center'>No public questions available</h1>";
}
else{
  var imgRegex = new RegExp("<img[^>]*?>", "g");
  var output = ``;
  for(var i=0;i<publicInfos.length;i++){
    output += `<div class="content" onclick="">
      <div class="container-fluid">
        <div class="row" onclick="goToPublicQuestionPage(`+publicInfos[i].id+`)">
          <div class="col-lg-12">
             <div class="card card-success card-outline">
              <div class="card-body">
                <h5 class="card-title" id="id1">`+ publicInfos[i].question + `</h5><br>
                <div class="row">
                <div class="col-lg-6">
                <h6 class="card-title"><br></h6>
                  </div>
                </div>

                </p>
                <div class="row">
                   <div class="col-lg-6">

                    </div>
                    <div class="col-lg-6">
                      <h6 align="right">Number of Answers: `+ publicInfos[i].ansCount + `</h6>
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
    </div>`;
   output = output.replace(output.match(imgRegex),"");
   document.getElementById("publicCardContent").innerHTML=output;
  }

  function goToPublicQuestionPage(id) {
    window.location.href = "<?php echo base_url()."public/question/"; ?>"+id;
  }
}



if(infos.length==0){
    document.getElementById("privateContainer").innerHTML="<h1 align='center'>No private questions available</h1>";
}
else{
var output="";
var imgRegex = new RegExp("<img[^>]*?>", "g");
function selectQues(){
    var select = document.getElementById("dept");
    if(select.value=="all"){
        output="";
        for(var i=0;i<infos.length;i++){
    var descrip="";
    descrip = infos[i].description;
    output += `<div class="content" onclick="clickFun(`+ infos[i].id +`)">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
             <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title" id="id1">`+ infos[i].question + `</h5><br>
                <div class="row">
                <div class="col-lg-6">
                <h6 class="card-title">`+ ((infos[i].answered == "0")?`Not Answered`: `Answered`) +`</h6>
                  </div>
                </div>

                </p>
                <div class="row">
                   <div class="col-lg-6">

                    </div>
                    <div class="col-lg-6">
                    <h6 align="right">--`+ infos[i].teacher + `</h6>
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
    </div>`;
   output = output.replace(output.match(imgRegex),"");
}
    document.getElementById("privateCardContent").innerHTML=output;
    }
    else if (select.value=="ans"){
        output="";
        for(var i=0;i<infos.length;i++){
    var descrip="";
            if(infos[i].answered=="1"){
                descrip = infos[i].description;
                    output += `<div class="content" onclick="clickFun(`+ infos[i].id +`)">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-lg-12">
                             <div class="card card-success card-outline">
                              <div class="card-body">
                                <h5 class="card-title" id="id1">`+ infos[i].question + `</h5><br>
                                <div class="row">
                                <div class="col-lg-6">
                                <h6 class="card-title">Answered</h6>
                                  </div>
                                </div>
                                </p>
                                <div class="row">
                                   <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-6">
                                    <h6 align="right">--`+ infos[i].teacher + `</h6>
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
                    </div>`;
   output = output.replace(output.match(imgRegex),"");
            }

}
    document.getElementById("privateCardContent").innerHTML=output;
    }

    else if (select.value=="unans"){
        output="";
        for(var i=0;i<infos.length;i++){
    var descrip="";
            if(infos[i].answered=="0"){
                descrip = infos[i].description;
                    output += `<div class="content" onclick="clickFun(`+ infos[i].id +`)">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-lg-12">
                             <div class="card card-danger card-outline">
                              <div class="card-body">
                                <h5 class="card-title" id="id1">`+ infos[i].question + `</h5><br>
                                <div class="row">
                                <div class="col-lg-6">
                                <h6 class="card-title testClass">No answers</h6>
                                  </div>
                                </div>
                                <div class="row">
                                   <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-6">
                                    <h6 align="right">--`+ infos[i].teacher + `</h6>
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
                    </div>`;
   output = output.replace(output.match(imgRegex),"");
            }

}
    document.getElementById("privateCardContent").innerHTML=output;
    }


}
}
   selectQues();

function clickFun(id) {
  window.location.href = "<?php echo base_url() ?>question/" + id;
}

</script>

<?php }
    else if ($user['type'] == "teacher"){
?>

    <!-- Main content -->
    <div id="CardContent">

    </div>
    <!-- /.content -->
<script type="text/javascript">
var infos = <?php echo $info?>;
if(infos.length==0){
    document.getElementById("CardContent").innerHTML="<h1 align='center'>Not Available</h1>";
}
else{
var output="";
var imgRegex = new RegExp("<img[^>]*?>", "g");
function selectQues(){
    var select = document.getElementById("dept");
    if(select.value=="all"){
        output="";
        for(var i=0;i<infos.length;i++){
    var descrip="";
    descrip = infos[i].description;
    output += `<div class="content" onclick="clickFun(`+ infos[i].id +`)">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
             <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title" id="id1">`+ infos[i].question + `</h5><br>
                <div class="row">
                <div class="col-lg-6">
                <h6 class="card-title">`+infos[i].answered +`</h6>
                  </div>
                </div>
                </p>
                <div class="row">
                   <div class="col-lg-6">

                    </div>
                    <div class="col-lg-6">
                    <h6 align="right">--`+ infos[i].teacher + `</h6>
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
    </div>`;
   output = output.replace(output.match(imgRegex),"");
}
    document.getElementById("CardContent").innerHTML=output;
    }
    else if (select.value=="ans"){
        output="";
        for(var i=0;i<infos.length;i++){
    var descrip="";
            if(infos[i].answered=="1"){
                descrip = infos[i].description;
                    output += `<div class="content" onclick="clickFun(`+ infos[i].id +`)">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-lg-6">
                             <div class="card card-success card-outline">
                              <div class="card-body">
                                <h5 class="card-title" id="id1">`+ infos[i].question + `</h5><br>
                                <div class="row">
                                <div class="col-lg-6">
                                <h6 class="card-title"></h6>
                                  </div>
                                </div>
                                </p>
                                <div class="row">
                                   <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-6">
                                    <h6 align="right">--`+ infos[i].teacher + `</h6>
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
                    </div>`;
   output = output.replace(output.match(imgRegex),"");
            }

}
    document.getElementById("CardContent").innerHTML=output;
    }

    else if (select.value=="unans"){
        output="";
        for(var i=0;i<infos.length;i++){
    var descrip="";
            if(infos[i].answered=="0"){
                descrip = infos[i].description;
                    output += `<div class="content" onclick="clickFun(`+ infos[i].id +`)">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-lg-6">
                             <div class="card card-danger card-outline">
                              <div class="card-body">
                                <h5 class="card-title" id="id1">`+ infos[i].question + `</h5><br>
                                <div class="row">
                                <div class="col-lg-6">
                                <h6 class="card-title"></h6>
                                  </div>
                                </div>
                                </p>
                                <div class="row">
                                   <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-6">
                                    <h6 align="right">--`+ infos[i].teacher + `</h6>
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
                    </div>`;
   output = output.replace(output.match(imgRegex),"");
            }

}
    document.getElementById("CardContent").innerHTML=output;
    }


}
}
   selectQues();
   function clickFun(id) {
     window.location.href = "<?php echo base_url() ?>question/" + id;
   }
</script>

<?php } ?>
<?php
  include 'footer.php';
 ?>
