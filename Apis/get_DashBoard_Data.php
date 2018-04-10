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
        $StartDate=$_POST['From'];
        $EndDate=$_POST['To'];
         //echo $StartDate." ".$EndDate;
        try{
            $sqlQuery = "SELECT 
COUNT(maindata_Flown_Date) as Flights,
SUM(maindata_Fare) as Total_Fare,
SUM(maindata_Paid) as Total_Paid, 
SUM(maindata_Due) as Total_Due 
FROM maindata 
WHERE maindata_Flown_Date >= '$StartDate' AND maindata_Flown_Date <= '$EndDate'";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                array_push($jsonFood,
                    array(
                        'Flights'=>$data['Flights'],
                        'Total_Fare'=>$data['Total_Fare'],
                        'Total_Paid'=>$data['Total_Paid'],
                        'Total_Due'=>$data['Total_Due']

                    ));
            }
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            echo json_encode(array("Dashboard_data"=>$jsonFood,$status=>1,$message=>"Success"));
        }else{
            echo json_encode(array("Dashboard_data"=>null,$status=>0, $message=>"Failed while displaying Main Data"));
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

