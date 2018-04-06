<?php
if(!isset($_SESSION))
{
    session_start();
}
// include db connect class
require_once __DIR__ . '/Connection.php';
class InsertDetails{
    function startInsertDetails(){
        $connection = new Connection();
        $conn = $connection->getConnection();
        //array for json response
        $response = array();
        $Amount  = $_POST['Amount'];
        $Airlines   = $_POST['Airlines'];
        //getting user email via login session just to tract who is inserting data or updating data
        $PaymentBy  =  $_POST['PaymentBy'];
        $MCDNo  = $_POST['MCDNo'];
        $Date  = $_POST['Date'];
        //getting user email via login session just to tract who is inserting data or updating data
        $Entry_By  =  $_SESSION['id'];
        date_default_timezone_set('Asia/Dhaka');

        // Then call the date functions
        $input_Time = date('Y-m-d H:i:s');
        try{
            //echo $Name." ".$Cell_No." ".$Point." ".$Comission;
            //echo !empty($Name)." ".!empty($Cell_No)." ".isset($Point)." ".isset($Comission);
            if(!empty($Amount) && !empty($Airlines)&& !empty($PaymentBy)&& !empty($MCDNo)&& !empty($Date) ){

                $sqlInsert = "INSERT INTO capping (capping_id, capping_Amount, capping_Airlines, capping_Payment_By, capping_MCD_No, capping_Date, capping_Entry_By, capping_Input_Time) VALUES (0, '$Amount', '$Airlines', '$PaymentBy', '$MCDNo', '$Date', '$Entry_By', '$input_Time')";
                $conn->exec($sqlInsert);
            }

        }catch (PDOException $e){
            echo "Error while inserting ".$e->getMessage();
        }
        //cek is the row was inserted or not
        if($sqlInsert){
            //success inserted
            echo '<script type="text/javascript">alert("Successfully Inserted !!!");</script>';
            echo '<script type="text/javascript"> window.open("../pages/dashboard.php","_self");</script>';
            die();
        }else{

            echo '<script type="text/javascript">alert("Error , Try Again!!!");</script>';
            echo '<script type="text/javascript"> window.open("../pages/AirlinesCapping.php","_self");</script>';
            die();
        }
    }
}
if(isset($_POST['insert_capping_data']) && isset($_SESSION['loggedIn']))   // it checks whether the user clicked login button or not
{
    $insert = new InsertDetails();
    $insert->startInsertDetails();
}
else
{
    echo '<script type="text/javascript">alert("Bad Request !!!");</script>';
    echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';
    die();
}