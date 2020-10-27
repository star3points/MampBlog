<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <title>My pet blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="/application/styles/template.css">
    <!-- <base href="http://mypetblog.h1n.ru/"> ??? -->
</head>

<body>
<header id = headerNavBar>
<div id = "header">
    <nav class = "navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <a class = "navbar-brand" href = "/" >MyPetBlog </a>
        <ul class = "navbar-nav">
        
            <li class = "nav-item">
                <a class = "nav-link" href ="/" >Main</a>
            </li>

            <li class = "nav-item">
                <a class = "nav-link" href ="/Blog/index">Blog</a>
            </li>

            <li class = "nav-item">
                <a class = "nav-link" href ="/">About</a>
            </li>

        </ul>

            <?php
            if (isset($_SESSION['login'])){
                echo 
                '<ul class = "navbar-nav ml-auto">
                <li class = "nav-item"><span class = "navbar-text mr-3" >'.$_SESSION['login'].'</span></li>
                <li class = "nav-item"><a class = "btn btn-primary mr-2" href="/Account/exit">Logout</a></li>
                </ul>';
            } else {
                 echo 
                '<ul class = "navbar-nav ml-auto">
                <li class = "nav-item"><a class = "btn btn-primary mr-2" href = "/Account/login">Login</a></li>
                <li class = "nav-item"><a class = "btn btn-outline-primary mr-3" href = "/Account/register">Register</a></li>
                </ul>';
            }
            ?>

    </nav>

</div>
</header>

<div id = "content" >
    <div>
    <?php
    if (isset($content)) {
        require $content;
    }
    ?>
    </div>
</div>

<div id = "content">
<?php
// var_dump($_POST);
// echo '<br>';
// var_dump($_SESSION);
?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>