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
        $From=$_SESSION['From'];
        $To=$_SESSION['To'];
        // echo $From." ".$To;
        try{
            $sqlQuery = "SELECT * FROM maindata Flown_Date WHERE Flown_Date >= '$From' AND Flown_Date<='$To' ORDER BY Flown_Date ASC";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            /* foreach($result as $data)
             {
                 array_push($jsonFood,
                     array(
                         'id'=>$data['input_id'],
                         'Flown_Date'=>explode(" ", $data['Flown_Date'])[0],
                         'Flown_Time'=>explode(" ", $data['Flown_Date'])[1],
                         'Pnr'=>$data['Pnr'],
                         'Name'=>$data['Name'],
                         'Cell_No'=>$data['Cell_No'],
                         'Airlines'=>$data['Airlines'],
                         'Route'=>$data['Route']
                     ));
             }*/
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            foreach($result as $data)
            {
                echo "<tr>";

                echo "<td>";
                echo explode(" ", $data['Flown_Date'])[0];
                echo "</td>";

                echo "<td>";
                echo explode(" ", $data['Flown_Date'])[1];
                echo "</td>";

                echo "<td>";
                echo $data['Pnr'];
                echo "</td>";

                echo "<td>";
                echo $data['Name'];
                echo "</td>";

                echo "<td>";
                echo  $data['Cell_No'];
                echo "</td>";

                echo "<td>";
                echo $data['Airlines'];
                echo "</td>";

                echo "<td>";
                echo $data['Route'];
                echo "</td>";

                echo "</tr>";
            }
            //echo json_encode(array("user_data"=>$jsonFood,$status=>1,$message=>"Success"));
        }else{
            echo json_encode(array("user_data"=>null,$status=>0, $message=>"Failed while displaying Main Data"));
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

