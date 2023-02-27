<?php

// 000webhost
// $hostName = "localhost";
// $userName = "id19975557_riju";
// // random pass
// $pass = "8U8Wcp!0MG$51v*M";
// $dbName = "id19975557_rijudb";

// profreehost
// $hostName = "sql203.unaux.com";
// $userName = "unaux_33157414";
// // random pass
// $pass = "ezxtivyhe";
// $dbName = "unaux_33157414_rijudb_chat";

$hostName = "localhost";
$userName = "root";
$pass = "";
$dbName = "rijudb_chat";



$con = mysqli_connect($hostName, $userName, $pass, $dbName);

if ($con) {


//    Made separate file since there are some interfering with process.php
// Compares the session password with DataBase password on every click
// Will return "invalid" upon mismatch and then js will initiate logout
    if ($_POST['button'] == "checkPass") {
        $mail = $_POST['email'];
        $pass = $_POST['pass'];
        $sql = "SELECT password from registration WHERE email='$mail'";

        $response = mysqli_query($con, $sql);

        $records = mysqli_num_rows($response);
         $arr=[];
        if ($records > 0) {
            # code...
           
           
           
            while ($data = mysqli_fetch_assoc($response)) {



                $dbPass = $data["password"];
                $arr[0]=$dbPass;
            }
            if ($arr[0] != $pass) {
                echo "invalid";
                // session_start();
                // session_unset();
                // session_destroy();
            }
            else {
                echo "No change detected";
            }
        
        }
      
    }
    if ($_POST['button'] == "checkLogin") {
        $email = $_POST['email'];
           

            // check status
                $sqlStatus = "SELECT status FROM registration WHERE email='$email'";
           $statusArr=[];
            $response = mysqli_query($con, $sqlStatus);


            if (mysqli_num_rows($response) > 0) {
            
              
                while ($data = mysqli_fetch_assoc($response)) {



                    $statusArr[0] = $data["status"];
                    
                }
                // updating status
                if ($statusArr[0]=='0') {
                     $updateStatus = "UPDATE registration SET status='1'
            WHERE email='$email'";

                $newResponse = mysqli_query($con, $updateStatus);

                if ($newResponse==1) {
                   echo "updated";
                }
                   
                }
               
               
            }
      
    }
} else {
    echo "Not connected";
}
