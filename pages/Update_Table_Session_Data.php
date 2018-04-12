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
//echo '<script type="text/javascript"> alert("v");</script>';
$_SESSION['From']=$_POST['From'];
$next_date = date('Y-m-d', strtotime($_POST['To'] .' +1 day'));
$_SESSION['To']=$next_date;
?>