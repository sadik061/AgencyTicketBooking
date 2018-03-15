<?php
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
            if(isset($Name) && isset($Cell_No) && isset($Fare) && isset($Paid) && isset($Due)&& isset($Commission)&& isset($Ticket_By)&&
                isset($Comment)&& isset($Point)&& isset($Date)&& isset($Flown_Date)&& isset($Pnr)&& isset($Pax)&& isset($Route)&& isset($Airlines)){
                $sqlInsert = "INSERT INTO maindata (input_id, Name, Cell_No, Fare, Paid, Due, Commission, Ticket_By, Comment,
                Point, Date, Flown_Date, Pnr, Pax, Route, Airlines) VALUES (0, '$Name', '$Cell_No', '$Fare', '$Paid', '$Due', '$Commission',
                 '$Ticket_By', '$Comment', '$Point', '$Date', '$Flown_Date', '$Pnr', '$Pax', '$Route', '$Airlines',)";
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
if(isset($_POST['insert_main_data']))   // it checks whether the user clicked login button or not
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

