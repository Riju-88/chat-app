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
        padding: 0;
        margin: 0;
        /* border: 2px solid black; */
        /* gap: 1rem; */
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
    #login {
        background-color: #0450c4;
        color: #ffffff;
    }

    h2 {
        /* width: 100%; */
        text-align: center;
        padding: 1em;
        margin: 1em 0;
    }

    #openFPassdlg {
        color: #f5022b;
        text-decoration: underline;
    }

    #openFPassdlg:hover {
        color: #5f0615;
        cursor: pointer;
    }

    dialog {
        border: 1px solid #ffffff;
        border-radius: 1rem;
    }

    dialog::backdrop {
        background-color: rgba(44, 44, 44, 0.89);
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
</style>

<body>

    <div class="cont">
        <dialog id="forgotPass">
            <div>
                <h2>Forgot Password?</h2>
                <h4>Password will be sent to the provided email address</h4>
            </div>
            <div>
                <label for="sendTo">Email:
                    <input type="email" name="sendTo" id="sendTo">
                </label>
            </div>
            <div>

                <button name="closeFPassdlg" id="closeFPassdlg">Close</button>
                <button name="sendPass" id="sendPass">Send</button>

            </div>
        </dialog>
        <form action="" id="form">
            <h2>Login</h2>
            <div>
                <label for="email">Email:
                    <input type="email" name="email" id="email">
                </label>
            </div>
            <div>
                <label for="password">Password:
                    <input type="password" name="password" id="password">
                </label>
            </div>
            <div>

                <button name="register" id="register">Register</button>

                <!-- </div>
        <div> -->

                <button name="login" id="login">Login</button>

                <p id="openFPassdlg">Forgot Password?</p>
            </div>

            <div id="resCont">
                <h3 id="res"></h3>
            </div>
        </form>


    </div>
    <script>
        let register = document.querySelector("#register");
        let login = document.querySelector("#login");
        let form = document.querySelector("#form");
        let email = document.querySelector("#email");
        let pass = document.querySelector("#password");
        let openFPassdlg = document.querySelector("#openFPassdlg");
        let closeFPassdlg = document.querySelector("#closeFPassdlg");
        let forgotPass = document.querySelector("#forgotPass");
        let sendPass = document.querySelector("#sendPass");
        let sendTo = document.querySelector("#sendTo");
        let res = document.querySelector("#res");

        register.addEventListener("click", (e) => {
            e.preventDefault();
            window.location.href = "register.php";
        })

        // login button action
        login.addEventListener("click", (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const newEmail = email.value.replace(/'/g, "''");
            const newPass = pass.value.replace(/'/g, "''");
            formData.append("email", newEmail);
            formData.append("password", newPass);
            formData.append("button", "login");
            fetch("process.php", {
                method: "post",
                body: formData
            }).then(data => data.text()).then(response => {
                // display.innerHTML = response;
                console.log(response);
                if (response == "success") {
                    window.location.href = "index.php";
                }
                else{
                    res.innerHTML=response;
                }
                // add_dlg.close();
                // // window.location.href="products.php";

            })
        })

        // on click Forgot Password opens dialog
        openFPassdlg.addEventListener("click", () => {
            forgotPass.showModal();
        })
        // on click closeFPassdlg closes dialog
        closeFPassdlg.addEventListener("click", () => {
            forgotPass.close();
        })

        // Send button sends password to provided email and closes dialog
        sendPass.addEventListener("click", () => {
            const formData = new FormData();
            formData.append("button", "forgotPass");
            formData.append("email", sendTo.value);
            fetch("process.php", {
                method: "post",
                body: formData
            }).then(data => data.text()).then(response => {

                console.log(response);
                if (response == "success") {
                    res.innerHTML = "Your Password has been sent to the provided email"
                }
                else{
                    res.innerHTML = `Something went wrong. ${response}`;
                }


            })
            forgotPass.close();
        })
    </script>
</body>

</html>