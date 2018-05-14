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


  <div id="page-wrapper">
    <?php

    if(!isset($_SESSION['loggedIn']))   // Checking whether the session is already there or not if
      // true then header redirect it to the home page directly
    {
      echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';            //  On Successful Login redirects to home.php
      exit();
      /* Redirect browser */

    }
    else
    {
      if($_SESSION['loggedIn']==false)
      {
        echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';            //  On Successful Login redirects to home.php
        exit();
      }
    }
    $_SESSION['From']='0000-00-00';
    $_SESSION['To']='2999-11-30';

    ?>
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Dashboard</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-plane fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge" id="flights">0</div>
                              <div>Flights</div>
                          </div>
                      </div>
                  </div>
                  <a href="../pages/Flights.php">
                      <div class="panel-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-green">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-ticket fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge" id="fare">0</div>
                              <div>Sell</div>
                          </div>
                      </div>
                  </div>
                  <a href="../pages/main.php">
                      <div class="panel-footer">
                          <span class="pull-left">Add New</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-yellow">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-bell fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge" id="paid">0</div>
                              <div>Paid</div>
                          </div>
                      </div>
                  </div>
                  <a href="../pages/Dues.php">
                      <div class="panel-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-red">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-support fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge" id="dues">0</div>
                              <div>Dues</div>
                          </div>
                      </div>
                  </div>
                  <a href="../pages/Dues.php">
                      <div class="panel-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
      </div>




      <div class="row" style="margin-bottom: 20px;">
          <div class="col-lg-6">
              <div class="input-group custom-search-form">
              <input type="text" id="pnr" class="form-control" placeholder="Search PNR...">
              <span class="input-group-btn">
                                <button class="btn btn-default" id="loadpnr" type="button" onclick="loadPNR()">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
          </div>
          <div class="col-lg-6">
          <div class="input-group custom-search-form">
              <input type="text" id="agent" class="form-control" placeholder="Search Agent mobile number...">
              <span class="input-group-btn">
                                    <button class="btn btn-default" id="loadagent" type="button" onclick="loadAgent()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
          </div>
          </div>
          <br><br><br>
          <div class="col-lg-6">
              <div class="input-group custom-search-form">
                  <input type="text" id="client" class="form-control" placeholder="Search Client mobile number...">
                  <span class="input-group-btn">
                                    <button class="btn btn-default" id="loadclient" type="button" onclick="loadClient()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
              </div>
          </div>
      </div>
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  All Data
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                      <thead>
                      <tr>
                         <th>#</th>
                         <th>Passenger Name</th>
                         <th>Passenger Phone</th>
                         <th>Fare</th>
                         <th>Paid</th>
                         <th>Due</th>
                          <th>Flight Time</th>
                         <th>Pax</th>
                          <th>Route</th>
                          <th>Airlines</th>
                      </tr>
                      </thead>
                      <tbody id="tbody">

                      <script>
                          function loadPNR() {
                              var pnr=document.getElementById("pnr").value;
                              $.ajax({
                                  type: 'POST',
                                  url: '../Apis/get_Dashboard_PNR.php',
                                  data: {
                                      PNR: pnr
                                  },
                                  success: function(response) {
                                     // alert(response);
                                      document.getElementById("tbody").innerHTML=response;
                                      //window.open("../pages/Airlines.php","_self");
                                  }
                              });
                          }
                          function loadAgent() {
                              var agent=document.getElementById("agent").value;
                              $.ajax({
                                  type: 'POST',
                                  url: '../Apis/get_Dashboard_Agent.php',
                                  data: {
                                      Agent: agent
                                  },
                                  success: function(response) {
                                      //alert(response);
                                      document.getElementById("tbody").innerHTML=response;
                                      //window.open("../pages/Airlines.php","_self");
                                  }
                              });
                          }
                          function loadClient() {
                              var client=document.getElementById("client").value;
                              $.ajax({
                                  type: 'POST',
                                  url: '../Apis/get_Dashboard_Client.php',
                                  data: {
                                      client: client
                                  },
                                  success: function(response) {
                                      //alert(response);
                                      document.getElementById("tbody").innerHTML=response;
                                      //window.open("../pages/Airlines.php","_self");
                                  }
                              });
                          }
                          $(document).ready(function() {
                              var today = new Date();
                              var nextDay = new Date(today);
                              nextDay.setDate(today.getDate()+1);
                              var dd = today.getDate();
                              var mm = today.getMonth()+1; //January is 0!
                              var yyyy = today.getFullYear();
                              if(dd<10) {
                                  dd = '0'+dd
                              }

                              if(mm<10) {
                                  mm = '0'+mm
                              }

                              today = yyyy + '-' + mm + '-' + dd;


                                //getting tomorrow date
                              var tdd = nextDay.getDate();
                              var tmm = nextDay.getMonth()+1; //January is 0!
                              var tyyyy = nextDay.getFullYear();
                              if(tdd<10) {
                                  tdd = '0'+tdd
                              }

                              if(tmm<10) {
                                  tmm = '0'+tmm
                              }
                              nextDay=tyyyy + '-' +tmm + '-' + tdd;
                              //alert(today+" "+nextDay);
                              var From=today;
                              var To=nextDay;
                              // alert(From+" "+To);
                              $.ajax({
                                  type: 'POST',
                                  url: '../Apis/get_DashBoard_Data.php',
                                  data: {
                                      From: From,
                                      To: To
                                  }, error: function (xhr, status) {
                                      alert("error:"+status);
                                  },
                                  success: function(response) {
                                      //alert(response);
                                      //alert("start");
                                      var obj = JSON.parse(response);
                                      //alert("start");
                                      var datas=obj.Dashboard_data;
                                     // alert("start");
                                      var total_Flights=0;
                                      var total_Fare=0;
                                      var total_paid=0;
                                      var total_due=0;
                                      //alert("start");
                                      for (var key in datas) {
                                          if (datas.hasOwnProperty(key)) {
                                             //alert("in");
                                              total_Flights+=parseInt(datas[key].Flights);
                                              total_paid+=parseInt(datas[key].Total_Paid);
                                              total_due+=parseInt(datas[key].Total_Due);
                                              total_Fare+=parseInt(datas[key].Total_Fare);
                                              //alert(key + " -> " + datas[key].Flights);
                                          }
                                      }
                                     // alert(total_Flights);
                                      document.getElementById("flights").innerHTML = total_Flights;
                                      document.getElementById("fare").innerHTML = total_Fare;
                                      document.getElementById("paid").innerHTML = total_paid;
                                      document.getElementById("dues").innerHTML = total_due;

                                  }
                              });
                          });





                      </script>

                      </tbody>
                  </table>
                  <!-- /.table-responsive -->
              </div>
              <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
      </div>



  </div>
</div>



<script>

    // Get the input field
    var pnr = document.getElementById("pnr");
    var agent = document.getElementById("agent");
    var client = document.getElementById("client");

    // Execute a function when the user releases a key on the keyboard
    pnr.addEventListener("keyup", function(event) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            // Trigger the button element with a click
            document.getElementById("loadpnr").click();
        }
    });
    // Execute a function when the user releases a key on the keyboard
    agent.addEventListener("keyup", function(event) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            // Trigger the button element with a click
            document.getElementById("loadagent").click();
        }
    });
    // Execute a function when the user releases a key on the keyboard
    client.addEventListener("keyup", function(event) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            // Trigger the button element with a click
            document.getElementById("loadclient").click();
        }
    });
</script>


</body>
</html>
