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

        ?>
        <div class="col-lg-12">
            <h1 class="page-header">Airlines Capping By Date</h1>

        </div>
        <form role="form" method="post"  action="../Apis/insert_Capping.php">
            <div class="col-lg-12" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Capping Info
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-11">

                                <div class="col-xs-3">
                                    <label>Amount</label>
                                    <input id="Amount" name="Amount" class="form-control">
                                </div>
                                <div class="col-xs-3">
                                    <label>Airlines.</label>
                                    <select name="Airlines" id="airline" class="form-control">
                                    </select>
                                </div>
                                <div class="col-xs-4">
                                    <label>By</label>
                                    <input id="PaymentBy" name="PaymentBy" class="form-control" placeholder="Enter text">
                                </div>
                                <div class="col-xs-2">
                                    <label>MCD No.</label>
                                    <input id="MCDNo" name="MCDNo" class="form-control" placeholder="Enter text">
                                </div>
                                <div class="form-group col-xs-12">
                                    <label style="margin-top:  50px;">Payment Date</label>
                                    <input id="Date" name="Date" class="datepicker">
                                </div>

                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>

                <button type="submit" name="insert_capping_data" value="insert_capping_data" class="btn btn-default btn-primary">SUBMIT</button>
                <button type="reset" onclick="reset()" class="btn btn-default btn-primary">RESET</button>
            </div>
        </form>



        <?php include('../Apis/get_Capping_Table.php');  ?>
        <!-- Tables-->






        <!--end of table -->


        <script type="text/javascript">
            function reset() {
                var allInputFields=document.getElementsByTagName("input");
                for (var i = 1; i < allInputFields.length; i++) {
                    allInputFields[i].value="";
                }

            }
            $(document).ready(function() {
                var airlines = document.getElementById("airline");
                //getting airlines
                $.ajax({
                    type: 'POST',
                    url: '../Apis/get_Airlines.php',
                    async: false,
                    data: {},
                    error: function (xhr, status) {
                        alert(status);
                    },
                    success: function (data) {
                        //when found names sending them in datalist for suggetions

                        var obj = JSON.parse(data);

                        var datas = obj.airlines_data;

                        var options = '';
                        for (var key in datas) {
                            if (datas.hasOwnProperty(key)) {
                                var option = document.createElement("option");
                                option.text = datas[key].Name;
                                option.value = datas[key].id;
                                airlines.add(option);
                            }
                        }
                    }
                });

            });
            function DeleteRow(t,id) {
                //alert($(t).closest('tr').index());
                var rowNumber=$(t).closest('tr').index();
                var x = document.getElementById("dataTables").rows[rowNumber+1].cells;
                //alert(x[7].innerHTML);
                // var paid=x[7].innerHTML;
                //var due=x[8].innerHTML;
                var airlinesName=x[1].innerHTML;
                var r = confirm("Are You Sure To Delete "+airlinesName+" ?");
                if (r == true) {
                    $.ajax({
                        type: 'POST',
                        url: '../Apis/Delete_Capping.php',
                        data: {
                            id:id
                        },
                        error: function (xhr, status) {
                            alert(status);
                        },
                        success: function(response) {
                            // alert(response);
                            alert("Successfully Deleted Capping")
                            window.open("../pages/AirlinesCapping.php","_self");
                        }
                    });
                } else {

                }

                //alert(id);
            }
        </script>



</body>
</html>
