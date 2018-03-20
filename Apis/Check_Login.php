<?php
session_start();
// include db connect class
require_once __DIR__ . '/Connection.php';
class InsertDetails{
    function startInsertDetails(){
        $connection = new Connection();
        $conn = $connection->getConnection();
        //array for json response
        $response = array();
        $Email   = $_POST['email'];
        $Password   = $_POST['password'];

        try{

            if(!empty($Email) && !empty($Password))
            {
                $sqlQuery = "SELECT * FROM user WHERE Email='$Email' AND Password='$Password'";
                $getJson = $conn->prepare($sqlQuery);
                $getJson->execute();
                $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
                if(count($result) > 0) {
                    foreach($result as $data)
                    {
                        $_SESSION['id']=$data['id'];
                        $_SESSION['Name']=$data['Name'];
                        $_SESSION['PhoneNo']=$data['PhoneNo'];
                        $_SESSION['Email']=$data['Email'];
                    }
                    $_SESSION['loggedIn']=true;
                    echo '<script type="text/javascript"> window.open("../pages/dashboard.php","_self");</script>';            //  On Successful Login redirects to home.php
                    die();
                }
                else{
                    echo '<script type="text/javascript">alert("Authentication Error !!!");</script>';
                    echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';
                    die();
                }
            }
            else{
                echo '<script type="text/javascript">alert("Please Fill Email And Password...");</script>';
                echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';
                die();
            }

        }catch (PDOException $e){
            echo '<script type="text/javascript">alert("Error Try Again !!!");</script>';
            echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';
            die();
        }
    }
}
if(isset($_POST['login']))   // it checks whether the user clicked login button or not
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