<?php
session_start();

if (!isset($_SESSION['email'])) {
    header(('location:login.php'));
} else {
    // echo $_SESSION['name'];
    // echo $_SESSION['email'];
    // echo $_SESSION['status'];
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- FEATURES -->
<!-- Can check for empty fields during registration -->
<!-- Can check for symbols in name field -->
<!-- Will prevent duplicate email during registration -->
<!-- putting single quotes in password or in messages won't cause error -->
<!-- Can send OTP to the provided email address -->
<!-- Can send password to the provided email address(forgot password)-->
<!-- Can edit/update user profile -->
<!-- Can refresh chatlist on every click -->
<!-- auto login if user didn't logout during last session -->
<!-- added scrolling in chat list and chat history -->
<!-- On Password change other devices will logout on any activity -->

<!-- CAN DO REAL TIME CHAT WITH OTHER USERS -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">

    <style>
        #nav {
            display: flex;
            flex: 1;
            background-color: rgb(35%, 60%, 90%);
        }

        #nav .nav-item {
            padding: 0.8rem 0.5rem;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .nav-item>button {
            background-color: rgba(0, 0, 0, 0);
            color: white;
            border: none;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .nav-item a {
            text-decoration: none;
            cursor: pointer;
            /* background-color: white; */
            color: white;

            width: 100%;
            height: 100%;
        }

        .nav-item:hover {
            background-color: #3355aa;
            color: #0000ff;
        }

        .nav-item a:hover {

            color: #efef00;
        }

        .nav-item>button:hover {

            color: #efef00;
            cursor: pointer;
        }



        #main-user {
            border: 2px solid #2291ff;
            background-color: #d3ecff;
        }

        .chat {
            width: auto;
            padding: 0;
        }

        #chat-list {
            padding: 1rem;
            height: 100vh;
            overflow-y: scroll;
        }

        #chat-list li {
            margin: 0.5rem auto;
        }

        .chat-list-name {
            width: fit-content;
        }

        #plist {
            padding: 0;

        }

        #send {
            background-color: #2279e4;
            color: #ffffff;
            font-size: 1.05rem;
            border-radius: 100vmax;
            padding: 0.5em 1em;
            margin: 1rem;
            cursor: pointer;

        }

        #send:hover {
            background-color: #004599;
            transition: all 0.3s;
        }

        .chat {
            background-color: #d3d4d4;
        }

        .clearfix img {
            width: 100%;
            aspect-ratio: 1 / 1;
        }

        /* .chat-history{
             
        } */

        /* .chat-history .m-b-0{
            flex: 1 1 auto;
        } */
        .chat-message {
            padding: 1rem;
            /* position: fixed; */
            /* border: 2px solid black; */
            /* width: 70%; */
            /* margin-top: 20% ; */
            /* display: flex; */
        }

        .chat-history {
            height: 100vh;
            overflow-y: scroll;
        }

        #msg_box {
            padding: 1rem;
            width: calc(100% - 2rem);
            border-radius: 8px;
        }

        .pic-cont {
            height: 5rem;
            /* margin: auto; */
            text-align: center;
            width: 100%;
            /* aspect-ratio: 1 / 1; */
        }

        .pic-cont img {
            height: 100%;
            /* margin: auto; */
            /* width: 100%; */
        }

        dialog {
            border: 1px solid #ffffff;
            border-radius: 1rem;
        }

        dialog::backdrop {
            background-color: rgba(44, 44, 44, 0.89);
        }

        /* button container inside dialog */
        .dlg_button {
            width: 100%;
            /* min-height: 1rem; */
            /* padding: auto; */
            text-align: center;
            /* margin: auto; */
        }

        button {
            background-color: #2291ff;
            color: white;
            border: none;
            padding: 0.2rem 0.5rem;
            cursor: pointer;
            border-radius: 0.3rem;
            padding: 0.5rem 1rem;
        }

        button:hover {
            background-color: #055db4;
        }

        /* edit button in profile dialog */
        #editImg_dlg {
            margin: 0.5rem auto;

            padding: 0.3rem 1rem;
        }

        /* close button in dialog */
        .closeDLG {
            padding: 0.5rem 1rem;
            /* border-radius: 0.4rem; */
            /* display: block; */
            margin: 1rem auto;

        }

        .hide {
            display: none;
        }
    </style>
</head>

<body>
    <input type="hidden" id="hiddenEmail" value=<?php echo $_SESSION['email']; ?>>

    <input type="hidden" id="hiddenName" value="<?php echo $_SESSION['name']; ?>">

    <input type="hidden" id="hiddenImg" value='<?php echo $_SESSION['image']; ?>'>
    <input type="hidden" id="hiddenFetchPass" value="">
    <input type="hidden" id="hiddenPass" value="<?php echo $_SESSION['password']; ?>">

    <input type="hidden" id="hiddenTargetEmail" value="">
    <input type="hidden" id="hiddenTargetImg" value="">

    <!-- profile dialog -->
    <dialog id="profile_dlg">

        <div>
            <!-- <label for="img_dlg">Profile Image:</label> -->
            <div class="pic-cont">
                <img src="" alt="profile_pic" id="img_dlg">
            </div>

            <div class="dlg_button">
                <button id="editImg_dlg">Edit</button>
            </div>
        </div>
        <div>
            <label for="name_dlg">Name:</label>
            <input type="text" name="name_dlg" id="name_dlg" readonly>
            <button id="editName_dlg">Edit</button>
        </div>

        <div>
            <label for="email_dlg">Email:</label>
            <input type="email" name="email_dlg" id="email_dlg" readonly>
        </div>


        <div><label for="pass_dlg">Password:</label>
            <input type="password" name="pass_dlg" id="pass_dlg" readonly>
            <button id="editPass_dlg">Edit</button>
        </div>

        <div class="dlg_button">
            <button id="ok_dlg" class="closeDLG">Close</button>

        </div>
    </dialog>

    <!-- update name dialog -->
    <dialog id="updNameDlg">
        <form id="updateNameForm">
            <div>
                <p>* Name must not be empty</p>
                <p>* Name must not contain symbols</p>
                <label for="name_dlg_temp">Name:</label>
                <input type="text" name="name_dlg_temp" id="name_dlg_temp">

            </div>
        </form>
        <div class="dlg_button">
            <button id="cancelName_dlg" class="closeDLG">Close</button>
            <button id="updateName_dlg">Update</button>
        </div>
    </dialog>

    <!-- update password dialog -->
    <dialog id="updPassDlg">
        <form id="updatePassForm">
            <div>
            <p>* Password must be 8 characters or more</p>
                <p>* Password must contain symbols,upper and lowercase letters,numbers</p>
                <label for="pass_dlg_temp">Password:</label>
                <input type="password" name="pass_dlg_temp" id="pass_dlg_temp">

            </div>
        </form>
        <div class="dlg_button">
            <button id="cancelPass_dlg" class="closeDLG">Close</button>
            <button id="updatePass_dlg">Update</button>
        </div>
    </dialog>

    <!-- update profile pic dialog -->
    <dialog id="updImgDlg">
        <form id="updateImgForm">
            <div>
                <label for="img_dlg_temp"><img src="" alt="profile_pic"></label>
                <input type="file" name="img_dlg_temp" id="img_dlg_temp">

            </div>
        </form>
        <div class="dlg_button">
            <button id="cancelImg_dlg" class="closeDLG">Close</button>
            <button id="updateImg_dlg">Update</button>
        </div>
    </dialog>

    <nav id="nav">
        <div class="nav-item"><a href="index.php">Home</a></div>

        <div class="nav-item"><button id="logout">Logout</button></div>
    </nav>


    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search..." id="search">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0" id="chat-list">
                            <!-- <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Vincent Porter</div>
                                    <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>
                                </div>
                            </li>
                            <li class="clearfix active">
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Aiden Chavez</div>
                                    <div class="status"> <i class="fa fa-circle online"></i> online </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Mike Thomas</div>
                                    <div class="status"> <i class="fa fa-circle online"></i> online </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Christian Kelly</div>
                                    <div class="status"> <i class="fa fa-circle offline"></i> left 10 hours ago </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Monica Ward</div>
                                    <div class="status"> <i class="fa fa-circle online"></i> online </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Dean Henry</div>
                                    <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix" id="chat_header">
                            <!-- <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0">Aiden Chavez</h6>
                                        <small>Last seen: 2 hours ago</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-sm text-right">
                                    <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                                </div>
                            </div> -->
                        </div>
                        <div class="chat-history">
                            <!-- chat ul -->
                            <ul class="m-b-0" id="chat_ul">
                                <!-- <li class="clearfix">
                                    <div class="message-data text-right">
                                        <span class="message-data-time">10:10 AM, Today</span>
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                    </div>
                                    <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                                </li>
                                <li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">10:12 AM, Today</span>
                                    </div>
                                    <div class="message my-message">Are we meeting today?</div>
                                </li>
                                <li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">10:15 AM, Today</span>
                                    </div>
                                    <div class="message my-message">Project has been already finished and I have results to show you.</div>
                                </li> -->
                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-send"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Enter text here..." id="msg_box">
                            </div>
                            <button id="send">Send <i class="fa fa-send"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 
        // WebSocket(Ratchet)
        // 
        let conn = new WebSocket(`ws://${location.host}:8080`);
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);
            // const chat_ul = document.querySelector("#chat_ul");
            // chat_ul.innerHTML = `<li class="clearfix">
            //                         <div class="message-data text-right">
            //                             <span class="message-data-time">



            //                             </span>
            //                             <img src="${document.querySelector("#hiddenTargetImg").value}">
            //                         </div>
            //                         <div class="message other-message float-right">${e.data} </div>
            //                     </li>`


            const newForm = new FormData();
            newForm.append("otherEmail", document.querySelector("#hiddenTargetEmail").value);
            newForm.append("userEmail", document.querySelector("#hiddenEmail").value);

            fetch("getMsgAPI.php", {
                    method: "post",
                    body: newForm
                })
                .then(data => data.json()).then(response => {
                    // output.innerHTML = response;
                    console.log(response);
                    const chat_ul = document.querySelector("#chat_ul");

                    if (response != "empty") {
                        const mapped = response.map(obj => {
                            console.log(obj.message.substring(0, 3), obj.message.substring(3));
                            let msgr = obj.message.substring(0, 3);
                            let msg = obj.message.substring(3);

                            // If the msg send by user 
                            if (msgr == "usr") {
                                return `<li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">
                                        ${
                                            // if year is not 00 print year and months
                                            obj.msgTime.split(",")[0]!="00"?obj.msgTime.split(",")[0]+" years "+obj.msgTime.split(",")[1]+" months "
                                            // else if month is not 00 print month and days
                                        :obj.msgTime.split(",")[1]!="00"?obj.msgTime.split(",")[1]+" months "+obj.msgTime.split(",")[2]+" days "
                                        // else if day is not 00 print day and hrs
                                        :obj.msgTime.split(",")[2]!="00"?
                                        obj.msgTime.split(",")[2]+" days "+obj.msgTime.split(",")[3]+" hrs "
                                        // else if hour is not 0 print hr and mins
                                        :obj.msgTime.split(",")[3]!="0"?
                                        obj.msgTime.split(",")[3]+" hrs "+obj.msgTime.split(",")[4]+" mins "
                                        // else print mins and sec
                                        :obj.msgTime.split(",")[4]+" mins "+obj.msgTime.split(",")[5]+" sec " }
                                        ago
                                        </span>
                                    </div>
                                    <div class="message my-message">${msg}</div>
                                </li>`
                            }
                            // If user received the msg
                            else {
                                return `<li class="clearfix">
                                    <div class="message-data text-right">
                                        <span class="message-data-time">

                                        ${
                                            // if year is not 00 print year and months
                                            obj.msgTime.split(",")[0]!="00"?obj.msgTime.split(",")[0]+" years "+obj.msgTime.split(",")[1]+" months "
                                            // else if month is not 00 print month and days
                                        :obj.msgTime.split(",")[1]!="00"?obj.msgTime.split(",")[1]+" months "+obj.msgTime.split(",")[2]+" days "
                                        // else if day is not 00 print day and hrs
                                        :obj.msgTime.split(",")[2]!="00"?
                                        obj.msgTime.split(",")[2]+" days "+obj.msgTime.split(",")[3]+" hrs "
                                        // else if hour is not 0 print hr and mins
                                        :obj.msgTime.split(",")[3]!="0"?
                                        obj.msgTime.split(",")[3]+" hrs "+obj.msgTime.split(",")[4]+" mins "
                                        // else print mins and sec
                                        :obj.msgTime.split(",")[4]+" mins "+obj.msgTime.split(",")[5]+" sec " }
                                        ago

                                        </span>
                                        <img src="${document.querySelector("#hiddenTargetImg").value}">
                                    </div>
                                    <div class="message other-message float-right">${msg} </div>
                                </li>`
                            }

                        });

                        const joined = mapped.join("", ",");

                        chat_ul.innerHTML = joined;

                    }



                })
        };
        // 
        // 



        const chat_list = document.querySelector("#chat-list");
        const chat_header = document.querySelector("#chat_header");
        const send = document.querySelector("#send");
        const searchBox = document.querySelector("#search");

        // Display chat list on load
        window.addEventListener("load", () => {
            const emptyForm = new FormData();
            emptyForm.append("button", "chatList");

            fetch("process.php", {
                method: "post",
                body: emptyForm
            }).then(data => data.json()).then(data => {

                // console.log(data[0].logout_time);

                let mapped = data.map((obj) => {


                    // console.log(obj.logout_time.split(","));
                    return `<li class="clearfix" ${obj.name==document.querySelector("#hiddenName").value?'id="main-user"':""} value=${obj.email}>

                 

                                <img src="${obj.picture}" alt="avatar" value=${obj.email}>
                                <div class="about" value=${obj.email}>
                                    <div class="name chat-list-name">${obj.name}</div>
                                    <div class="status" value=${obj.email}> <i class="fa fa-circle ${obj.status=="1"?"online":"offline"}" value=${obj.email}></i> 
                                     ${
                                        obj.status=="0"? 
                                        `left
                                        <!-- -->
                                        ${
                                            // if year is not 00 print year and months
                                            obj.logout_time.split(",")[0]!="00"?obj.logout_time.split(",")[0]+" years "+obj.logout_time.split(",")[1]+" months "
                                            // else if month is not 00 print month and days
                                        :obj.logout_time.split(",")[1]!="00"?obj.logout_time.split(",")[1]+" months "+obj.logout_time.split(",")[2]+" days "
                                        // else if day is not 00 print day and hrs
                                        :obj.logout_time.split(",")[2]!="00"?
                                        obj.logout_time.split(",")[2]+" days "+obj.logout_time.split(",")[3]+" hrs "
                                        // else if hour is not 0 print hr and mins
                                        :obj.logout_time.split(",")[3]!="0"?
                                        obj.logout_time.split(",")[3]+" hrs "+obj.logout_time.split(",")[4]+" mins "
                                        // else print mins and sec
                                        :obj.logout_time.split(",")[4]+" mins "+obj.logout_time.split(",")[5]+" sec " }
                                       
                                        
                                        ago`:""
                                }
                                         </div>
                                </div>
                            </li>`
                });
                const joined = mapped.join("", ",");
                chat_list.innerHTML = joined;


            })
        });



        // window.click event to update chat list
        window.addEventListener("click", () => {
            const emptyForm = new FormData();
            emptyForm.append("button", "chatList");

            fetch("process.php", {
                method: "post",
                body: emptyForm
            }).then(data => data.json()).then(data => {

                // console.log(data[0].logout_time);

                let mapped = data.map((obj) => {


                    // console.log(obj.logout_time.split(","));
                    return `<li class="clearfix" ${obj.name==document.querySelector("#hiddenName").value?'id="main-user"':""} value=${obj.email}>

                 

                                <img src="${obj.picture}" alt="avatar" value=${obj.email}>
                                <div class="about" value=${obj.email}>
                                    <div class="name chat-list-name">${obj.name}</div>
                                    <div class="status" value=${obj.email}> <i class="fa fa-circle ${obj.status=="1"?"online":"offline"}" value=${obj.email}></i> 
                                     ${
                                        obj.status=="0"? 
                                        `left
                                        <!-- -->
                                        ${
                                            // if year is not 00 print year and months
                                            obj.logout_time.split(",")[0]!="00"?obj.logout_time.split(",")[0]+" years "+obj.logout_time.split(",")[1]+" months "
                                            // else if month is not 00 print month and days
                                        :obj.logout_time.split(",")[1]!="00"?obj.logout_time.split(",")[1]+" months "+obj.logout_time.split(",")[2]+" days "
                                        // else if day is not 00 print day and hrs
                                        :obj.logout_time.split(",")[2]!="00"?
                                        obj.logout_time.split(",")[2]+" days "+obj.logout_time.split(",")[3]+" hrs "
                                        // else if hour is not 0 print hr and mins
                                        :obj.logout_time.split(",")[3]!="0"?
                                        obj.logout_time.split(",")[3]+" hrs "+obj.logout_time.split(",")[4]+" mins "
                                        // else print mins and sec
                                        :obj.logout_time.split(",")[4]+" mins "+obj.logout_time.split(",")[5]+" sec " }
                                       
                                        
                                        ago`:""
                                }
                                         </div>
                                </div>
                            </li>`
                });
                const joined = mapped.join("", ",");
                chat_list.innerHTML = joined;


            })
        });




        // window.click event to check pass
        window.addEventListener("click", () => {
            const newForm1 = new FormData();
            newForm1.append("pass", document.querySelector("#hiddenPass").value);
            newForm1.append("email", document.querySelector("#hiddenEmail").value);
            newForm1.append("button", "checkPass");

            fetch("check.php", {
                method: "POST",
                body: newForm1
            }).then(response => response.text()).then(data => {
                // console.log(`checkPass response: ${data}`);

                // if response returns "invalid" then logout
                if (data == "invalid") {
                    window.location.href = "logout.php";
                }
            })
        })


        // window.click event to check login status
        window.addEventListener("click", () => {
            const newForm1 = new FormData();

            newForm1.append("email", document.querySelector("#hiddenEmail").value);
            newForm1.append("button", "checkLogin");

            fetch("check.php", {
                method: "POST",
                body: newForm1
            }).then(response => response.text()).then(data => {
                // console.log(`checkLogin response: ${data}`);

                // if response returns "invalid" then logout
                if (data == "updated") {
                    // window.location.reload();
                }
            })
        })




        // Event on chat list to get user and target email
        // Also display msg between target and user if exists
        chat_list.addEventListener("click", (e) => {
            // Using getAttribute to get value of div/list
            const target_email = e.target.getAttribute("value");
            const user_email = document.querySelector("#main-user").getAttribute("value");

            // console.log(user_email);
            // console.log(target_email);

            // Setting hiddenTargetEmail
            document.querySelector("#hiddenTargetEmail").value = target_email;

            if (target_email != user_email) {
                const newForm = new FormData();
                newForm.append("otherEmail", target_email);
                newForm.append("userEmail", user_email);


                // Select target user from chat list(display top of messages)
                const othEmailForm = new FormData();
                othEmailForm.append("otherEmail", target_email);
                fetch("get_UserAPI.php", {
                    method: "post",
                    body: othEmailForm
                }).then(data => data.json()).then(resp => {
                    // console.log(resp);

                    // Unknown bug about img
                    document.querySelector("#hiddenTargetImg").value = resp[0].picture;
                    const mapped = resp.map(obj => {
                        // document.querySelector("#hiddenTargetImg").value=obj.picture;
                        return `<div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src='${obj.picture}' alt="avatar" id="selected_user">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0">${obj.name}</h6>
                                        <small>
                                        <!-- -->
                                        ${
                                        obj.status=="0"? 
                                        `left

                                        ${
                                            // if year is not 00 print year and months
                                            obj.logout_time.split(",")[0]!="00"?obj.logout_time.split(",")[0]+" years "+obj.logout_time.split(",")[1]+" months "
                                            // else if month is not 00 print month and days
                                        :obj.logout_time.split(",")[1]!="00"?obj.logout_time.split(",")[1]+" months "+obj.logout_time.split(",")[2]+" days "
                                        // else if day is not 00 print day and hrs
                                        :obj.logout_time.split(",")[2]!="00"?
                                        obj.logout_time.split(",")[2]+" days "+obj.logout_time.split(",")[3]+" hrs "
                                        // else if hour is not 0 print hr and mins
                                        :obj.logout_time.split(",")[3]!="0"?
                                        obj.logout_time.split(",")[3]+" hrs "+obj.logout_time.split(",")[4]+" mins "
                                        // else print mins and sec
                                        :obj.logout_time.split(",")[4]+" mins "+obj.logout_time.split(",")[5]+" sec " }
                                       
                                        
                                        ago`:""
                                }</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-sm text-right">
                                    <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                                </div>
                            </div>`;
                    });
                    const joined = mapped.join("", ",");
                    chat_header.innerHTML = joined;
                })
                // console.log("Other");


                //By clicking on a user, get messages from db and display
                fetch("getMsgAPI.php", {
                        method: "post",
                        body: newForm
                    })
                    .then(data => data.json()).then(response => {
                        // output.innerHTML = response;
                        // console.log(response);
                        const chat_ul = document.querySelector("#chat_ul");
                        if (response != "empty") {
                            const mapped = response.map(obj => {
                                console.log(obj.message.substring(0, 3), obj.message.substring(3));
                                let msgr = obj.message.substring(0, 3);
                                let msg = obj.message.substring(3);

                                // If the msg send by user 
                                if (msgr == "usr") {
                                    return `<li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">
                                        ${
                                            // if year is not 00 print year and months
                                            obj.msgTime.split(",")[0]!="00"?obj.msgTime.split(",")[0]+" years "+obj.msgTime.split(",")[1]+" months "
                                            // else if month is not 00 print month and days
                                        :obj.msgTime.split(",")[1]!="00"?obj.msgTime.split(",")[1]+" months "+obj.msgTime.split(",")[2]+" days "
                                        // else if day is not 00 print day and hrs
                                        :obj.msgTime.split(",")[2]!="00"?
                                        obj.msgTime.split(",")[2]+" days "+obj.msgTime.split(",")[3]+" hrs "
                                        // else if hour is not 0 print hr and mins
                                        :obj.msgTime.split(",")[3]!="0"?
                                        obj.msgTime.split(",")[3]+" hrs "+obj.msgTime.split(",")[4]+" mins "
                                        // else print mins and sec
                                        :obj.msgTime.split(",")[4]+" mins "+obj.msgTime.split(",")[5]+" sec " }
                                        ago
                                        </span>
                                    </div>
                                    <div class="message my-message">${msg}</div>
                                </li>`
                                    // If user received the msg
                                } else {
                                    return `<li class="clearfix">
                                    <div class="message-data text-right">
                                        <span class="message-data-time">

                                        ${
                                            // if year is not 00 print year and months
                                            obj.msgTime.split(",")[0]!="00"?obj.msgTime.split(",")[0]+" years "+obj.msgTime.split(",")[1]+" months "
                                            // else if month is not 00 print month and days
                                        :obj.msgTime.split(",")[1]!="00"?obj.msgTime.split(",")[1]+" months "+obj.msgTime.split(",")[2]+" days "
                                        // else if day is not 00 print day and hrs
                                        :obj.msgTime.split(",")[2]!="00"?
                                        obj.msgTime.split(",")[2]+" days "+obj.msgTime.split(",")[3]+" hrs "
                                        // else if hour is not 0 print hr and mins
                                        :obj.msgTime.split(",")[3]!="0"?
                                        obj.msgTime.split(",")[3]+" hrs "+obj.msgTime.split(",")[4]+" mins "
                                        // else print mins and sec
                                        :obj.msgTime.split(",")[4]+" mins "+obj.msgTime.split(",")[5]+" sec " }
                                        ago

                                        </span>
                                        <img src='${document.querySelector("#hiddenTargetImg").value}'>
                                    </div>
                                    <div class="message other-message float-right">${msg} </div>
                                </li>`
                                }
                            });

                            const joined = mapped.join("", ",");

                            chat_ul.innerHTML = joined;
                        } else {
                            chat_ul.innerHTML = "";
                        }


                    })



            }

            // Edit profile


            if (e.target.innerHTML == document.querySelector("#hiddenName").value) {

                let dlg = document.querySelector("#profile_dlg");

                let editName_dlg = document.querySelector("#editName_dlg"); //edit button inside profile dialog
                let updNameDlg = document.querySelector("#updNameDlg"); //dialog id name
                let updateNameForm = document.querySelector("#updateNameForm"); //form name inside update dialog
                let name_dlg = document.querySelector("#name_dlg"); //input id inside profile dialog
                let name_dlg_temp = document.querySelector("#name_dlg_temp"); //input id inside update dialog
                let updateName_dlg = document.querySelector("#updateName_dlg"); // update button inside update dialog
                let cancelName_dlg = document.querySelector("#cancelName_dlg"); // cancel button inside update dialog

                let editPass_dlg = document.querySelector("#editPass_dlg");
                let updPassDlg = document.querySelector("#updPassDlg");
                let updatePassForm = document.querySelector("#updatePassForm");
                let pass_dlg = document.querySelector("#pass_dlg");
                let pass_dlg_temp = document.querySelector("#pass_dlg_temp");
                let updatePass_dlg = document.querySelector("#updatePass_dlg");
                let cancelPass_dlg = document.querySelector("#cancelPass_dlg");

                let editImg_dlg = document.querySelector("#editImg_dlg");
                let updImgDlg = document.querySelector("#updImgDlg");
                let updateImgForm = document.querySelector("#updateImgForm");
                let img_dlg = document.querySelector("#img_dlg");
                let img_dlg_temp = document.querySelector("#img_dlg_temp");
                let updateImg_dlg = document.querySelector("#updateImg_dlg");
                let cancelImg_dlg = document.querySelector("#cancelImg_dlg");

                // let updatebtn_dlg = document.querySelector("#updatebtn_dlg");
                let ok_dlg = document.querySelector("#ok_dlg");

                document.querySelector("#name_dlg").value = document.querySelector("#hiddenName").value;
                document.querySelector("#email_dlg").value = document.querySelector("#hiddenEmail").value;
                document.querySelector("#img_dlg").src = document.querySelector("#hiddenImg").value;
                document.querySelector("#pass_dlg").value = document.querySelector("#hiddenPass").value;

                // show profile dialog
                dlg.showModal();
                // close profile dialog
                ok_dlg.addEventListener("click", () => {
                    dlg.close();
                })
                // edit button opens update name dialog
                editName_dlg.addEventListener("click", () => {
                    name_dlg_temp.value = name_dlg.value;
                    updNameDlg.showModal();
                })
                // cancel button inside update name dialog closes it
                cancelName_dlg.addEventListener("click", () => {
                    updNameDlg.close();
                })
                // name update button
                updateName_dlg.addEventListener("click", () => {


                    if (name_dlg_temp.value != "") {
                        if (/^\s+|[^\w\d\s]|\s+$/g.test(name_dlg_temp.value)) {
                            console.log("Name can only contain letters and numbers" + name_dlg_temp.value);
                            // res.innerHTML = "Name can only contain letters and numbers";
                        } else {


                            const nameForm = new FormData(updateNameForm);
                            nameForm.append('button', 'updateName');
                            nameForm.append('name_dlg_temp',name_dlg_temp.value);
                            nameForm.append('email', document.querySelector("#hiddenEmail").value);
                            fetch("process.php", {
                                method: "POST",
                                body: nameForm
                            }).then(raw => raw.text()).then(data => {
                                console.log(data);
                                if (data == "success") {

                                    console.log(data);
                                    updNameDlg.close();
                                    window.location.reload();
                                }
                            })



                        }
                    }



                })
                // edit button opens update pass dialog
                editPass_dlg.addEventListener("click", () => {
                    pass_dlg_temp.value = pass_dlg.value;
                    updPassDlg.showModal();
                })
                // cancel button inside update pass dialog closes it
                cancelPass_dlg.addEventListener("click", () => {
                    updPassDlg.close();
                })
                // pass update button
                updatePass_dlg.addEventListener("click", () => {



                    // const passForm = new FormData(updatePassForm);
                    // passForm.append('button', 'updatePass');
                    // passForm.append('email', document.querySelector("#hiddenEmail").value);
                    // fetch("process.php", {
                    //     method: "POST",
                    //     body: passForm
                    // }).then(raw => raw.text()).then(data => {
                    //     console.log(data);
                    //     if (data == "success") {

                    //         console.log(data);
                    //         updPassDlg.close();
                    //         window.location.reload();
                    //     }
                    // })

                    // pass check
                    // const pass_dlg_temp = document.querySelector("#password");

                    // Check if password is less than 8 chars
                    if (pass_dlg_temp.value.length < 8) {
                        console.log("pass <8 " + pass_dlg_temp.value);
                        // return res.textContent = "Password Length must be 8 words or higher";
                    }
                    // Check if password is greater or equal 8 chars
                    else if (pass_dlg_temp.value.length >= 8) {

                        // Check if pass contain spaces
                        if (/\s+/g.test(pass_dlg_temp.value)) {
                            console.log("pass with spaces " + pass_dlg_temp.value);
                            // return res.textContent = "Password must not contain spaces";
                        } else {

                            // ( ? = .*[a - z]) // use positive look ahead to see if at least one lower case letter exists
                            // ( ? = .*[A - Z]) // use positive look ahead to see if at least one upper case letter exists
                            // ( ? = .*\d) // use positive look ahead to see if at least one digit exists
                            // ( ? = .*\W) // use positive look ahead to see if at least one non-word character exists

                            if (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/g.test(pass_dlg_temp.value)) {
                                if (pass_dlg_temp.value.length >= 8) {
                                    // console.log(`Password is strong: ${pass.value}`);



                                    const passForm = new FormData(updatePassForm);
                                    passForm.append('button', 'updatePass');
                                    passForm.append('pass_dlg_temp', pass_dlg_temp.value);
                                    passForm.append('email', document.querySelector("#hiddenEmail").value);
                                    fetch("process.php", {
                                        method: "POST",
                                        body: passForm
                                    }).then(raw => raw.text()).then(data => {
                                        console.log(data);
                                        if (data == "success") {

                                            console.log(data);
                                            updPassDlg.close();
                                            window.location.reload();
                                        }
                                    })


                                }

                            } else {
                                console.log("Password Must contain at least 1 symbol, 1 number, 1 uppercase and 1 lowercase character" + pass_dlg_temp.value);
                                // return res.textContent = "Password Must contain at least 1 symbol, 1 number, 1 uppercase and 1 lowercase character";
                            }
                        }
                    }
                    // 


                })
                // edit button opens update image dialog
                editImg_dlg.addEventListener("click", () => {
                    // file
                    // img_dlg_temp.value=img_dlg.value;
                    updImgDlg.showModal();
                })
                // cancel button inside update image dialog closes it
                cancelImg_dlg.addEventListener("click", () => {
                    updImgDlg.close();
                })
                // img update button
                updateImg_dlg.addEventListener("click", () => {
                    const imgForm = new FormData(updateImgForm);
                    imgForm.append('image', img_dlg_temp.files[0]);
                    imgForm.append('button', 'updateImg');
                    imgForm.append('email', document.querySelector("#hiddenEmail").value);
                    fetch("process.php", {
                        method: "POST",
                        body: imgForm
                    }).then(raw => raw.text()).then(data => {
                        console.log(data);
                        if (data == "success") {

                            console.log(data);
                            updImgDlg.close();
                            window.location.reload();
                        }
                    })
                })

            } else if (e.target.innerHTML != document.querySelector("#hiddenName").value) {

            }

        })


        // Send msg and then display
        send.addEventListener("click", () => {
            const newForm = new FormData();

            newForm.append("userEmail", document.querySelector("#hiddenEmail").value);

            newForm.append("targetEmail", document.querySelector("#hiddenTargetEmail").value);
            const str = document.querySelector("#msg_box").value;

            // 2 single quotes are used to escape 1 quote(2 single quotes will be replaced by 1 single quote in db)
            const newStr1 = str.replace(/'/g, "''");
            // const newStr2 = newStr1.replace(/"/g, '""');
            newForm.append("msg", newStr1);

            if (document.querySelector("#hiddenTargetEmail").value != "") {
                fetch("sendMsgAPI.php", {
                        method: "post",
                        body: newForm
                    }).then(resp => resp.text())
                    .then(data => {

                        // If sendMsgAPI returns "sent" then display
                        if (data == "sent") {
                            // Ratchet will update the other user side
                            conn.send(newStr1);

                            // 

                            // clear the #msg_box
                            let msgBox = document.querySelector("#msg_box");
                            msgBox.value = "";

                            // This code is for updating the user side only
                            const newForm = new FormData();
                            newForm.append("otherEmail", document.querySelector("#hiddenTargetEmail").value);
                            newForm.append("userEmail", document.querySelector("#hiddenEmail").value);

                            fetch("getMsgAPI.php", {
                                    method: "post",
                                    body: newForm
                                })
                                .then(data => data.json()).then(response => {
                                    // output.innerHTML = response;
                                    console.log(response);
                                    const chat_ul = document.querySelector("#chat_ul");

                                    if (response != "empty") {
                                        const mapped = response.map(obj => {
                                            console.log(obj.message.substring(0, 3), obj.message.substring(3));
                                            let msgr = obj.message.substring(0, 3);
                                            let msg = obj.message.substring(3);

                                            // If the msg send by user 
                                            if (msgr == "usr") {
                                                return `<li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">
                                        ${
                                            // if year is not 00 print year and months
                                            obj.msgTime.split(",")[0]!="00"?obj.msgTime.split(",")[0]+" years "+obj.msgTime.split(",")[1]+" months "
                                            // else if month is not 00 print month and days
                                        :obj.msgTime.split(",")[1]!="00"?obj.msgTime.split(",")[1]+" months "+obj.msgTime.split(",")[2]+" days "
                                        // else if day is not 00 print day and hrs
                                        :obj.msgTime.split(",")[2]!="00"?
                                        obj.msgTime.split(",")[2]+" days "+obj.msgTime.split(",")[3]+" hrs "
                                        // else if hour is not 0 print hr and mins
                                        :obj.msgTime.split(",")[3]!="0"?
                                        obj.msgTime.split(",")[3]+" hrs "+obj.msgTime.split(",")[4]+" mins "
                                        // else print mins and sec
                                        :obj.msgTime.split(",")[4]+" mins "+obj.msgTime.split(",")[5]+" sec " }
                                        ago
                                        </span>
                                    </div>
                                    <div class="message my-message">${msg}</div>
                                </li>`
                                            }
                                            // If user received the msg
                                            else {
                                                return `<li class="clearfix">
                                    <div class="message-data text-right">
                                        <span class="message-data-time">

                                        ${
                                            // if year is not 00 print year and months
                                            obj.msgTime.split(",")[0]!="00"?obj.msgTime.split(",")[0]+" years "+obj.msgTime.split(",")[1]+" months "
                                            // else if month is not 00 print month and days
                                        :obj.msgTime.split(",")[1]!="00"?obj.msgTime.split(",")[1]+" months "+obj.msgTime.split(",")[2]+" days "
                                        // else if day is not 00 print day and hrs
                                        :obj.msgTime.split(",")[2]!="00"?
                                        obj.msgTime.split(",")[2]+" days "+obj.msgTime.split(",")[3]+" hrs "
                                        // else if hour is not 0 print hr and mins
                                        :obj.msgTime.split(",")[3]!="0"?
                                        obj.msgTime.split(",")[3]+" hrs "+obj.msgTime.split(",")[4]+" mins "
                                        // else print mins and sec
                                        :obj.msgTime.split(",")[4]+" mins "+obj.msgTime.split(",")[5]+" sec " }
                                        ago

                                        </span>
                                        <img src="${document.querySelector("#hiddenTargetImg").value}">
                                    </div>
                                    <div class="message other-message float-right">${msg} </div>
                                </li>`
                                            }

                                        });

                                        const joined = mapped.join("", ",");

                                        chat_ul.innerHTML = joined;

                                    }



                                })



                        } else {

                        }
                        console.log(data)
                    })
            }


        })


        // Search (attempt)
        searchBox.addEventListener("input", () => {
            console.log(searchBox.value);
            const chatName = document.querySelectorAll("li.clearfix .chat-list-name");
            // console.log(typeof chatName);
            chatName.forEach(obj => {
                // includes is more appropriate than ==
                if (obj.textContent.includes(searchBox.value)) {
                    if (obj.parentNode.parentElement.classList.contains("hide")) {
                        obj.parentNode.parentElement.classList.remove("hide");

                    }
                }
                // Had to use: && searchBox.value!=""  or else empty search box will also trigger this condition
                else if (obj.textContent != searchBox.value && searchBox.value != "") {
                    obj.parentNode.parentElement.classList.add("hide")
                } else if (searchBox.value == "") {

                    if (obj.parentNode.parentElement.classList.contains("hide")) {
                        obj.parentNode.parentElement.classList.remove("hide");
                    }
                }
            })
        })


        // logout
        const logout = document.querySelector("#logout");

        logout.addEventListener("click", () => {
            const emptyForm = new FormData();
            emptyForm.append("button", "logout");
            emptyForm.append("email", document.querySelector("#hiddenEmail").value);

            fetch("process.php", {
                method: "post",
                body: emptyForm
            }).then(data => data.text()).then(data => {
                console.log(data);
                if (data == "logged out") {
                    window.location.reload();
                }
            })
        })
    </script>
</body>
<!--    1 bug in displaying other user's profile pic  in msg chat.
        1 bug in displaying chat history if not clicked on correct area in chat list.  
        Currently images can't be sent since it's not implemented in db yet

        target img logic: on click target user from chat list, display their name and img at the top right side(top of messages). During that process, set their img on a hidden input. Then when displaying messages(of target user), get that hidden input(img) value and display.

       
        -->

</html>