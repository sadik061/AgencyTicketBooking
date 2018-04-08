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
        $agent=$_POST['Agent'];
        try{
            $sqlQuery = "SELECT maindata_Name,maindata_PhoneNo,maindata_Fare,maindata_Paid,maindata_Due,maindata_Flown_Date,
            maindata_Pax,maindata_Route,airlines_Name FROM maindata,agent,airlines WHERE agent_PhoneNo='$agent' AND agent_id=maindata_Ticket_By
             AND airlines_id=maindata_Airlines";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);

        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            $i=1;
            foreach($result as $data)
            {
                echo "<tr>";

                echo "<td>";
                echo $i++;
                echo "</td>";

                echo "<td>";
                echo $data['maindata_Name'];
                echo "</td>";

                echo "<td>";
                echo $data['maindata_PhoneNo'];
                echo "</td>";

                echo "<td>";
                echo $data['maindata_Fare'];
                echo "</td>";

                echo "<td>";
                echo  $data['maindata_Paid'];
                echo "</td>";

                echo "<td>";
                echo $data['maindata_Due'];
                echo "</td>";

                echo "<td>";
                echo $data['maindata_Flown_Date'];
                echo "</td>";
                echo "<td>";
                echo $data['maindata_Pax'];
                echo "</td>";
                echo "<td>";
                echo $data['maindata_Route'];
                echo "</td>";
                echo "<td>";
                echo $data['airlines_Name'];
                echo "</td>";

                echo "</tr>";
            }
            echo '</tbody></table>';
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

