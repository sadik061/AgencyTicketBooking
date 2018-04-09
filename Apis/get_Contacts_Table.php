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
        //$name=$_POST['Name'];
        // echo '<script type="text/javascript">alert("Reached");</script>';
        try{
            $sqlQuery = "SELECT agent_id,agent_Name,agent_PhoneNo,user_Name,agent_Input_Time  FROM agent,user WHERE agent_Entry_By=user_id";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);

        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            echo '<div class="row">';
            echo '<div class="col-lg-6">';

            echo '<table class="table table-striped table-bordered table-hover" style="margin-top: 4%;">';
            echo '<thead><tr>';

            echo '<th>#</th>';
            echo '<th>Name</th>';
            echo '<th>Phone No</th>';
            echo '<th>Added By</th>';
            echo '<th>Time</th>';
            echo '<th>Delete</th>';
            echo '</tr></thead><tbody>';
            foreach($result as $data)
            {
                echo "<tr>";

                echo "<td>";
                echo  $data['agent_id'];
                echo "</td>";

                echo "<td >";
                echo $data['agent_Name'];
                echo "</td>";

                echo "<td>";
                echo $data['agent_PhoneNo'];
                echo "</td>";

                echo "<td>";
                echo $data['user_Name'];
                echo "</td>";

                echo "<td>";
                echo $data['agent_Input_Time'];
                echo "</td>";
                $id=  $data['agent_id'];
                echo "<td>";
                echo "<button type=\"button\" id=\"edit\" class=\"btn btn-outline btn-primary\" onclick=\"DeleteRow(this,'$id')\">Delete</button>";
                echo "</td>";
                echo "</tr>";

            }
            echo '</div>';
            echo '</div>';
        }else{
            echo json_encode(array("contacts_data"=>null,$status=>0, $message=>"Failed while displaying Main Data"));
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

