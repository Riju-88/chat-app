<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';



function register()
{

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


    // mysqli-connect() is connecting to the sql database with the following arguments
    $con = mysqli_connect($hostName, $userName, $pass, $dbName);

    if ($con) {


        if ($_POST['button'] == "otp") {
            $email = $_POST['email'];

            $otp = rand(100000, 999999);

            // session
            // session_start();
            // $_SESSION['otp'] = $otp;
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings

                //   $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
                //Enable verbose debug output

                $mail->isSMTP();
                //Send using SMTP

                $mail->Host       = 'smtp.gmail.com';
                //Set the SMTP server to send through

                $mail->SMTPAuth   = true;
                //Enable SMTP authentication

                $mail->Username   = 'undefinedvoid404@gmail.com';
                //SMTP username
                $mail->Password   = 'tkzvvdsvzshvdzvx';
                //SMTP password

                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                //Enable implicit TLS encryption

                $mail->Port       = 465;
                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


                //Recipients
                $mail->setFrom('undefinedvoid404@gmail.com', 'Chat-app Admin');
                $mail->addAddress($email, "user");
                //Add a recipient

                //  $mail->addAddress('ellen@example.com');               
                //Name is optional

                $mail->addReplyTo('undefinedvoid404@gmail.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                //   $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);
                //Set email format to HTML
                $mail->Subject = 'Chat-app OTP';
                $mail->Body    = "Here's your OTP to register on chat-app: <b>{$otp}</b>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo json_encode(array("msg" => 'success', "otp" => $otp));
                mysqli_close($con);
            } catch (Exception $e) {
                echo json_encode("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                mysqli_close($con);
            }
        } else if ($_POST['button'] == "register") {
            // $id = $_POST['id'];
            $email = $_POST['email'];
            $name = $_POST['name'];

            $password = $_POST['password'];



            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            # code...
            // ID is auto added so expicitly setting (name,email,password)
            $sql = "insert into registration (email,name,password,picture) values('$email','$name','$password','$target_file')";


            // mysqli_query() sends the above insert command to database. mysqli_query() takes 2 parameters the connection variable and the query(command and data values)
            $response = mysqli_query($con, $sql);

            if ($response == 1) {
                echo "Registered Successfully!";
                mysqli_close($con);
            } else {
                echo "Couldn't Register";
                mysqli_close($con);
            }
        } else if ($_POST['button'] == "login") {

            $email = $_POST['email'];
            // $name = $_POST['name'];

            $password = $_POST['password'];

            $sql = "SELECT * from registration WHERE email='$email' and password='$password'";


            // mysqli_query() sends the above insert command to database. mysqli_query() takes 2 parameters the connection variable and the query(command and data values)
            $response = mysqli_query($con, $sql);


            if (mysqli_num_rows($response) > 0) {
                //cookie
                // $cookie_name = "userid";
                // $cookie_value = $data->id;
                // setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                // $cookie_name = "password";
                // $cookie_value = $data->password;
                // setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

                // updating status
                $sqlStatus = "UPDATE registration SET status='1'
            WHERE email='$email'";

                $newresponse = mysqli_query($con, $sqlStatus);

                // Setting session and getting status
                if ($newresponse == 1) {



                    //session
                    session_start();

                    $_SESSION['email'] = $email;

                    $_SESSION['password'] = $password;

                    // Getting status and name
                    $sqlGet = "SELECT name,status,picture FROM registration
            WHERE email='$email'";

                    $responseGet = mysqli_query($con, $sqlGet);


                    while ($data = mysqli_fetch_assoc($responseGet)) {
                        $_SESSION['name'] = $data["name"];
                        $_SESSION['status'] = $data["status"];
                        $_SESSION['image'] = $data["picture"];
                        // $_SESSION['img'] = $data["picture"];
                    }
                    // 

                    // header(('location:index.php'));
                    echo "success";
                    mysqli_close($con);
                }
            } else {
                echo "Invalid email or password";
                mysqli_close($con);
            }

            return "Login";
        } else if ($_POST['button'] == "forgotPass") {
            $email = $_POST['email'];
            $sql = "SELECT name,password from registration WHERE email='$email'";

            $response = mysqli_query($con, $sql);


            // If data is inserted successfully then $response will return 1(cause we added 1 row of data)
            $records = mysqli_num_rows($response);
            if ($records > 0) {
                # code...


                // The fetch_assoc() / mysqli_fetch_assoc() function fetches a result row as an associative array.
                while ($data = mysqli_fetch_assoc($response)) {

                    // $email = $data["email"];
                    $name = $data["name"];
                    $password = $data["password"];

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings

                        //   $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
                        //Enable verbose debug output

                        $mail->isSMTP();
                        //Send using SMTP

                        $mail->Host       = 'smtp.gmail.com';
                        //Set the SMTP server to send through

                        $mail->SMTPAuth   = true;
                        //Enable SMTP authentication

                        $mail->Username   = 'undefinedvoid404@gmail.com';
                        //SMTP username
                        $mail->Password   = 'tkzvvdsvzshvdzvx';
                        //SMTP password

                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        //Enable implicit TLS encryption

                        $mail->Port       = 465;
                        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


                        //Recipients
                        $mail->setFrom('undefinedvoid404@gmail.com', 'Chat-app Admin');
                        $mail->addAddress($email, $name);
                        //Add a recipient

                        //  $mail->addAddress('ellen@example.com');               
                        //Name is optional

                        $mail->addReplyTo('undefinedvoid404@gmail.com', 'Information');
                        // $mail->addCC('cc@example.com');
                        // $mail->addBCC('bcc@example.com');

                        //Attachments
                        //   $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                        //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                        //Content
                        $mail->isHTML(true);
                        //Set email format to HTML
                        $mail->Subject = 'Forgot Password';
                        $mail->Body    = "Hi {$name}. Here's your requested chat-app password: <b>{$password}</b>";
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        $mail->send();
                        echo 'success';
                        mysqli_close($con);
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        mysqli_close($con);
                    }
                }
            } else {
                echo "Couldn't find the email address inside DataBase";
            }
        } else if ($_POST['button'] == "chatList") {

            // $sql = "SELECT email,name,password,picture,status,logout_time FROM registration";
            $sql = "SELECT * FROM registration";



            // mysqli_query() sends the above insert command to database. mysqli_query() takes 2 parameters the connection variable and the query(command and data values)
            $response = mysqli_query($con, $sql);


            // If data is inserted successfully then $response will return 1(cause we added 1 row of data)
            $records = mysqli_num_rows($response);
            if ($records > 0) {
                # code...
                $alldata = array();

                // The fetch_assoc() / mysqli_fetch_assoc() function fetches a result row as an associative array.
                while ($data = mysqli_fetch_assoc($response)) {

                    // attempt to update user pass on chat list load
                    //  if email is set(then it's user email)
                    // if (isset($_SESSION["email"])) {
                    //     // if session email matches user email from data
                    //     if ($_SESSION["email"]==$data["email"]) {
                    //         // start session and set password
                    //         session_start();
                    //         $_SESSION["password"]=$data["password"];
                    //     }
                    // }

                    $email = $data["email"];
                    $name = $data["name"];
                    $pass = $data["password"];
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

                    array_push($alldata, array("email" => $email, "name" => $name, "pass" => $pass, "picture" => $picture, "status" => $status, "logout_time" => $new_time));
                }
                echo json_encode($alldata);
                mysqli_close($con);
            }
        } elseif ($_POST['button'] == "updateName") {
            # code...
            $email = $_POST['email'];
            $name = $_POST['name_dlg_temp'];


            # code...
            // ID is auto added so expicitly setting (name,email,password)
            $sql = "UPDATE registration SET name='$name'
             WHERE email='$email'";


            // mysqli_query() sends the above insert command to database. mysqli_query() takes 2 parameters the connection variable and the query(command and data values)
            $response = mysqli_query($con, $sql);

            if ($response == 1) {
                session_start();

                $_SESSION['email'] = $email;
                $_SESSION['name'] = $name;


                echo "success";
                mysqli_close($con);
            } else {
                echo "Couldn't Update";
                mysqli_close($con);
            }
        } elseif ($_POST['button'] == "updatePass") {
            # code...
            $email = $_POST['email'];

            $password = $_POST['pass_dlg_temp'];




            # code...
            // ID is auto added so expicitly setting (name,email,password)
            $sql = "UPDATE registration SET password='$password'
             WHERE email='$email'";


            // mysqli_query() sends the above insert command to database. mysqli_query() takes 2 parameters the connection variable and the query(command and data values)
            $response = mysqli_query($con, $sql);

            if ($response == 1) {

                // session_start();

                // $_SESSION['email'] = $email;

                // $_SESSION['password'] = $password;
                echo "success";

                session_start();
                session_unset();
                session_destroy();
                mysqli_close($con);
            } else {
                echo "Couldn't Update";
                mysqli_close($con);
            }
        } elseif ($_POST['button'] == "updateImg") {
            # code...
            $email = $_POST['email'];



            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            # code...
            // ID is auto added so expicitly setting (name,email,password)
            $sql = "UPDATE registration SET picture='$target_file' 
            WHERE email='$email'";


            // mysqli_query() sends the above insert command to database. mysqli_query() takes 2 parameters the connection variable and the query(command and data values)
            $response = mysqli_query($con, $sql);

            if ($response == 1) {
                $sqlGet = "SELECT picture FROM registration
                WHERE email='$email'";

                $responseGet = mysqli_query($con, $sqlGet);


                while ($data = mysqli_fetch_assoc($responseGet)) {
                    session_start();
                    $_SESSION['image'] = $data["picture"];
                    // $_SESSION['img'] = $data["picture"];
                }

                // $_SESSION['image'] = $email;
                echo "success";
                mysqli_close($con);
            } else {
                echo "Couldn't Update";
                mysqli_close($con);
            }
        }  else if ($_POST['button'] == "logout") {
            $mail = $_POST['email'];
            date_default_timezone_set('Asia/Kolkata');
            // date("Y-m-d h:i:sa");
            $ltime = date("Y-m-d h:i:s");

            $sqlStatus = "UPDATE registration SET status='0', logout_time= '$ltime'
            WHERE email='$mail'";

            $newresponse = mysqli_query($con, $sqlStatus);

            if ($newresponse == 1) {

                session_start();
                session_unset();
                session_destroy();

                echo "logged out";
                mysqli_close($con);
            }
        }
    } else {
        echo "Not connected";
    }
}

register();
