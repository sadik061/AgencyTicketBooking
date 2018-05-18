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
        $PaymentPhoneNo   = $_POST['PaymentPhoneNo'];
        $PaymentBy   = $_POST['PaymentBy'];
        $PaymentAmount   = $_POST['PaymentAmount'];
        $PaymentDate  = $_POST['PaymentDate'];
        date_default_timezone_set('Asia/Dhaka');
        // Then call the date functions
        $input_Time = date('Y-m-d H:i:s');

        //getting the id of payment by type
        //if paid by agent get the agent id
        //if paid by client it will get fixed client id like 1
        if($PaymentBy=='agent')
        {
            $sqlQuery = "SELECT * FROM agent WHERE agent_PhoneNo='$PaymentPhoneNo'";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                $PaymentBy=$data['agent_id'];
            }

            $sqlQuery = "SELECT * FROM maindata WHERE maindata_Ticket_By='$PaymentBy'";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                if($data['maindata_Due'] > 0 && $data['maindata_Due'] >= $PaymentAmount)
                {
                    $dataid=$data['maindata_id'];
                    $datapaid=$data['maindata_Paid']+$PaymentAmount;
                    $datadue=$data['maindata_Due']-$PaymentAmount;
                    $sqlInsert = "UPDATE maindata SET maindata_Paid='$datapaid', maindata_Due='$datadue' WHERE maindata_id='$dataid'";
                    $conn->exec($sqlInsert);
                }
                else if($data['maindata_Due'] > 0 && $data['maindata_Due'] <= $PaymentAmount)
                {
                    $dataid=$data['maindata_id'];
                    $datapaid=$data['maindata_Paid']+$data['maindata_Due'];
                    $datadue=0;
                    $PaymentAmount=$PaymentAmount-$data['maindata_Due'];
                    $sqlInsert = "UPDATE maindata SET maindata_Paid='$datapaid', maindata_Due='$datadue' WHERE maindata_id='$dataid'";
                    $conn->exec($sqlInsert);
                }

            }

        }
        else if($PaymentBy=='client')
        {

            $sqlQuery = "SELECT * FROM agent WHERE agent_Name='client'";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                $PaymentBy=$data['agent_id'];
            }
            $sqlQuery = "SELECT * FROM maindata WHERE maindata_Ticket_By='$PaymentBy'";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                if($data['maindata_Due'] > 0 && $data['maindata_Due'] >= $PaymentAmount)
                {
                    $dataid=$data['maindata_id'];
                    $datapaid=$data['maindata_Paid']+$PaymentAmount;
                    $datadue=$data['maindata_Due']-$PaymentAmount;
                    $sqlInsert = "UPDATE maindata SET maindata_Paid='$datapaid', maindata_Due='$datadue' WHERE maindata_id='$dataid'";
                    $conn->exec($sqlInsert);
                    //echo $sqlInsert;
                }
                else if($data['maindata_Due'] > 0 && $data['maindata_Due'] <= $PaymentAmount)
                {
                    $dataid=$data['maindata_id'];
                    $datapaid=$data['maindata_Paid']+$data['maindata_Due'];
                    $datadue=0;
                    $PaymentAmount=$PaymentAmount-$data['maindata_Due'];
                    $sqlInsert = "UPDATE maindata SET maindata_Paid='$datapaid', maindata_Due='$datadue' WHERE maindata_id='$dataid'";
                    $conn->exec($sqlInsert);
                    //echo $sqlInsert;
                }

            }

        }
        else
        {
            echo '<script type="text/javascript">alert("Error User Type !");</script>';
            return;
        }
        if($sqlInsert){

        }else{
            echo '<script type="text/javascript">alert("Error , While Updating Amount !");</script>';
            die();
        }
        try{

            //isset for int numbers they can be 0
            //!empty values can't be 0
            if(!empty($PaymentPhoneNo) && !empty($PaymentBy) && isset($PaymentAmount) && isset($PaymentDate)){
                $sqlInsert = "INSERT INTO payment (payment_id, payment_PhoneNo,payment_By, payment_Amount, 
            payment_Date, payment_Input_Time)
                VALUES (0, '$PaymentPhoneNo', '$PaymentBy', '$PaymentAmount', '$PaymentDate', '$input_Time')";
                $conn->exec($sqlInsert);
            }


        }catch (PDOException $e){
            echo "Error while inserting ".$e->getMessage();
        }
        //cek is the row was inserted or not
        if($sqlInsert){

            //success inserted
            echo '<script type="text/javascript">alert("Successfully Inserted !!!");</script>';
            //echo $sqlInsert;
           echo '<script type="text/javascript"> window.open("../pages/dashboard.php","_self");</script>';
            die();
        }else{
            echo '<script type="text/javascript">alert("Error , Try Again!!!");</script>';
            //echo '<script type="text/javascript"> window.open("../pages/dashboard.php","_self");</script>';
            die();
        }
    }

}
if(isset($_SESSION['loggedIn']))   // it checks whether the user clicked login button or not
{
    $insert = new InsertDetails();
    $insert->startInsertDetails();
}
else
{
    echo '<script type="text/javascript">alert("Bad Request !!!");</script>';
    echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';
    die();
}