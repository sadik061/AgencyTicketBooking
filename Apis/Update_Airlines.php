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
        $id = $_POST['id'];
        $Name  = $_POST['Name'];
        $Point  = $_POST['Point'];
        //echo $id." ".$Paid." ".$Due;
        try{
            if(isset($Name)&&isset($Phone) && isset($id)){
                $sqlInsert = "UPDATE airlines SET airlines_Name='$Name', airlines_Point='$Point' WHERE airlines_id='$id'";
                $conn->exec($sqlInsert);

            }
        }catch (PDOException $e){
            echo '<script type="text/javascript">alert("Error While Updating Agent Info");</script>';
        }
        //cek is the row was inserted or not
        if($sqlInsert){
            //success inserted
            echo '<script type="text/javascript">alert("Successfully Updated Agent Info");</script>';
        }else{
            echo '<script type="text/javascript">alert("Unable To Updated Agent Info");</script>';
        }
    }
}

if(isset($_SESSION['loggedIn']))   // it checks whether the user clicked login button or not
{
    $insert = new InsertDetails();
    $insert->startInsertDetails();
}
else {
    echo '<script type="text/javascript">alert("Bad Request !!!");</script>';
    echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';
    die();
}