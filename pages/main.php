<?php include '../pages/templates/head.html'; ?>

<?php  session_start();

?>

<body>
  <div id="wrapper">


<?php

    include '../pages/templates/headermenu.html';
    include '../pages/templates/sidemenu.html';
    include '../pages/templates/footer.html';
?>


<div id="page-wrapper">
  <?php

  if(!isset($_SESSION['loggedIn']))   // Checking whether the session is already there or not if
    // true then header redirect it to the home page directly
  {
      echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';            //  On Successful Login redirects to home.php
      exit();
    /* Redirect browser */

  }

  ?>

  <div class="col-lg-12">
                      <h1 class="page-header">Add New Entry</h1>
                  </div>
<div class="col-lg-8" >
  <div class="panel panel-default">
      <div class="panel-heading">
          Basic Info
      </div>
          <div class="panel-body">
              <div class="row">
                  <div class="col-lg-11">
                      <form role="form">
                          <div class="col-xs-8">
                              <label>Name</label>
                              <input id="name" class="form-control">
                          </div>
                          <div class="col-xs-4">
                              <label>Cell No.</label>
                              <input id="cellNo" class="form-control" placeholder="Enter text">
                          </div>

                    </div>
                  <!-- /.col-lg-6 (nested) -->
              </div>
              <!-- /.row (nested) -->
          </div>
      <!-- /.panel-body -->
  </div>

  <div class="panel panel-default">
      <div class="panel-heading">
          Payment Info
      </div>
          <div class="panel-body">
              <div class="row">
                  <div class="col-lg-5" style="padding-top: 3.5%;">

                        <div class="form-group input-group">
                            <span class="input-group-addon" style="padding: 6px 34px;">Fare</span>
                            <input id="fare" type="text" class="form-control">
                            <span class="input-group-addon">Taka</span>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="padding: 5px 34px;">Paid</span>
                            <input id="paid" type="text" class="form-control">
                            <span class="input-group-addon">Taka</span>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="padding: 5px 35px;">Due</span>
                            <input id="due" type="text" class="form-control">
                            <span class="input-group-addon">Taka</span>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">Commision</span>
                            <input id="commision" type="text" class="form-control">
                            <span class="input-group-addon">Taka</span>
                        </div>

                    </div>

                    <div class="col-lg-7">

                            <div class="form-group">
                                <label>Ticket By</label>
                                <input id="ticketBy" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Comment</label>
                                <input id="comment" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Point</label>
                                <input id="point" class="form-control">
                            </div>

                      </div>
                  <!-- /.col-lg-6 (nested) -->
              </div>
              <!-- /.row (nested) -->
          </div>
      <!-- /.panel-body -->
  </div>


</div>


<div class="col-lg-4" >
  <div class="panel panel-default">
      <div class="panel-heading">
          Ticket Info
      </div>
          <div class="panel-body">
              <div class="row">
                  <div class="col-lg-11">

                          <div class="form-group">
                              <label style="width: 31%;">Date</label>
                              <input id="date" class="datepicker">
                          <div class="form-group">
                              <label style="width: 31%;">Flown Date</label>
                              <input id="flownDate" class="datepicker">
                          </div>
                          <div class="form-group">
                              <label>PNR</label>
                              <input id="pnr" class="form-control">
                          </div>
                          <div class="form-group">
                              <label>PAX</label>
                              <input id="pax" class="form-control">
                          </div>
                          <div class="form-group">
                              <label>Route</label>
                              <input id="route" class="form-control">
                          </div>
                          <div class="form-group">
                              <label>Airlines</label>
                              <input id="airline" class="form-control">
                          </div>
                          <button type="submit" name="insert_main_data" value="insert_main_data" class="btn btn-default btn-primary">SUBMIT</button>
                          <button type="reset" onclick="reset()" class="btn btn-default btn-primary">RESET</button>

                      </form>
                    </div>
                  <!-- /.col-lg-6 (nested) -->
              </div>
              <!-- /.row (nested) -->
          </div>
      <!-- /.panel-body -->
  </div>

</div>



</div>

</div>


  <script type="text/javascript">
     function reset() {
         var allInputFields=document.getElementsByTagName("input");
         for (var i = 1; i < allInputFields.length; i++) {
             allInputFields[i].value="";
         }

     }
  </script>


</body>
</html>
