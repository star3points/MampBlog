<h3>Register</h3>

<form name = "registerForm" action="handleRegisterForm" method="POST" onSubmit="return validate();">
    <label>Login<br> <input type = "text" name = "login" id = "loginID"></label>
    <span id = "errLogin"></span><br>
    <label>Password<br> <input type = "text" name = "password1" id = "password1ID"></label>
    <span id = "errPass1"></span><br>
    <label>Confirm password<br> <input type = "text" name = "password2" id = "password2ID"></label>
    <span id = "errPass2"></span><br>
    <button type = "submit">Register Button</button>
</form>

<script>
    function validate() {

        document.getElementById("errLogin").innerText =" ";
        document.getElementById("errPass1").innerText =" ";
        document.getElementById("errPass2").innerText =" ";

        var inputLogin = document.getElementById("loginID");
        var inputPassword1 = document.getElementById("password1ID");
        var inputPassword2 = document.getElementById("password2ID");

        if (!inputLogin.value || !inputPassword1.value || !inputPassword2.value) {
            if (!inputLogin.value) {
                document.getElementById("errLogin").innerText = "fill this field";
            }
            if (!inputPassword1.value) {
                document.getElementById("errPass1").innerText = "fill this field";
            }
            if (!inputPassword2.value) {
                document.getElementById("errPass2").innerText = "fill this field";
            }
            return false;
        }

        if (inputLogin.value.length < 4) {
            document.getElementById("errLogin").innerText = "Login min length = 4";
            return false;
        }

        if (inputLogin.value.length > 15) {
            document.getElementById("errLogin").innerText = "Login max length = 15";
            return false;
        }

        if (inputPassword1.value.length < 4) {
            document.getElementById("errPass1").innerText = "min password length = 4";
            return false;
        }

        if (inputPassword1.value != inputPassword2.value) {
            document.getElementById("errPass1").innerText = "Invalid password";
            return false;
        }

    }
</script>

