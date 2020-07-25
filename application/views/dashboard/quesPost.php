<?php
  include 'header.php';
 ?>





  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">History</h1>
            <div class="form-group">                                                    
                <label for="dept">Questions:</label>
                <select name="dept" id="dept" class="form-control" onchange="selectQues();">
                  <option name="dept" value="all">All</option>
                  <option name="dept" value="ans">Answered</option>
                  <option name="dept" value="unans">Unaswered</option>
                </select>
            </div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Of Questions</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<?php
    if($user['type']=='student'){
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
    output += `<div class="content">
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
                <p class="card-text">`+ descrip.substring(0, 20).replace(descrip.match(imgRegex),"") + "..." + `
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
                    output += `<div class="content">
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
                                <p class="card-text">`+ descrip.substring(0, 20).replace(descrip.match(imgRegex),"") + "..." + `
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
                    output += `<div class="content">
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
                                <p class="card-text">`+ descrip.substring(0, 20).replace(descrip.match(imgRegex),"") + "..." + `
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
   
    

</script>

<?php } 
    else{
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
    output += `<div class="content">
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
                <p class="card-text">`+ descrip.substring(0, 20).replace(descrip.match(imgRegex),"") + "..." + `
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
                    output += `<div class="content">
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
                                <p class="card-text">`+ descrip.substring(0, 20).replace(descrip.match(imgRegex),"") + "..." + `
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
                    output += `<div class="content">
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
                                <p class="card-text">`+ descrip.substring(0, 20).replace(descrip.match(imgRegex),"") + "..." + `
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

</script>

<?php } ?>
<?php
  include 'footer.php';
 ?>