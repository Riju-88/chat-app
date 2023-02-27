<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .cont {
        display: flex;
        flex-wrap: wrap;
        flex: 1;
        justify-content: center;
        align-items: center;
        background-color: #ffffff;
        width: 100vw;
        height: 100vh;
        /* padding: auto; */
        margin: 0;
        /* border: 2px solid black; */
    }

    .cont div {
        margin: 1rem;
        font-weight: bold;

    }

    .cont button {
        padding: 0.5em 1em;
        border-radius: 100vmax;
        cursor: pointer;
        margin: 1em;
    }
    form{
        /* border: 2px solid black; */
        border-radius: 1rem;
        background-color: #e9e3e3;
        box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.808);
    }
    #register {
        background-color: #0450c4;
        color: #ffffff;
    }

    h2 {
        /* width: 100%; */
        text-align: center;
        padding: 1em;
        margin: 1em 0;
    }

    #resCont {
        width: 100%;
        position: relative;
    }

    #res {
        color: #f5022b;
        /* word-break: break-all; */
        position: absolute;
        inset: 0;
    }

    dialog {
            border: 1px solid #ffffff;
            border-radius: 1rem;
        }

    /* button container inside dialog */
    .dlg_button {
        width: 100%;
        /* min-height: 1rem; */
        /* padding: auto; */
        text-align: center;
        /* margin: auto; */
    }

    .dlg_button button {
        padding: 0.5em 1em;
        border-radius: 100vmax;
        cursor: pointer;
        margin: 1em;
    }
    #image{
        width: 8rem;
        overflow: hidden;
    }
</style>

<body>
    <input type="hidden" id="temp_otp" value="">
    <dialog id="otp_dlg">
        <div>
            <h4>OTP will be sent to the provided email address</h4>
        </div>
        <div>
            <label for="otp">Enter OTP:
                <input type="text" name="otp" id="otp">
            </label>
        </div>
        <div class="dlg_button">

            <button name="close_dlg" id="close_dlg">Cancel</button>
            <button name="resend" id="resend" disabled="true">Resend OTP</button>
            <button name="register" id="register">Register</button>

        </div>
    </dialog>
    <div class="cont">

        <form action="" id="form">
            <h2>Register</h2>
            <div><label for="name">*Name: </label><input type="text" name="name" id="name"></div>
            <div><label for="email">*Email: </label><input type="email" name="email" id="email"></div>
            <div><label for="password">*Password: </label><input type="password" name="password" id="password"></div>
            <div><label for="image">Profile Image: </label><input type="file" name="image" id="image"></div>

            <div>
                <button name="login" id="login">Login</button>
                <button name="otpGen" id="otpGen">Proceed to Register</button>

            </div>

            <div id="resCont">
                <h3 id="res"></h3>
            </div>
        </form>

    </div>
    <div id="output"></div>

    <script>
        let login = document.querySelector("#login");
        let name = document.querySelector("#name");
        let email = document.querySelector("#email");
        let otpGen = document.querySelector("#otpGen");
        let otp_dlg = document.querySelector("#otp_dlg");
        let otp = document.querySelector("#otp");
        let register = document.querySelector("#register");
        let form = document.querySelector("#form");
        let output = document.querySelector("#output");
        let close_dlg = document.querySelector("#close_dlg");
        let resend = document.querySelector("#resend");
        let res = document.querySelector("#res");
        let temp_otp = document.querySelector("#temp_otp");
        let temp_otp_val = "";

        login.addEventListener("click", (e) => {
            e.preventDefault();
            window.location.href = "login.php";
        })

        otpGen.addEventListener("click", (e) => {
            e.preventDefault();

            // pass check
            const pass = document.querySelector("#password");

            // Check if password is less than 8 chars
            if (pass.value.length < 8) {
                console.log(pass.value);
                return res.textContent = "Password Length must be 8 words or higher";
            }
            // Check if password is greater or equal 8 chars
            else if (pass.value.length >= 8) {

                // Check if pass contain spaces
                if (/\s+/g.test(pass.value)) {
                    console.log(pass.value);
                    return res.textContent = "Password must not contain spaces";
                } else {

                    // ( ? = .*[a - z]) // use positive look ahead to see if at least one lower case letter exists
                    // ( ? = .*[A - Z]) // use positive look ahead to see if at least one upper case letter exists
                    // ( ? = .*\d) // use positive look ahead to see if at least one digit exists
                    // ( ? = .*\W) // use positive look ahead to see if at least one non-word character exists

                    if (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/g.test(pass.value)) {
                        if (pass.value.length >= 8) {
                            // console.log(`Password is strong: ${pass.value}`);

                            // opens the otp dialog and sends OTP only if all fields are filled
                            if (name.value != "" && email.value != "" && pass.value != "") {
                                if (/^\s+|[^\w\d\s]|\s+$/g.test(name.value)) {
                                    res.innerHTML=`<p>Name can only contain letters and numbers</p>
                                    <p>There can't be space at the beginning or end of name</p>`;
                                } else {

                                    res.innerHTML="";
                                    // open otp dialog
                                    otp_dlg.showModal();

                                    // enables the resend button after 10 sec
                                    setTimeout(() => {
                                        resend.removeAttribute("disabled");
                                    }, 10000)

                                    // Generate OTP button Sends OTP
                                    const formData = new FormData(form);
                                    
                                    formData.append("button", "otp");
                                    formData.append("email", email.value);
                                    

                                    fetch("process.php", {
                                        method: "post",
                                        body: formData
                                    }).then(data => data.json()).then(response => {
                                        // response contains msg and otp
                                        // console.log(response);

                                        if (response.msg == "success") {
                                            // set otp value inside hidden input
                                            // temp_otp.value = response.otp;

                                            // setting OTP value to temp_otp_val var
                                            temp_otp_val = response.otp;

                                            res.innerHTML = "OTP has been sent. Check your email";


                                            // expire the OTP(by setting "") of temp_otp_val after 30 sec
                                        setTimeout(() => {
                                            temp_otp_val = "";
                                            // clearTimeout(this._timeout);
                                        }, 30000)
                                        }
                                        else{
                                            console.log(response);
                                            res.innerHTML = `Couldn't sent OTP to the provided email address. ${response}`;
                                        }

                                        
                                    })
                                }

                            }
                            // if any field is empty
                            else {
                                res.innerHTML = "All(*) fields must be filled";
                            }


                            // cancel button action inside dialog
                            close_dlg.addEventListener("click", () => {
                                otp_dlg.close();
                                resend.setAttribute("disabled", "true");
                            })

                            // Resend button action inside dialog
                            resend.addEventListener("click", () => {

                                res.innerHTML="";



                                // Resend OTP button Sends OTP
                                const formData = new FormData(form);
                                formData.append("button", "otp");
                                formData.append("email", email.value);

                                fetch("process.php", {
                                    method: "post",
                                    body: formData
                                }).then(data => data.json()).then(response => {
                                    // response contains msg and otp
                                    // console.log(response);

                                    if (response.msg == "success") {
                                        // set otp value inside hidden input
                                        // temp_otp.value = response.otp;

                                        // setting OTP value to temp_otp_val var
                                        temp_otp_val = response.otp;

                                         // expire the OTP(by setting "") of temp_otp_val after 30 sec
                                        setTimeout(() => {
                                            temp_otp_val = "";
                                            // clearTimeout(this._timeout);
                                        }, 30000);

                                        res.innerHTML = "OTP has been sent. Check your email";

                                    }

                                    else{
                                        console.log(response);
                                            res.innerHTML = `Couldn't sent OTP to the provided email address. ${response}`;
                                    }
                                })

                                // on click resend button will be disabled and timer will be set
                                resend.setAttribute("disabled", "true");
                                setTimeout(() => {

                                    // re-enable resend button after 10 sec
                                    resend.removeAttribute("disabled");

                                }, 10000);
                            })

                            // register button action inside dialog
                            register.addEventListener("click", (e) => {
                                e.preventDefault();

                                // Checking OTP

                                // comparing with hidden input value
                                // if (otp.value == temp_otp.value) {

                                    // comparing with the temp_otp_val var
                                if (otp.value == temp_otp_val) {
                                    const formData = new FormData(form);

                                    // if email contains single quote(') then escape it using 2 single quotes('')
                                    const newEmail = email.value.replace(/'/g, "''");
                                    // if password contains single quote(') then escape it using 2 single quotes('')
                                    const newPass = pass.value.replace(/'/g, "''");
                                    formData.append("email", newEmail);
                                    formData.append("password", newPass);
                                    formData.append("button", "register");

                                    fetch("process.php", {
                                        method: "post",
                                        body: formData
                                    }).then(data => data.text()).then(response => {
                                        res.innerHTML = response;
                                        console.log(response);
                                        otp_dlg.close();
                                        // add_dlg.close();
                                        // // window.location.href="products.php";
                                        // window.location.reload(this);
                                    })
                                } else {
                                    res.innerHTML = "Invalid OTP";
                                }

                            })

                        }

                    } else {
                        console.log(pass.value);
                        return res.textContent = "Password Must contain at least 1 symbol, 1 number, 1 uppercase and 1 lowercase character";
                    }
                }
            }
            // 

        })
    </script>

    <!-- BUGS:
                Invalid email sends success message response-->
</body>

</html>