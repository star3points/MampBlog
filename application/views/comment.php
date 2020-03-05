</p>
<form name="commentForm" action="/blog/addComment" method="post">
    <textarea type="text" name="comment"></textarea><br>
    <button type="submit">Comment</button>
</form>
</p>

<?php

$article = explode('/', $_SERVER['REQUEST_URI']);
//echo "$article[3]";
$dbConfig = require 'application/config/db.php';
$db = new PDO('mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['dbname'].'', $dbConfig['user'], $dbConfig['password']);
$query = "SELECT * FROM `comments` WHERE `article_name` = ?";
$preparedPDO = $db -> prepare($query);
$preparedPDO -> execute(array($article[3]));
//$category = $preparedPDO -> fetch(PDO::FETCH_LAZY);
while ($row = $preparedPDO -> fetch(PDO::FETCH_ASSOC)) {
    echo $row['user_login'].'</p>';
    echo $row['comment'].'</p>';
}