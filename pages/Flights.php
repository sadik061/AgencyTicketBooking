<?php include '../pages/templates/head.html'; ?>

<?php  if(!isset($_SESSION))
{
    session_start();
} ;

?>

<body>
  <div id="wrapper">
<?php

    include '../pages/templates/headermenu.html';
    include '../pages/templates/sidemenu.html';
    include '../pages/templates/footer.html';
?>
      <?php

      if(!isset($_SESSION['loggedIn']))   // Checking whether the session is already there or not if
          // true then header redirect it to the home page directly
      {
          echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';            //  On Successful Login redirects to home.php
          exit();
          /* Redirect browser */

      }

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
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
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


                      <?php include('../Apis/get_Flights.php');  ?>
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
<script>
    alert("script");
    $.ajax({
        url: '../Apis/get_Flights.php',
        dataType: 'json'
        success: updateTable
    });
    function updateTable(json)
    {
        var table=document.getElementById('dataTables');
        var len = json.length;
        alert(len);
        for (row = 0; row < len; row++){
            tr = document.createElement('tr');

                td = document.createElement('td');
                    tn = document.createTextNode(json[row].Flown_Date);
                    td.appendChild(tn);
                    tn = document.createTextNode(json[row].Flown_Time);
                    td.appendChild(tn);
                    tn = document.createTextNode(json[row].Pnr);
                    td.appendChild(tn);
                    tn = document.createTextNode(json[row].Name);
                    td.appendChild(tn);
                    tn = document.createTextNode(json[row].Cell_No);
                    td.appendChild(tn);
                    tn = document.createTextNode(json[row].Airlines);
                    td.appendChild(tn);
                    tn = document.createTextNode(json[row].Route);
                    td.appendChild(tn);
            tr.appendChild(td);

            table.appendChild(tr);
        }

    }
</script>


</body>
</html>
