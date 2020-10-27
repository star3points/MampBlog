<?php

namespace application\controllers;

use application\models\AccountModel;

class AccountController extends \application\core\Controller {

    private $model;

    public function __construct() {
        parent:: __construct();
        $this -> model = new AccountModel($this);
    }

    public function loginAction() {
        $this -> view -> render('application/views/template.php', 'application/views/loginForm.php');

    }

    public function registerAction() {
        $this -> view -> render('application/views/template.php', 'application/views/registerForm.php');
    }

    public function exitAction(){
        $this -> model -> exitAction();
    }

    public function handleLoginFormAction() {
        $this -> model -> login();
    }

    public function handleRegisterFormAction() {
        $registered = $this -> model -> register();
        if ($registered) {
            $this -> loginAction();
        }
    }

}
