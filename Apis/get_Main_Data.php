<?php
if(!isset($_SESSION))
{
    session_start();
}

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
                        'input_id'=>$data['maindata_id'],
                        'Name'=>$data['maindata_Name'],
                        'Cell_No'=>$data['maindata_PhoneNo'],
                        'Fare'=>$data['maindata_Fare'],
                        'Paid'=>$data['maindata_Paid'],
                        'Due'=>$data['maindata_Due'],
                        'Commission'=>$data['maindata_Commission'],
                        'Ticket_By'=>$data['maindata_Ticket_By'],
                        'Comment'=>$data['maindata_Comment'],
                        'Point'=>$data['maindata_Point'],
                        'Date'=>$data['maindata_Date'],
                        'Flown_Date'=>$data['maindata_Flown_Date'],
                        'Pnr'=>$data['maindata_Pnr'],
                        'Pax'=>$data['maindata_Pax'],
                        'Route'=>$data['maindata_Route'],
                        'Airlines'=>$data['maindata_Airlines']
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

