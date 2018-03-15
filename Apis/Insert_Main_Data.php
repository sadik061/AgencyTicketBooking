<?php
session_start();
/**
 * Created by PhpStorm.
 * User: putuguna
 * Date: 1/24/2017
 * Time: 10:54 AM
 */
// include db connect class

require_once __DIR__ . '/Connection.php';
class InsertDetails{
    function startInsertDetails(){
        $connection = new Connection();
        $conn = $connection->getConnection();
        //array for json response
        $response = array();
        $Name   = $_POST['Name'];
        $Cell_No   = $_POST['Cell_No'];
	    $Fare   = $_POST['Fare'];
	    $Paid  = $_POST['Paid'];
        $Due  = $_POST['Due'];
        $Commission  = $_POST['Commission'];
        $Ticket_By  = $_POST['Ticket_By'];
        $Comment  = $_POST['Comment'];
        $Point  = $_POST['Point'];
        $Date  = $_POST['Date'];
        $Flown_Date  = $_POST['Flown_Date'];
        $Pnr  = $_POST['Pnr'];
        $Pax  = $_POST['Pax'];
        $Route  = $_POST['Route'];
        $Airlines  = $_POST['Airlines'];
        try{
            if(!empty($Name) && !empty($Cell_No) && !empty($Fare) && !empty($Paid) && !empty($Due)&& !empty($Commission)&& !empty($Ticket_By)&&
                !empty($Comment)&& !empty($Point)&& !empty($Date)&& !empty($Flown_Date)&& !empty($Pnr)&& !empty($Pax)&& !empty($Route)&& !empty($Airlines)){
                $sqlInsert = "INSERT INTO maindata (input_id, Name, Cell_No, Fare, Paid, Due, Commission, Ticket_By, Comment,
                Point, Date, Flown_Date, Pnr, Pax, Route, Airlines) VALUES (0, '$Name', '$Cell_No', '$Fare', '$Paid', '$Due', '$Commission',
                 '$Ticket_By', '$Comment', '$Point', '$Date', '$Flown_Date', '$Pnr', '$Pax', '$Route', '$Airlines')";
                $conn->exec($sqlInsert);
            }

        }catch (PDOException $e){
            echo "Error while inserting ".$e->getMessage();
        }
        //cek is the row was inserted or not
        if($sqlInsert){
            //success inserted
            $response["success"] = 1;
            $response["message"] = "Details successful inserted!";
            echo json_encode($response);
        }else{
            //failed inserted
            $response["success"] = 0;
            $response["message"] = "Failed while insert data";
            echo json_encode($response);
        }
    }
}
if(isset($_POST['insert_main_data']) && isset($_SESSION['loggedIn']))   // it checks whether the user clicked login button or not
{
    $insert = new InsertDetails();
    $insert->startInsertDetails();
}
else
{
    $response["success"] = 0;
    $response["message"] = "Bad Request";
    echo json_encode($response);
}

