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
        $Name   = $_POST['Name'];
        $PhoneNo   = $_POST['Cell_No'];
        $Email   = $_POST['Email'];
        $Password  = $_POST['Password'];
        $Role  = "Moderator";
        date_default_timezone_set('Asia/Dhaka');
        // Then call the date functions
        $input_Time = date('Y-m-d H:i:s');

        try{

            //isset for int numbers they can be 0
            //!empty values can't be 0
            if(!empty($Name) && !empty($PhoneNo) && isset($Email) && isset($Password)){

                $sqlInsert = "INSERT INTO user (user_id, user_Name,user_PhoneNo, user_Email, user_Password, user_Role, user_Input_Time)
                VALUES (0, '$Name', '$PhoneNo', '$Email', '$Password', '$Role', '$input_Time')";
                $conn->exec($sqlInsert);
            }


        }catch (PDOException $e){
            echo "Error while inserting ".$e->getMessage();
        }
        //cek is the row was inserted or not
        if($sqlInsert){

            //success inserted
            echo '<script type="text/javascript">alert("Successfully Inserted !!!");</script>';
            //echo $sqlInsert;
            echo '<script type="text/javascript"> window.open("../pages/Moderators.php","_self");</script>';
            die();
        }else{
            echo '<script type="text/javascript">alert("Error , Try Again!!!");</script>';
            //echo '<script type="text/javascript"> window.open("../pages/dashboard.php","_self");</script>';
            die();
        }
    }
}
if(isset($_SESSION['loggedIn']))   // it checks whether the user clicked login button or not
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