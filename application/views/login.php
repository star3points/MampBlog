<h3>Login</h3>

<form name = "loginForm" action = "handleLoginForm" method="POST" onsubmit="return validate()">
    <label>Login<br><input type = "text" name = "login" id = "loginID"></label>
    <span id = "errLogin"></span><br>
    <label>Password<br> <input type = "text" name = "password" id = "password1ID"></label>
    <span id = "errPass"></span><br>
    <button type = "submit">Login Button</button>
</form>