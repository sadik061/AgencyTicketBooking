<?php if(!isset($_SESSION))
{
    session_start();
} ?>

<html>
<head>
    <title>You Fraud !!!</title>
</head>
<body>
        What Are You Doing Here !!!
<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Al Rifat
 * Date: 15-Mar-18
 * Time: 7:50 PM
 */


  if(!isset($_SESSION['loggedIn']))   // Checking whether the session is already there or not if
      // true then header redirect it to the home page directly
  {
      echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';            //  On Successful Login redirects to home.php
      exit();
      /* Redirect browser */

  }


?>


</body>
</html>
