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
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Flights</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>

  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  DataTables Advanced Tables
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                          <tr>
                              <th>Flight Date</th>
                              <th>Flight Time</th>
                              <th>PNR</th>
                              <th>Name</th>
                              <th>Cell Phone</th>
                              <th>Airline</th>
                              <th>Route</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr class="odd gradeX">
                              <td>30-03-2018</td>
                              <td>12.00 PM</td>
                              <td>Win 95+</td>
                              <td class="center">4</td>
                              <td class="center">X</td>
                              <td class="center">4</td>
                              <td class="center">X</td>
                          </tr>

                      </tbody>
                  </table>
                  <!-- /.table-responsive -->
              </div>
              <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
  </div>
</div
</div>


<?php include 'pages/templates/footer.html'; ?>



</body>
</html>
