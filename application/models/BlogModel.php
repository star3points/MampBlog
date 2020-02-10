<?php

namespace application\models;

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
                $path = "\blog\index\\$articles[$i]";
                $link = "<a href=\"$path\">$articles[$i]</a><br>";
                echo $link;
            }
        }
    }

    public function addCommentAction(){
        $article = explode('/', $_SERVER['HTTP_REFERER'])[5];
        print_r($article);
        echo 'new commit';

    }
}