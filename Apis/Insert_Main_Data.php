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
        $Name   = $_POST['Name'];
        $Cell_No   = $_POST['Cell_No'];
        $Fare   = $_POST['Fare'];
        $Paid  = $_POST['Paid'];
        $Due  = $_POST['Due'];
        $Commission  = $_POST['Commission'];
        //getting user email via login session just to tract who is inserting data or updating data
        $Entry_By  =  $_SESSION['id'];
        $Ticket_By  = $_POST['Ticket_By'];
        $Comment  = $_POST['Comment'];
        $Point  = $_POST['Point'];
        $Date  = $_POST['Date'];
        $Flown_Date  = $_POST['Flown_Date'];
        $Pnr  = $_POST['Pnr'];
        $Pax  = $_POST['Pax'];
        $Route  = $_POST['Route'];
        $Airlines  = $_POST['Airlines'];
        try{
            /*
            echo $Name." 2-".$Cell_No." 3-".$Fare." 4-".$Paid." 5-".$Due." 6-".$Commission." 7-".$Ticket_By
                  ." 8-".$Comment." 9-".$Point." 10-"
                  .$Date." 11-".$Flown_Date." 12-".$Pnr." 13-".
                  $Pax." 14-".$Route." 15-".$Airlines;

            echo !empty($Name) . !empty($Cell_No) .!empty($Fare) . !empty($Paid) . !empty($Due). !empty($Commission). !empty($Ticket_By).
                  !empty($Comment). !empty($Point).!empty($Date). !empty($Flown_Date). !empty($Pnr). !empty($Pax). !empty($Route). !empty($Airlines);
              */
            //isset for int numbers they can be 0
            //!empty values can't be 0
            if(!empty($Name) && !empty($Cell_No) && isset($Fare) && isset($Paid) && isset($Due)&& isset($Commission)&& !empty($Ticket_By)&&
                !empty($Comment)&& isset($Point)&& !empty($Date)&& !empty($Flown_Date)&& !empty($Pnr)&& !empty($Pax)&& !empty($Route)&& !empty($Airlines)){

                $sqlInsert = "INSERT INTO maindata (input_id, Name, Cell_No, Fare, Paid, Due, Commission, Entry_By, Ticket_By, Comment,
                Point, Date, Flown_Date, Pnr, Pax, Route, Airlines) VALUES (0, '$Name', '$Cell_No', '$Fare', '$Paid', '$Due', '$Commission'
                , '$Entry_By', '$Ticket_By', '$Comment', '$Point', '$Date', '$Flown_Date', '$Pnr', '$Pax', '$Route', '$Airlines')";
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
            echo '<script type="text/javascript"> window.open("../pages/main.php","_self");</script>';
            die();
        }
    }
}
if(isset($_POST['insert_main_data']) && isset($_SESSION['loggedIn']))   // it checks whether the user clicked login button or not
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