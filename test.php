<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        if (name_dlg_temp.value != "") {
            if (/[^\w\d]/g.test(name_dlg_temp.value)) {
                console.log("Name can only contain letters and numbers" + name_dlg_temp.value);
                // res.innerHTML = "Name can only contain letters and numbers";
            } else {

            }
        }
    </script>
    <?php

    if ($_POST['button'] == "chatList") {
        $sql = "SELECT * FROM registration";
$response = mysqli_query($con, $sql);
$records = mysqli_num_rows($response);
if ($records > 0) {
    $alldata = array();
    foreach (mysqli_fetch_assoc($response) as $data) {
        $email = $data["email"];
        $name = $data["name"];
        $pass = $data["password"];
        array_push($alldata, array("email" => $email, "name" => $name, "pass" => $pass));
    }
    echo json_encode($alldata);
}

    }
    ?>
</body>

</html>