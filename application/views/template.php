
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My ugly pet</title>
    <link rel="stylesheet" href="/application/styles/template.css">
</head>
<!--<h1>My ugly pet</h1>-->
<body>
<div id = "headerBox">
    <?php
    if (isset($_SESSION['login'])){
        echo '<div class = "headerLogReg">
                <div class = "logRegLink">'.$_SESSION['login'].'</div>'.
                "<div class = 'logRegLink'><a id = 'exitLink' href='/account/exit'>Exit</a></div>".
              "</div>";
    } else {
        echo '<div class = "headerLogReg">
                <a class = "logRegLink" href = "/account/login">login</a>
                <a class = "logRegLink" href = "/account/register">register</a>
              </div>';
    }
    ?>
    <div id = "headerMenu">
        <a class = "menuLink" href ="/">Main</a>
        <a class = "menuLink" href ="/blog/index">Blog</a>
        <a class = "menuLink" href ="/">About</a>
    </div>

</div>


<?php
if (isset($content)) {
    require $content;
}
?>

</body>
</html>