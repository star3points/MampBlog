<?php

namespace application\controllers;

use application\core\Controller;

//require 'application/views/template.php';

class MainController extends Controller {

    public function indexAction() {
        $this -> view -> render('application/views/template.php', 'application/views/main.php');

    }
}