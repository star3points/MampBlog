<?php

namespace application\models;

use PDO;

class BlogModel {

    private $controller;

    public function __construct($controller) {
        $this -> controller = $controller;
    }

    public function index() {
        $explodedCurrentPath = explode('/', $_SERVER['REQUEST_URI']);
        if (isset($explodedCurrentPath[3])){
            $this -> controller -> view -> render ('application/views/template.php', "application/articles/".$explodedCurrentPath[3]);
            require 'application/views/comment.php';

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
}