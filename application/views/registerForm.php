<h3>Register</h3>

<form name = "registerForm" action = "handleRegisterForm" method = "POST" onsubmit = "return validate()">

    <div class = "form-group">
        <label for = "loginInput">Login</label>
        <input type = "text" class = "form-control" name = "login" id = "loginInput">
        <span id = "errLogin"></span><br>
    </div>

    <div class = "form-group">
        <label for = "password1Input">Password</label>
        <input type = "password" class = "form-control" name = "password1" id = "password1Input">
        <span id = "errPass1"></span><br>
    </div>

    <div class = "form-group">
        <label for = "password2Input">Confirm password</label>
        <input type = "password" class = "form-control" name = "password2" id = "password2Input">
        <span id = "errPass2"></span><br>
    </div>

    <button type = "submit" class = "btn btn-primary">Register</button>

</form>

<script>
    function validate() {

        document.getElementById("errLogin").innerText =" ";
        document.getElementById("errPass1").innerText =" ";
        document.getElementById("errPass2").innerText =" ";

        var inputLogin = document.getElementById("loginInput");
        var inputPassword1 = document.getElementById("password1Input");
        var inputPassword2 = document.getElementById("password2Input");

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

