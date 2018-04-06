<?php
if(!isset($_SESSION))
{
    session_start();
}
// include db connect class
require_once __DIR__ . '/Connection.php';
class InsertDetails{
    function startInsertDetails(){
        $connection = new Connection();
        $conn = $connection->getConnection();
        //array for json response
        $response = array();
        $Pnr   = $_POST['Pnr'];
        try{

            if(!empty($Pnr) )
            {
                $sqlQuery = "SELECT * FROM maindata WHERE maindata_Pnr='$Pnr'";
                $getJson = $conn->prepare($sqlQuery);
                $getJson->execute();
                $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
                if(count($result) > 0) {

                    $response["success"] = 0;
                    $response["message"] = "Pnr Already Stored";
                    echo json_encode($response);
                    die();
                }
                else
                {
                    $response["success"] = 1;
                    $response["message"] = "Got Unique PNR";
                    echo json_encode($response);
                }

            }
        }catch (PDOException $e){
            echo '<script type="text/javascript">alert("Error Checking Pnr");</script>';
            die();
        }
    }
}
if(isset($_SESSION['loggedIn']))    // it checks whether the user clicked login button or not
{
    $insert = new InsertDetails();
    $insert->startInsertDetails();
}
else
{
    $response["success"] = 0;
    $response["message"] = "Bad Request";
    echo json_encode($response);
    die();
}