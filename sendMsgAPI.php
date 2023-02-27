<?php

function sendMsg(){


    $hostName = "localhost";
    $userName = "root";
    $pass = "";
    $dbName = "rijudb_chat";


    // mysqli-connect() is connecting to the sql database with the following arguments
    $con = mysqli_connect($hostName, $userName, $pass, $dbName);

    if ($con) {

        $user_email = $_POST['userEmail'];
        $target_email = $_POST['targetEmail'];
        $msg = $_POST['msg'];
        date_default_timezone_set('Asia/Kolkata');
            // date("Y-m-d h:i:sa");
            $sentTime = date("Y-m-d h:i:s");
        

        // $target_dir = "images/";
        // $target_file = $target_dir . basename($_FILES["image"]["name"]);
        // move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        # code...
        // ID is auto added so expicitly setting (name,email,password)
        $sql = "insert into messages (fromEmail,toEmail,message,message_Datetime) values('$user_email','$target_email','$msg','$sentTime')";


        // mysqli_query() sends the above insert command to database. mysqli_query() takes 2 parameters the connection variable and the query(command and data values)
        $response = mysqli_query($con, $sql);

        if ($response == 1) {
            # code...
           
            echo "sent";
            mysqli_close($con);
        }
        else{
            echo "Something went wrong";
        }

        
    }
    else {
            echo "Not connected";
        }
}

sendMsg();
?>