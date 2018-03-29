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
        else
        {
                if($_SESSION['loggedIn']==false)
                {
                        echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';            //  On Successful Login redirects to home.php
                        exit();
                }
        }

        ?>
        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Report</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ticket Info
                    </div>
                    <form role="form" method="post" onsubmit="load()">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="form-group">
                                        <div class="form-group col-lg-4">
                                            <label >From</label>
                                            <input id="flownDateFrom" name="Flown_Date_From"  class="datepicker">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label >To</label>
                                            <input id="flownDateTo" name="Flown_Date_To"  class="datepicker">
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->

                            <button type="submit" name="insert_main_data" value="insert_main_data"  class="btn btn-default btn-primary">SUBMIT</button>
                            <button type="reset" onclick="reset()" class="btn btn-default btn-primary">RESET</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-ticket fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">26</div>
                                    <div>Total Sell</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div>Total Payment</div>
                                </div>
                            </div>
                        </div>

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
                                    <div class="huge">124</div>
                                    <div>Total Due</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-credit-card fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Total Capping</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>




            <div class="col-lg-8">

                <canvas id="myChart" style="max-width: 500px;"></canvas>

                <script>
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                            datasets: [{
                                label: '# of Votes',
                                data: [12, 19, 3, 5, 2, 3],
                                backgroundColor: [
                                    'rgba(51, 51, 51, 0.2)',
                                    'rgba(51, 51, 51, 0.2)',
                                    'rgba(51, 51, 51, 0.2)',
                                    'rgba(51, 51, 51, 0.2)',
                                    'rgba(51, 51, 51, 0.2)',
                                    'rgba(51, 51, 51, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                </script>

                <div class="col-md-5">
                    <canvas id="myChart" ></canvas>
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
