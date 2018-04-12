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
            <h1 class="page-header">Add New Entry</h1>

        </div>
        <form role="form" method="post"  action="../Apis/insert_Main_Data.php">
            <div class="col-lg-8" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Basic Info
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-11">

                                <div class="col-xs-8">
                                    <label>Name</label>
                                    <input id="name" name="Name" class="form-control">
                                </div>
                                <div class="col-xs-4">
                                    <label>Cell No.</label>
                                    <input id="cellNo" name="Cell_No" class="form-control" placeholder="Enter text">
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
                                    <input id="fare" name="Fare" type="text" class="form-control">
                                    <span class="input-group-addon">Taka</span>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="padding: 5px 34px;">Paid</span>
                                    <input id="paid" name="Paid" type="text" class="form-control">
                                    <span class="input-group-addon">Taka</span>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="padding: 5px 35px;">Due</span>
                                    <input id="due" name="Due" type="text" class="form-control">
                                    <span class="input-group-addon">Taka</span>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Commision</span>
                                    <input id="commision" name="Commission" type="text" class="form-control">
                                    <span class="input-group-addon">Taka</span>
                                </div>

                            </div>

                            <div class="col-lg-7">

                                <div class="form-group">
                                    <label>Ticket By</label>
                                    <select name="Ticket_By" id="ticketBy" class="form-control">
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Comment</label>
                                    <input id="comment" name="Comment" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Point</label>
                                    <input id="point" name="Point" class="form-control">
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
                                    <input type="text" id="Date" name="Date" data-field="date" readonly/>
                                    <div class="form-group">
                                        <label style="width: 31%;">Flight</label>
                                        <!--<input id="flownDate" name="Flown_Date" class="datetime">-->
                                        <input type="text"  id="Flown_Date" name="Flown_Date" data-field="datetime" readonly/>
                                        <div id="dtBox2"> </div>
                                        <script>
                                            $('#dtBox2').DateTimePicker(
                                                {
                                                    dateTimeFormat: "yyyy-MM-dd hh:mm:ss",
                                                    dateFormat: "yyyy-MM-dd"
                                                }
                                            );
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label>PNR</label>
                                        <input id="pnr" name="Pnr" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>PAX</label>
                                        <input id="pax" name="Pax" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Route</label>
                                        <input id="route" name="Route" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Airlines</label>
                                        <select name="Airlines" id="airline" class="form-control">
                                        </select>
                                    </div>

                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>

                </div>

                <button type="submit" name="insert_main_data" value="insert_main_data" onclick="update_airlines_Point()" class="btn btn-default btn-primary">SUBMIT</button>
                <button type="reset" onclick="reset()" class="btn btn-default btn-primary">RESET</button>

            </div>
        </form>

    </div>
</div>


<script type="text/javascript">
    var contact_id=undefined;

    $(document).ready(function() {

        var ticket_by = document.getElementById("ticketBy");
        var airlines = document.getElementById("airline");
        //getting agents
        $.ajax({
            type: 'POST',
            url: '../Apis/get_Contacts.php',
            async:false,
            data: {
            },
            error: function (xhr, status) {
                alert(status);
            },
            success: function(data) {
                //when found names sending them in datalist for suggetions

                var obj = JSON.parse(data);

                var datas=obj.contacts_data;
                for (var key in datas) {
                    if (datas.hasOwnProperty(key)) {
                        var option = document.createElement("option");
                        option.text = datas[key].Name;
                        option.value=datas[key].id;
                        ticket_by.add(option);
                    }
                }
            }
        });
        //getting airlines
        $.ajax({
            type: 'POST',
            url: '../Apis/get_Airlines.php',
            async:false,
            data: {
            },
            error: function (xhr, status) {
                alert(status);
            },
            success: function(data) {
                //when found names sending them in datalist for suggetions

                var obj = JSON.parse(data);

                var datas=obj.airlines_data;

                var options = '';
                for (var key in datas) {
                    if (datas.hasOwnProperty(key)) {
                        var option = document.createElement("option");
                        option.text = datas[key].Name;
                        option.value=datas[key].id;
                        airlines.add(option);
                    }
                }
            }
        });

        //auto update due amount
        $("input[name=Paid]").focusout(function(){

            //alert("in update");
            var fare= document.getElementById('fare').value;
            var paid=document.getElementById('paid').value;
            var due=fare-paid;
            //alert(due);
            document.getElementById('due').value=due;
        });

        //checking if pnr already in the database or not
        $("input[name=Pnr]").focusout(function(){
            var pnr= document.getElementById('pnr').value;
            //alert(pnr);
            $.ajax({
                type: 'POST',
                url: '../Apis/Check_Pnr_Validity.php',
                async:false,
                data: {
                    Pnr: pnr,
                },
                error: function (xhr, status) {
                    alert(status);
                },
                success: function(data) {
                    // alert(data);
                    var obj = JSON.parse(data);
                    if(obj["success"]==1)
                    {
                        //alert("Unique");
                        //alert(obj["message"]);
                    }
                    else {
                        alert(obj["message"]);
                    }

                }
            });
        });
    });




    function update_airlines_Point() {


        var point= document.getElementById('point').value;
        var id=document.getElementById('airline').value;
        //alert("in update");
        $.ajax({
            type: 'POST',
            url: '../Apis/Update_Airlines_Point.php',
            async:false,
            data: {
                id:id,
                Point: point,
            },
            error: function (xhr, status) {
                alert(status);
            },
            success: function(data) {
                //when found names sending them in datalist for suggetions
                //alert(data);
            }
        });
    }


    function reset() {
        var allInputFields=document.getElementsByTagName("input");
        for (var i = 1; i < allInputFields.length; i++) {
            allInputFields[i].value="";
        }

    }

</script>


</body>
</html>
