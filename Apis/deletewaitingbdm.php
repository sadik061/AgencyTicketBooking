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
        $id   = $_POST['id'];
       
        try{
            if(isset($id)){
                $sqlInsert = "Delete From WaitingBdms WHERE id = '$id'";
                $conn->exec($sqlInsert);
            }
        }catch (PDOException $e){
            echo "Error while inserting ".$e->getMessage();
        }
        //cek is the row was inserted or not
        if($sqlInsert){
            //success inserted
            $response["success"] = 1;
            $response["message"] = "Details successful Deleted!";
            echo json_encode($response);
        }else{
            //failed inserted
            $response["success"] = 0;
            $response["message"] = "Failed while Deleting data";
            echo json_encode($response);
        }
    }
}
$insert = new InsertDetails();
$insert->startInsertDetails();

