<form name = "loginForm" action = "handleLoginForm" method="POST" onsubmit="return validate()">

    <div class = "form-group has-feedback">
        <label for = "loginInput">Login</label>
        <input type = "login" class = "form-control" name = "login" id = "loginInput">
        <span id = "errLogin"></span>
    </div>

    <div class = "form-group">
        <label for = "password1Input">Password</label>
        <input type = "password" class = "form-control" name = "password1" id = "password1Input">
        <span id = "errPass"></span>
    </div>

    <button type = "submit" class = "btn btn-primary">Login</button>

</form>
