<?php
// receive from and to email
// select from message where foremail=$foremail and toemail=$toemail

function msgList()
{

    $hostName = "localhost";
    $userName = "root";
    $pass = "";
    $dbName = "rijudb_chat";


    // mysqli-connect() is connecting to the sql database with the following arguments
    $con = mysqli_connect($hostName, $userName, $pass, $dbName);

    if ($con) {

        $user_email = $_POST['userEmail'];
        $other_email = $_POST['otherEmail'];
        

        // $target_dir = "images/";
        // $target_file = $target_dir . basename($_FILES["image"]["name"]);
        // move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        # code...
        
        // Need both 
        // toEmail='$other_email' and fromEmail='$user_email'
        //  +
        // toEmail='$user_email' and fromEmail='$other_email'
        // To display both user and target's conversation

        // IN operator works like a comparison between a number of values, wrapped in (). If there's a match with any given values, the expression is TRUE.
        $sql = "SELECT * FROM messages WHERE toEmail IN ('$other_email', '$user_email') AND fromEmail IN ('$user_email','$other_email' )";


        
        $response = mysqli_query($con, $sql);

        if (mysqli_num_rows($response) > 0) {
            # code...
            $alldata = array();
            while ($data = mysqli_fetch_assoc($response)) {

                // $toEmail = $data["toEmail"];
                // $fromEmail = $data["fromEmail"];
              
                
                $tempmsg = $data["message"];


                //   $user_email = $_POST['userEmail'];

                // ***Check who's message it is***
                // Check if it's the user Email or not
                // If it is then add "usr" in front of message
                if ($data["fromEmail"]==$user_email) {

                    $msg = "usr".$tempmsg;


                // If not then add "oth" in front of message
                } else {

                     $msg = "oth".$tempmsg;

                }

                $stored_time = $data["message_Datetime"];

                // Time
                date_default_timezone_set('Asia/Kolkata');
                // date("Y-m-d h:i:sa");
                $currentTime = date("Y-m-d h:i:s");

                $datetime1 = date_create($stored_time); //db time
                $datetime2 = date_create($currentTime); //current time

                $interval = date_diff($datetime1, $datetime2);
                // $new_time=$interval->format('%y years %m months %d days %h hours %i minutes %s seconds');
                // $new_time=$interval->format('%Y years %M months %D days %H hours %i minutes %s seconds');
                $new_time = $interval->format('%Y,%M,%D,%h,%i,%s');

                array_push($alldata, array("message" => $msg, "msgTime" => $new_time));
            }
            echo json_encode($alldata);
            mysqli_close($con);
        }
        else{
            echo json_encode("empty");
        }

        
    }
    else {
            echo "Not connected";
        }
}

msgList();
