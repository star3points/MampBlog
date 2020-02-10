<?php

namespace application\core;

class Controller {

    private $model;
    public $view;

    public function __construct() {
        //echo 'controller -> construct<br>';
        $this -> view = new View();
    }

    public function indexAction() {
        //
    }
}