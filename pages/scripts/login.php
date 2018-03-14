<?php  session_start();

?>
<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Al Rifat
 * Date: 13-Mar-18
 * Time: 5:32 PM
 */

        if(isset($_POST['login']))   // it checks whether the user clicked login button or not
        {

            $email=$_POST['email'];
            $password=$_POST['password'];

            if($email == "info@theicthub.com" && $password == "1234")  // username is  set to "Ank"  and Password
            {                                   // is 1234 by default

                $_SESSION['user']=$email;
                $_SESSION['loggedIn']=true;


                echo '<script type="text/javascript"> window.open("../dashboard.php","_self");</script>';            //  On Successful Login redirects to home.php
                //exit();
                //echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';            //  On Successful Login redirects to home.php

            }

            else
            {
                echo "invalid UserName or Password";
            }
        }
        else
        {
            echo '<script type="text/javascript"> window.open("../../index.php","_self");</script>';
        }



?>