<?php
// receive from and to email
// select from message where foremail=$foremail and toemail=$toemail

function getUser()
{

    $hostName = "localhost";
    $userName = "root";
    $pass = "";
    $dbName = "rijudb_chat";


    // mysqli-connect() is connecting to the sql database with the following arguments
    $con = mysqli_connect($hostName, $userName, $pass, $dbName);

    if ($con) {

        // $user_email = $_POST['userEmail'];
        $other_email = $_POST['otherEmail'];
        

        // $target_dir = "images/";
        // $target_file = $target_dir . basename($_FILES["image"]["name"]);
        // move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        # code...
        // ID is auto added so expicitly setting (name,email,password)
        $sql = "SELECT * from registration WHERE email='$other_email'";


        // mysqli_query() sends the above insert command to database. mysqli_query() takes 2 parameters the connection variable and the query(command and data values)
        $response = mysqli_query($con, $sql);

        if (mysqli_num_rows($response) > 0) {
            # code...
            $alldata = array();
            while ($data = mysqli_fetch_assoc($response)) {

                $email = $data["email"];
                $name = $data["name"];
                $status = $data["status"];
                $picture = $data["picture"];

                $stored_time = $data["logout_time"];

                    date_default_timezone_set('Asia/Kolkata');
                    // date("Y-m-d h:i:sa");
                    $currentTime = date("Y-m-d h:i:s");

                    $datetime1 = date_create($stored_time); //db time
                    $datetime2 = date_create($currentTime); //current time

                    $interval = date_diff($datetime1, $datetime2);
                    // $new_time=$interval->format('%y years %m months %d days %h hours %i minutes %s seconds');
                    // $new_time=$interval->format('%Y years %M months %D days %H hours %i minutes %s seconds');
                    $new_time = $interval->format('%Y,%M,%D,%h,%i,%s');

                array_push($alldata, array("email" => $email, "name" => $name, "picture" => $picture, "status" => $status, "logout_time" => $new_time));
                }
            echo json_encode($alldata);
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

getUser();
