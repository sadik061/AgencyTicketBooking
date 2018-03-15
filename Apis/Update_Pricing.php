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
	$id = $_POST['id'];
        $BDM   = $_POST['BDM'];
        $ICU   = $_POST['ICU'];
	$HDU   = $_POST['HDU'];
	$NICU   = $_POST['NICU'];
        try{
            if(isset($BDM) && isset($ICU) && isset($HDU) && isset($NICU) && isset($id)){
                $sqlInsert = "UPDATE Pricing SET ICU='$ICU', HDU='$HDU', NICU='$NICU' WHERE id='$id'";
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
$insert = new InsertDetails();
$insert->startInsertDetails();

