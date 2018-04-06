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
                                    <input id="Airlines" name="Airlines" class="form-control" placeholder="Enter text">
                                    <datalist id="AirlineSuggestions">
                                        <option value="Black">
                                    </datalist>
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




        <!-- Tables-->






        <!--end of table -->


        <script type="text/javascript">
            function reset() {
                var allInputFields=document.getElementsByTagName("input");
                for (var i = 1; i < allInputFields.length; i++) {
                    allInputFields[i].value="";
                }

            }
            //getting airlines names suggetions
            $('#Airlines').on('input', function() {

                var textValueOfInput = $(this).val();
                //alert(textValueOfInput);
                //requesting to get all contacts with the starting name in the input field
                $.ajax({
                    type: 'POST',
                    url: '../Apis/get_Airlines.php',
                    async:false,
                    data: {
                        Name: textValueOfInput,
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
                                options += '<option value="'+datas[key].Name+'" data-id="'+datas[key].id+'"/>';
                                //alert(key + " -> " + datas[key].Name);
                            }
                        }
                        document.getElementById('AirlineSuggestions').innerHTML = options;

                        //getting the selected suggetions and searching the comission value for the name and saving in the comission field
                        $("input[name=Airlines]").focusout(function(){
                            for (var key in datas) {
                                if (datas.hasOwnProperty(key)) {
                                    if(datas[key].Name==$(this).val())
                                    {
                                        contact_id=datas[key].id;
                                        document.getElementById('Airlines').value = contact_id;
                                        break;
                                    }
                                }
                            }
                        });
                    }


                });

            });



        </script>



</body>
</html>
