<?php

namespace application\controllers;


use application\models\BlogModel;

class BlogController extends \application\core\Controller {

    private $model;

    public function __construct() {
        parent::__construct();
        $this -> model = new BlogModel($this);
    }

    public function indexAction() {
        $this -> model -> index();
    }

    public function addCommentAction() {
        $this -> model -> addCommentAction();
    }

    public function deleteCommentAction() {
        $this -> model -> deleteCommentAction();
    }

}
