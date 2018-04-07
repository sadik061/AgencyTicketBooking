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
        $Point   = $_POST['Point'];
        echo $id." ".$Point;
        try{
            if( isset($id)&&isset($Point)){
                $sqlInsert = "UPDATE airlines SET airlines_Point= airlines_Point+'$Point' WHERE airlines_id='$id'";
                $conn->exec($sqlInsert);

            }
        }catch (PDOException $e){
            echo '<script type="text/javascript">alert("Error While Updating Contact Point");</script>';
        }
        //cek is the row was inserted or not
        if($sqlInsert){
            //success inserted
            echo '<script type="text/javascript">alert("Successfully Updated Paid Dume Amount");</script>';
        }else{
            echo '<script type="text/javascript">alert("Unable To Updated Paid Due Amount");</script>';
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