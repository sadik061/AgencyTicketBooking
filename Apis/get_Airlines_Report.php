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
            $sqlQuery = "SELECT 
 airlines_id,airlines_Name,maindata_Pnr,maindata_Route,maindata_Flown_Date,maindata_Paid,maindata_Due,
(select SUM(maindata_Fare) from maindata WHERE airlines_id=maindata_Airlines AND maindata_Flown_Date>='$From' and maindata_Flown_Date <='$To') as TotalAmount ,
(select COUNT(maindata_id) FROM maindata WHERE airlines_id=maindata_Airlines AND maindata_Flown_Date>='$From' and maindata_Flown_Date <='$To' ) as TotalSell, 
(select SUM(capping_Amount) from capping WHERE capping_Airlines=airlines_id AND capping_Date>='$From' and capping_Date <='$To')as TotalCapping, 
(select SUM(maindata_Due) from maindata WHERE airlines_id=maindata_Airlines GROUP BY airlines_id) as TotalDueCapping, 
(select SUM(airlines_Point) from airlines WHERE airlines_id=maindata_Airlines GROUP BY airlines_id) as TotalPoint FROM airlines,maindata
WHERE airlines_id=maindata_Airlines AND maindata_Flown_Date >= '$From' and maindata_Flown_Date <='$To'";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        echo '<div class="row">';
        if($sqlQuery){
            //defining first table number
            $i=0;
            $iid=-1;
            echo '<div class="col-lg-12">';

            foreach($result as $data)
            {
                echo '</tbody></table>';

                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading">';
                if($iid != $data['airlines_id'])
                {


                    //per row number default 1 for every table define it to 1
                    $j=1;
                    //for every new data defining new table
                    echo '<table class="table table-striped table-bordered table-hover">';

                    echo '<div>';
                    echo $data['airlines_Name'];
                    echo '</div>';

                    echo '<div>';
                    echo 'Total Amount : '.$data['TotalAmount'];
                    echo '</div>';

                    echo '<div>';
                    echo 'TotalSell : '.$data['TotalSell'];
                    echo '</div>';

                    echo '<div>';
                    echo 'Total Capping : ';
                    echo ($data['TotalCapping'] == null)?0:$data['TotalCapping'];
                    echo '</div>';

                    echo '<div>';
                    echo 'Total Due Capping : '.$data['TotalDueCapping'];
                    echo '</div>';

                    echo '<div>';
                    echo 'Total Point : '.$data['TotalPoint'];
                    echo '</div>';

                    echo '</div>';

                    echo '<thead><tr>';
                    echo '<th>#</th>';
                    echo '<th>PNR</th>';
                    echo '<th>Route</th>';
                    echo '<th>Time</th>';
                    echo '<th>Paid</th>';
                    echo '<th>Due</th>';
                    echo '</tr></thead><tbody>';
                    $iid=$data['airlines_id'];
                    $i++;
                }
                echo "<tr>";

                echo "<td>";
                echo "$j";
                echo "</td>";

                echo "<td>";
                echo $data['maindata_Pnr'];
                echo "</td>";

                echo "<td>";
                echo $data['maindata_Route'];
                echo "</td>";

                echo "<td>";
                echo $data['maindata_Flown_Date'];
                echo "</td>";

                echo "<td>";
                echo  $data['maindata_Paid'];
                echo "</td>";

                echo "<td>";
                echo $data['maindata_Due'];
                echo "</td>";

                echo "</tr>";
                echo '</div>';
                echo '</div>';
                echo '</div>';
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

