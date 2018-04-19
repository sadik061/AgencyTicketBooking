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
            <h1 class="page-header">Add new Moderator</h1>

        </div>
        <form role="form" method="post"  action="../Apis/insert_User.php">
            <div class="col-lg-12" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Member Info
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="col-xs-4">
                                    <label>Name</label>
                                    <input id="name" name="Name" class="form-control">
                                </div>
                                <div class="col-xs-3">
                                    <label>Phone No.</label>
                                    <input id="cellNo" name="Cell_No" class="form-control" placeholder="Enter text">
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <div class="row">
                            <div class="col-lg-11">

                                <div class="col-xs-3">
                                    <label>Email</label>
                                    <input id="email" name="Email" class="form-control" placeholder="Enter text">
                                </div>
                                <div class="col-xs-3">
                                    <label>Password</label>
                                    <input id="password" name="Password" class="form-control" placeholder="Enter text">
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>

                <button type="submit" name="insert_contacts_data" value="insert_contacts_data" class="btn btn-default btn-primary">SUBMIT</button>
                <button type="reset" onclick="reset()" class="btn btn-default btn-primary">RESET</button>
            </div>
        </form>
        <?php include('../Apis/get_User_Table.php');  ?>
    </div
</div>


<script>

    function DeleteRow(t,id) {
        //alert($(t).closest('tr').index());
        // var rowNumber=$(t).closest('tr').index();
        //var x = document.getElementById("dataTables").rows[rowNumber+1].cells;
        //alert(x[7].innerHTML);
        // var paid=x[7].innerHTML;
        //var due=x[8].innerHTML;
        //alert($(t).closest('tr').index());
        var rowNumber=$(t).closest('tr').index();
        var x = document.getElementById("dataTables").rows[rowNumber+1].cells;
        //alert(x[7].innerHTML);
        // var paid=x[7].innerHTML;
        //var due=x[8].innerHTML;
        var UserName=x[1].innerHTML;
        var r = confirm("Are You Sure To Delete "+UserName+" ?");
        if (r == true) {
            $.ajax({
                type: 'POST',
                url: '../Apis/Delete_User.php',
                data: {
                    id: id
                },
                error: function (xhr, status) {
                    alert(status);
                },
                success: function (response) {
                    // alert(response);
                    alert("Successfully Deleted User");
                    window.open("../pages/Moderators.php", "_self");
                }
            });
        }
        else {

        }
        //alert(id);
    }
    function UpdateRow(t,id) {
        //alert($(t).closest('tr').index());
        var rowNumber=$(t).closest('tr').index();
        var x = document.getElementById("dataTables").rows[rowNumber+1].cells;
        //alert(x[7].innerHTML);
        // var paid=x[7].innerHTML;
        //var due=x[8].innerHTML;
        var UserName=x[1].innerHTML;
        var UserPhone=x[2].innerHTML;
        var UserEmail=x[3].innerHTML;
        var UserPassword=x[4].innerHTML;
        var r = confirm("Are You Sure To Update "+UserName+" with Phone No :"+UserPhone+" ?");
        if (r == true) {
            $.ajax({
                type: 'POST',
                url: '../Apis/Update_User.php',
                data: {
                    id:id,
                    Name:UserName,
                    Cell_No:UserPhone,
                    Email:UserEmail,
                    Password:UserPassword
                },
                error: function (xhr, status) {
                    alert(status);
                },
                success: function(response) {
                    // alert(response);
                    alert("Successfully Updated User Info");
                    window.open("../pages/Moderators.php","_self");
                }
            });
        } else {

        }
        //alert(id);
    }
</script>
</body>
</html>
