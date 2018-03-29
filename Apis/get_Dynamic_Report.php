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
        $StartDate=$_POST['StartDate'];
        $EndDate=$_POST['EndDate'];
        // echo '<script type="text/javascript">alert("Reached");</script>';
        try{
            $sqlQuery = "SELECT Date,SUM(Fare) as Total_Fare,SUM(Paid) as Total_Paid,
SUM(Due) as Total_Due,COUNT(Date) as Total_Sell 
FROM 
maindata 
WHERE Date BETWEEN '$StartDate' AND '$EndDate' 
GROUP BY Date";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                array_push($jsonFood,
                    array(
                        'Date'=>$data['Date'],
                        'Total_Fare'=>$data['Total_Fare'],
                        'Total_Paid'=>$data['Total_Paid'],
                        'Total_Due'=>$data['Total_Due'],
                        'Total_Sell'=>$data['Total_Sell']
                    ));
            }
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            echo json_encode(array("Report_data"=>$jsonFood,$status=>1,$message=>"Success"));
        }else{
            echo json_encode(array("Report_data"=>null,$status=>0, $message=>"Failed while displaying Main Data"));
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

