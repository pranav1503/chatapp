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
  </style>
</head>
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

      <div class="col-lg-3 col-12" style="cursor:pointer;">
        <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>Questions Asked</h3>

          <p>1000</p>
        </div>
        <div class="icon">
          <i class="fas fa-question"></i>
        </div>
        <a class="small-box-footer"> &nbsp;</a>
      </div>
    </div>
    <div class="col-lg-3 col-12" style="cursor:pointer;">
      <!-- small box -->
    <div class="small-box bg-secondary">
      <div class="inner">
        <h3>Answered</h3>

        <p>999</p>
      </div>
      <div class="icon">
        <i class="fas fa-thumbs-up"></i>
      </div>
      <a class="small-box-footer"> &nbsp;</a>
    </div>
  </div>
       <?php } ?>

       <?php
         if ($user['type'] == "teacher") {
        ?>
        <div class="col-lg-3 col-12" style="cursor:pointer;">
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
   if ($user['type'] == "student") {
  ?>
 <div class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1 class="m-0 text-dark">Ask a new Question</h1>
       </div><!-- /.col -->
     </div><!-- /.row -->
   </div><!-- /.container-fluid -->
 </div>

 <section class="content">
   <div class="container-fluid">
     <div class="row">
       <div class="col-md-12">

         <div class="card card-danger">
           <div class="card-header">
             <h3 class="card-title">Question Form</h3>
           </div>
           <div class="card-body">
             <!-- Date dd/mm/yyyy -->
             <div class="row">
               <div class="col-6">
                 <div class="form-group">
                   <label>Question</label>
                   <div class="autocomplete form-control">
                    <input type="text" id="questionbox" name="myCountry" placeholder="Question">
                   </div>
                 </div>
                 <!-- /.form-group -->
               </div>
               <div class="col-6">
                 <div class="form-group">
                   <label>Teacher</label>
                   <div class="autocomplete form-control">
                    <input id="myInput" type="text" name="myCountry" placeholder="Search..">
                    <input type="hidden" name="teacher" id="teacher">
                   </div>
                 </div>
                 <!-- /.form-group -->
               </div>
             </div>
             <div class="row">
               <div class="col-12">
                 <label>Description</label><br>
                 <div class="mb-3">
                   <textarea class="textarea" placeholder="Place some text here"
                             style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                 </div>
               </div>
             </div>
             <div class="row">
               <div class="col-6">
                 <button type="button" id="askBtn" class="btn btn-danger btn-lg btn-block" name="button" onclick="askFun()">Ask</button>
               </div>
             </div>
             <script type="text/javascript">
               function askFun() {
                 $.ajax({
                   type: "POST",
                   url : "<?php echo base_url()."dashboard/dashboard/ask"; ?>",
                   data: {
                     "question" : $("#questionbox").val(),
                     "teacher" : $("#teacher").val(),
                     "description" : $(".note-editable").html(),
                     "student" : "<?php echo $user['email_id']; ?>"
                   },
                   success:function (data) {
                     window.location.href = "<?php echo base_url()."question/"; ?>"+data;
                   },
                   error: function() {
                     alert("Error");
                   }
                 });
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

 <script>
function autocomplete(inp, arr,tea) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].name.toLowerCase().indexOf(val.toLowerCase()) > -1) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = arr[i].name;
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' id='myteacher' name='teacher' value='" + arr[i].name + "'>";
          b.innerHTML += "<input type='hidden' id='teaacx' name='teacher' value='" + arr[i].email + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {

              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              tea.value = this.getElementsByTagName("input")[1].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}
var teachers = <?php echo $teachers; ?>

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), teachers,document.getElementById("teacher"));
</script>
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

<?php }?>
<?php
  include 'footer.php';
 ?>
