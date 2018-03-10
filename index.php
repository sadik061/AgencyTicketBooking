<?php include 'pages/templates/head.html'; ?>



<body>
  <div id="wrapper">


<?php
    include 'pages/templates/headermenu.html';
    include 'pages/templates/sidemenu.html';
?>


<div id="page-wrapper">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Forms</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  Basic Form Elements
              </div>
              <div class="panel-body">


                          <h1>Input Groups</h1>
                          <form role="form">
                              <div class="form-group input-group">
                                  <span class="input-group-addon">@</span>
                                  <input type="text" class="form-control" placeholder="Username">
                              </div>
                              <div class="form-group input-group">
                                  <input type="text" class="form-control">
                                  <span class="input-group-addon">.00</span>
                              </div>
                              <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-eur"></i>
                                  </span>
                                  <input type="text" class="form-control" placeholder="Font Awesome Icon">
                              </div>
                              <div class="form-group input-group">
                                  <span class="input-group-addon">$</span>
                                  <input type="text" class="form-control">
                                  <span class="input-group-addon">.00</span>
                              </div>
                              <div class="form-group input-group">
                                  <input type="text" class="form-control">
                                  <span class="input-group-btn">
                                      <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                      </button>
                                  </span>
                              </div>
                          </form>


  <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->
</div>
</div>
</div>


<?php include 'pages/templates/footer.html'; ?>



</body>
</html>
