<?php
session_start();
/**
 * Created by PhpStorm.
 * User: putuguna
 * Date: 1/25/2017
 * Time: 10:33 AM
 */
require_once __DIR__ . '/Connection.php';
class DisplayJsonFood{
    function getAllJsonFood(){
        $connection = new Connection();
        $conn = $connection->getConnection();
        $jsonFood = array();
        $status="status";
        $message = "message";
        try{
            $sqlQuery = "SELECT * FROM maindata";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                array_push($jsonFood,
                    array(
                        'input_id'=>$data['input_id'],
                        'Name'=>$data['Name'],
                        'Cell_No'=>$data['Cell_No'],
			            'Fare'=>$data['Fare'],
                        'Paid'=>$data['Paid'],
                        'Due'=>$data['Due'],
                        'Commission'=>$data['Commission'],
                        'Ticket_By'=>$data['Ticket_By'],
                        'Comment'=>$data['Comment'],
                        'Point'=>$data['Point'],
                        'Date'=>$data['Date'],
                        'Flown_Date'=>$data['Flown_Date'],
                        'Pnr'=>$data['Pnr'],
                        'Pax'=>$data['Pax'],
                        'Route'=>$data['Route'],
			            'Airlines'=>$data['Airlines']
                    ));
            }
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            echo json_encode(array("main_data"=>$jsonFood,$status=>1,$message=>"Success"));
        }else{
            echo json_encode(array("main_data"=>null,$status=>0, $message=>"Failed while displaying Main Data"));
        }
    }
}
if(isset($_SESSION['loggedIn']))   // Checking whether the session is already there or not if
    // true then header redirect it to the home page directly
{
    $json = new DisplayJsonFood();
    $json->getAllJsonFood();
}else
{
    $response["success"] = 0;
    $response["message"] = "Bad Request";
    echo json_encode($response);
    /* Redirect browser */
}

