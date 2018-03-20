<?php
if(!isset($_SESSION))
{
    session_start();
}
/**
 * Created by PhpStorm.
 * User: Abdullah Al Rifat
 * Date: 20-Mar-18
 * Time: 8:58 PM
 */
echo '<script type="text/javascript"> alert("v");</script>';
$_SESSION['From']=$_POST['From'];
$_SESSION['To']=$_POST['To'];
?>