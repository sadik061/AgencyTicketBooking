<?php include '../pages/templates/head.html'; ?>

<?php  if(!isset($_SESSION))
{
    session_start();
} ;

?>

<body  style="background-size: 100% 100%;    background-repeat: no-repeat, repeat;    background-image: url(https://zdnet2.cbsistatic.com/hub/i/2017/01/25/727576be-aaa5-4a21-803e-67ff665670dd/31ec2b80918f137576fb62d212c45f73/presentation-aeroplane-wing.jpg); margin-bottom: 26%;">
<?php

if(isset($_SESSION['loggedIn']))   // Checking whether the session is already there or not if
    // true then header redirect it to the home page directly
{
    if($_SESSION['loggedIn']!=false)
    {
        echo '<script type="text/javascript"> window.open("http://theicthub.com/ticketbooking/pages/dashboard.php","_self");</script>';            //  On Successful Login redirects to home.php
        exit();
    }
    /* Redirect browser */
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form method="post" role="form" action="http://theicthub.com/ticketbooking/Apis/Check_Login.php">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-lg btn-success btn-block" type="submit" name="login" value="login">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <!--  <a href="pages/dashboard.php" class="btn btn-lg btn-success btn-block">Login</a> -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../pages/templates/footer.html'; ?>

</body>

</html>
