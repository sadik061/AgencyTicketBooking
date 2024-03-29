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
                <h1 class="page-header">Flights</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>



        <div class="row">
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
                                            <input id="flownDateFrom" name="Flown_Date_From" value=<?php echo $_SESSION['From'];?> class="datepicker">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label >To</label>
                                            <input id="flownDateTo" name="Flown_Date_To" value=<?php echo $_SESSION['To'];?> class="datepicker">
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->

                            <button type="submit" name="insert_main_data" value="insert_main_data"  class="btn btn-default btn-primary">SUBMIT</button>
                            <button type="reset" onclick="reset()" class="btn btn-default btn-primary">RESET</button>
                            <button id="print" onclick="printData('page-wrapper')" class="btn btn-default btn-primary">Print</button>
                    </form>
                </div>
            </div>


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

    window.onload = function(e) {
        /*
         var today = new Date();
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
         document.getElementById("flownDateFrom").value=today;
         document.getElementById("flownDateTo").value=today;
         */
        //load();
    };
    function load()
    {

        var From=document.getElementById("flownDateFrom").value;
        var To=document.getElementById("flownDateTo").value;
        // alert(From+" "+To);
        $.ajax({
            type: 'POST',
            url: 'Update_Table_Session_Data.php',
            data: {
                From: From,
                To: To
            },
            success: function(response) {
                window.open("../pages/Flights.php","_self");
            }
        });

    }
    function printData(printDiv)
    {
        var headstr = "<html><head><title></title></head><body>";
        var footstr = "</body>";
        var newstr = document.all.item(printDiv).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr+newstr+footstr;
        window.print();
        document.body.innerHTML = oldstr;
        return false;
    }

</script>


</body>
</html>
