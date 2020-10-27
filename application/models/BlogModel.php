<?php

namespace application\models;

use PDO;
use Datetime;
use Datetimezone;

class BlogModel {

    private $controller;

    public function __construct($controller) {
        $this -> controller = $controller;
    }

    public function index() {
        $explodedCurrentPath = explode('/', $_SERVER['REQUEST_URI']);
        if (isset($explodedCurrentPath[3])){
            $this -> controller -> view -> render ('application/views/template.php', "application/articles/".$explodedCurrentPath[3]);
            if (isset($_SESSION['login'])){
                require 'application/views/commentForm.php';
            }
            $this -> renderComments();
            
        } else {
            $this -> controller -> view -> render('application/views/template.php', null);
            echo '<br>';
            $articles = scandir("application/articles");
            for ($i = 2; $i < count($articles); $i += 1){
                $path = "\Blog\index\\$articles[$i]";
                $link = "<a href=\"$path\">$articles[$i]</a><br>";
                echo "<div id = 'content'>".$link."</div>";
            }
        }
    }

    public function addCommentAction(){
        $article = explode('/', $_SERVER['HTTP_REFERER'])[5];
        if (isset($_POST['comment']) and isset($_SESSION['login'])){
            $query = 'INSERT INTO `comments` (article_name, user_login, comment) VALUES(?, ?, ?)';
            $dbConfig = require 'application/config/db.php';
            $db = new PDO('mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['dbname'].'', $dbConfig['user'], $dbConfig['password']);
            $preparedPDO = $db -> prepare($query);
            $commentArray = array($article, $_SESSION['login'], $_POST['comment']);
            $preparedPDO -> execute($commentArray);
            header('location: /Blog/index/'.$article);
        }
    }

    public function deleteCommentAction() {
        $article = explode('/', $_SERVER['HTTP_REFERER'])[5];
        $commentID = $_POST['commentID'];
        $dbConfig = require 'application/config/db.php';
        $db = new PDO('mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['dbname'].'', $dbConfig['user'], $dbConfig['password']);
        $db -> exec('DELETE FROM `comments` WHERE `id` = '.$commentID);
        header('location: /Blog/index/'.$article);
    }

    private function renderComments() {
        $article = explode('/', $_SERVER['REQUEST_URI']);
        $dbConfig = require 'application/config/db.php';
        $db = new PDO('mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['dbname'].'', $dbConfig['user'], $dbConfig['password']);
        $query = "SELECT * FROM `comments` WHERE `article_name` = ?";
        $preparedPDO = $db -> prepare($query);
        $preparedPDO -> execute(array($article[3]));
        //$category = $preparedPDO -> fetch(PDO::FETCH_LAZY);
        while ($row = $preparedPDO -> fetch(PDO::FETCH_ASSOC)) {
            $dateTimeFromDB = new DateTime($row['datetime']);
            // $dateTimeFromDB -> setTimezone(new DateTimeZone('Europe/Moscow')); //check datetime 'now'
            $timeAgo = $this -> timeAgo($dateTimeFromDB);
            echo
            '<div class = "card">
            <div class = "card-body"'.
            '<h6 class = "card-title"><small> Comment from </small>'.$row['user_login'].'</h6>'.
            '<p class = "card-text"><small class = "text-muted">'.$timeAgo.'</small></p>'.
            '<p class = "card-text">'.$row['comment'].'</p>';
            if (isset($_SESSION['login'])){
                if ($_SESSION['login'] == $row['user_login']) {
                    echo '<form action = "/Blog/deleteComment" method = "post" >
                    <input type = "hidden" name = "commentID" value = '.$row['id'].'></input>
                    <div class = "text-right">
                    <button class = "btn btn-outline-danger btn-sm" type = "submit">delete comment</button>
                    </div>
                    </form>';
                }
            }
            echo '</div></div>';
        }
    }

    private function timeAgo($date){
        $now = new Datetime('now');
        //$now -> setTimezone(new DateTimeZone('Europe/Moscow')); //check datetime 'now'
        $interval = $date -> diff($now);
        //var_dump($interval);
        if ($interval -> y == 1) {
            return '1 year ago';
        }
        if ($interval -> y > 1) {
            return "$interval->y".' years ago';
        }
        if ($interval -> m == 1) {
            return '1 month ago';
        }
        if ($interval -> m > 1) {
            return "$interval->m".' months ago';
        }
        if (intdiv($interval -> d, 7) == 1) {
            return '1 week ago';
        }
        if (intdiv($interval -> d, 7) > 1) {
            $weeksAgo = intdiv($interval -> d, 7);
            return "$weeksAgo".' weeks ago';
        }
        if ($interval -> d == 1) {
            return '1 day ago';
        }
        if ($interval -> d > 1) {
            return "$interval->d".' days ago';
        }
        if ($interval -> h == 1) {
            return '1 hour ago';
        }
        if ($interval -> h > 1){
            return "$interval->h".' hours ago';
        }
        return 'less than an hour ago';
    }

}