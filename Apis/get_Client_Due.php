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
        $finalArray=null;
        $status="status";
        $message = "message";
        $Phone=$_POST['Phone'];
        // echo $From." ".$To;
        try{
            $sqlQuery = "SELECT * FROM maindata,airlines  WHERE maindata_Airlines=airlines_id AND maindata_Due > 0 AND maindata_PhoneNo ='$Phone' ORDER BY maindata_Flown_Date ASC";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
             foreach($result as $data)
             {
                 array_push($jsonFood,
                     array(
                         'Flown_Date'=>explode(" ", $data['maindata_Flown_Date'])[0],
                         'Flown_Time'=>explode(" ", $data['maindata_Flown_Date'])[1],
                         'Pnr'=>$data['maindata_Pnr'],
                         'Name'=>$data['maindata_Name'],
                         'Cell_No'=>$data['maindata_PhoneNo'],
                         'Airlines'=>$data['airlines_Name'],
                         'Route'=>$data['maindata_Route'],
                         'Paid'=>$data['maindata_Paid'],
                         'Due'=>$data['maindata_Due'],
                     ));
             }
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){

            echo json_encode(array("client_due_data"=>$jsonFood,$status=>1,$message=>"Success"));
        }else{
            echo json_encode(array("client_due_data"=>null,$status=>0, $message=>"Failed while displaying Main Data"));
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

