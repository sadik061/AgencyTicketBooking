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
            $sqlQuery = "SELECT * FROM airlines,maindata WHERE airlines.Name=maindata.Airlines AND Flown_Date BETWEEN '$From' and '$To'";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            //defining first table number
            $i=1;
            foreach($result as $data)
            {
                //if first table id matched it means new data new table need to made
                if($i==$data['id'])
                {
                    echo '</tbody></table>';
                    //per row number default 1 for every table define it to 1
                    $j=1;
                    //for every new data defining new table
                    echo '<table class="table table-striped table-bordered table-hover">';

                    echo '<div>';
                    echo $data['Airlines'];
                    echo '</div>';

                    echo '<div>';
                    echo 'Total Amount';
                    echo '</div>';

                    echo '<div>';
                    echo 'TotalSell';
                    echo '</div>';

                    echo '<div>';
                    echo 'Total Capping';
                    echo '</div>';

                    echo '<thead><tr>';
                    echo '<th>#</th>';
                    echo '<th>PNR</th>';
                    echo '<th>Route</th>';
                    echo '<th>Time</th>';
                    echo '<th>Paid</th>';
                    echo '<th>Due</th>';
                    echo '</tr></thead><tbody>';
                    $i++;
                }
                echo "<tr>";

                echo "<td>";
                    echo "$j";
                echo "</td>";

                echo "<td>";
                    echo $data['Pnr'];
                echo "</td>";

                echo "<td>";
                    echo $data['Route'];
                echo "</td>";

                echo "<td>";
                    echo $data['Flown_Date'];
                echo "</td>";

                echo "<td>";
                    echo  $data['Paid'];
                echo "</td>";

                echo "<td>";
                    echo $data['Due'];
                echo "</td>";

                echo "</tr>";
                $j++;
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

