<div id = "content">
    <div class = "form-group">
        <form name = "commentForm" action = "/Blog/addComment" method = "post">
        <textarea type = "text" name = "comment"></textarea><br>
        <button type = "submit">Comment</button>
        </form>
    </div>

    

<?php

//render comments

$article = explode('/', $_SERVER['REQUEST_URI']);
//echo "$article[3]";
$dbConfig = require 'application/config/db.php';
$db = new PDO('mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['dbname'].'', $dbConfig['user'], $dbConfig['password']);
$query = "SELECT * FROM `comments` WHERE `article_name` = ?";
$preparedPDO = $db -> prepare($query);
$preparedPDO -> execute(array($article[3]));
//$category = $preparedPDO -> fetch(PDO::FETCH_LAZY);
while ($row = $preparedPDO -> fetch(PDO::FETCH_ASSOC)) {
    //echo $row['id'].'</p>';
    echo $row['user_login'].'</p>';
    echo $row['datetime'].'</p>';
    echo $row['comment'].'</p>';
    if (isset($_SESSION['login'])){
        if ($_SESSION['login'] == $row['user_login']) {
            echo '<form action = "/Blog/deleteComment" method = "post" >
                    <input type = "hidden" name = "commentID" value = '.$row['id'].'></input>
                    <button type = "submit">delete comment</button>
                 </form>';
        }
    }
}
?>

</div>