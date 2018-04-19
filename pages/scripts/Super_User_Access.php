<?php
if(!isset($_SESSION))
{
    session_start();
}
/**
 * Created by PhpStorm.
 * User: Abdullah Al Rifat
 * Date: 19-Apr-18
 * Time: 8:51 PM
 */


    if( $_SESSION['User_Type']=="Admin")
    {
        echo"  <li>
                        <a href=\"../pages/Moderators.php\">Moderators</a>
                    </li>
                    ";
    }
    else
    {

    }
?>