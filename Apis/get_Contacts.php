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
        $name=$_POST['Name'];
       // echo '<script type="text/javascript">alert("Reached");</script>';
        try{
            $sqlQuery = "SELECT * FROM contacts WHERE NAME LIKE '$name%'";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                array_push($jsonFood,
                    array(
                        'id'=>$data['id'],
                        'Name'=>$data['Name'],
                        'Cell_No'=>$data['Cell_No'],
                        'Point'=>$data['Point'],
                        'Comission'=>$data['Comission'],
                        'Entry_By'=>$data['Entry_By']
                    ));
            }
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            echo json_encode(array("contacts_data"=>$jsonFood,$status=>1,$message=>"Success"));
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

