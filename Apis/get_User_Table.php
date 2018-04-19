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
            $sqlQuery = "SELECT user_id,user_Name,user_PhoneNo,user_Email,user_Password,user_Role,user_Input_Time  FROM user";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);

        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            echo '<div class="row">';
            echo '<div class="col-lg-6">';

            echo '<table class="table table-striped table-bordered table-hover" id="dataTables" style="margin-top: 4%;">';
            echo '<thead><tr>';

            echo '<th>#</th>';
            echo '<th>Name</th>';
            echo '<th>Phone No</th>';
            echo '<th>Email</th>';
            echo '<th>Password</th>';
            echo '<th>Role</th>';
            echo '<th>Input Time</th>';
            echo '<th>Update</th>';
            echo '<th>Delete</th>';
            echo '</tr></thead><tbody>';
            foreach($result as $data)
            {
                echo "<tr>";

                echo "<td>";
                echo  $data['user_id'];
                echo "</td>";

                echo "<td contenteditable='true' >";
                echo $data['user_Name'];
                echo "</td>";

                echo "<td contenteditable='true' >";
                echo $data['user_PhoneNo'];
                echo "</td>";

                echo "<td contenteditable='true' >";
                echo $data['user_Email'];
                echo "</td>";

                echo "<td contenteditable='true' >";
                echo $data['user_Password'];
                echo "</td>";

                echo "<td>";
                echo $data['user_Role'];
                echo "</td>";
                echo "<td>";
                echo $data['user_Input_Time'];
                echo "</td>";


                $id=  $data['user_id'];
                echo "<td>";
                echo "<button type=\"button\" id=\"edit\" class=\"btn btn-outline btn-primary\" onclick=\"UpdateRow(this,'$id')\">Update</button>";
                echo "</td>";
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

