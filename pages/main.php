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

<div class="panel panel-default">
  <div class="col-lg-12">
                      <h1 class="page-header">Add New Entry</h1>
                  </div>
  <div class="panel-body">
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
                              <input class="form-control">
                          </div>
                          <div class="col-xs-4">
                              <label>Cell No.</label>
                              <input class="form-control" placeholder="Enter text">
                          </div>
                      </form>
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
                      <form role="form">
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="padding: 6px 12%;">Fare</span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon">Taka</span>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="padding: 6px 12%;">Paid</span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon">Taka</span>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="padding: 6px 12%;">Due</span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon">Taka</span>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">Commision</span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon">Taka</span>
                        </div>
                      </form>
                    </div>

                    <div class="col-lg-7">
                        <form role="form">
                            <div class="form-group">
                                <label>Ticket By</label>
                                <input class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Comment</label>
                                <input class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Point</label>
                                <input class="form-control">
                            </div>
                        </form>
                      </div>
                  <!-- /.col-lg-6 (nested) -->
              </div>
              <!-- /.row (nested) -->
          </div>
      <!-- /.panel-body -->
  </div>

  <button type="submit" class="btn btn-default btn-primary">Submit Button</button>
  <button type="reset" class="btn btn-default btn-primary">Reset Button</button>
</div>


<div class="col-lg-4" >
  <div class="panel panel-default">
      <div class="panel-heading">
          Ticket Info
      </div>
          <div class="panel-body">
              <div class="row">
                  <div class="col-lg-11">
                      <form role="form">
                          <div class="form-group">
                              <label>PNR</label>
                              <input class="form-control">
                          </div>
                          <div class="form-group">
                              <label>PAX</label>
                              <input class="form-control">
                          </div>
                          <div class="form-group">
                              <label>Route</label>
                              <input class="form-control">
                          </div>
                          <div class="form-group">
                              <label>Airlines</label>
                              <input class="form-control">
                          </div>
                          <div class="form-group">
                              <label style="width: 31%;">Date</label>
                              <input class="datepicker">
                          </div>
                          <div class="form-group">
                              <label style="width: 31%;">Flown Date</label>
                              <input class="datepicker">
                          </div>

                      </form>
                    </div>
                  <!-- /.col-lg-6 (nested) -->
              </div>
              <!-- /.row (nested) -->
          </div>
      <!-- /.panel-body -->
  </div>

</div>



</div
</div>
</div>




</body>
</html>
