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
                <h1 class="page-header">Agent Payment</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Payment
                    </div>
                    <form role="form" method="post" action="../Apis/insert_payment.php">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="form-group">
                                        <div class="form-group col-lg-4">
                                            <label >Contact Number :</label>
                                            <input id="PaymentPhoneNo" name="PaymentPhoneNo" value="" class="text">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label >Amount :</label>
                                            <input id="PaymentAmount" name="PaymentAmount" value="" class="text">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label >Date :</label>
                                            <input id="PaymentDate" name="PaymentDate" value=<?php echo $_SESSION['From'];?> class="datepicker">
                                        </div>
                                        <input type="hidden" id="PaymentBy" name="PaymentBy" value="agent" class="text">
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->

                            <button type="submit" name="insert_main_data" value="insert_main_data"  class="btn btn-default btn-primary">Pay</button>
                    </form>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Search By Agent Mobile Number
                        </div>
                        <form role="form" method="post" onsubmit="load(); return false;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-11">
                                        <div class="form-group">
                                            <div class="form-group col-lg-4">
                                                <label >Contact Number :</label>
                                                <input id="Phone" name="Phone" value="" class="text">
                                            </div>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->

                                <button type="submit" name="insert_main_data" value="insert_main_data"  class="btn btn-default btn-primary">Search</button>
                        </form>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-heading" id="due">
                            Total Due : 0
                        </div>
                        <div class="panel-heading">
                            Search Result
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
                                    <th>Paid</th>
                                    <th>Due</th>

                                </tr>
                                </thead>
                                <tbody>


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

        function load()
        {
            var Phone=document.getElementById("Phone").value;
            $("#dataTables").empty();
            $.ajax({
                type: 'POST',
                url: '../Apis/get_Agent_Due.php',
                async: false,
                data: {
                    Phone :Phone
                },
                error: function (ts) {
                    alert(ts.responseText);
                },
                success: function (data) {
                    //when found names sending them in datalist for suggetions
                    //alert(data);
                    var table = document.getElementById("dataTables");

                    var row = table.insertRow(0);
                    row.className='table table-striped table-bordered table-hover';
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    var cell6 = row.insertCell(5);
                    var cell7 = row.insertCell(6);
                    var cell8 = row.insertCell(7);
                    var cell9 = row.insertCell(8);
                    cell1.innerHTML = "Flight Date";
                    cell2.innerHTML = "Flight Time";
                    cell3.innerHTML = "PNR";
                    cell4.innerHTML = "Name";
                    cell5.innerHTML = "Cell Phone";
                    cell6.innerHTML = "Airline";
                    cell7.innerHTML = "Route";
                    cell8.innerHTML = "Paid";
                    cell9.innerHTML = "Due";

                    var obj = JSON.parse(data);

                    var datas=obj.agent_due_data;
                    var count = Object.keys(datas).length;
                    if(count == 0)
                        alert("No Data Found");
                    var i=1;

                    var due=0;
                    for (var key in datas) {
                        if (datas.hasOwnProperty(key)) {
                            //alert(datas[key].Flown_Date);
                            var row = table.insertRow(i);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            var cell4 = row.insertCell(3);
                            var cell5 = row.insertCell(4);
                            var cell6 = row.insertCell(5);
                            var cell7 = row.insertCell(6);
                            var cell8 = row.insertCell(7);
                            var cell9 = row.insertCell(8);
                            cell1.innerHTML = ""+datas[key].Flown_Date;
                            cell2.innerHTML = ""+datas[key].Flown_Time;
                            cell3.innerHTML = ""+datas[key].Pnr;
                            cell4.innerHTML = ""+datas[key].Name;
                            cell5.innerHTML = ""+datas[key].Cell_No;
                            cell6.innerHTML = ""+datas[key].Airlines;
                            cell7.innerHTML = ""+datas[key].Route;
                            cell8.innerHTML = ""+datas[key].Paid;
                            cell9.innerHTML = ""+datas[key].Due;

                            due+=parseInt(datas[key].Due);
                            i++;
                        }
                    }
                    document.getElementById("due").innerHTML="Total Due : "+due;

                }
            });
        }
    </script>



</body>
</html>
