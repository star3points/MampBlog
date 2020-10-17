<?php

namespace application\models;

use PDO;

class AccountModel {

    private $controller;
    private $db;

    public function __construct($controller) {
        $dbConfig = require 'application/config/db.php';
        $this -> controller = $controller;
        $this -> db = new PDO(
            'mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['dbname'].'', $dbConfig['user'], $dbConfig['password']);

    }

    public function exitAction() {
        unset ($_SESSION['login']);
        header('location: /');
    }

    public function login() {
        if ($this->loginFormIsSet()){
            $hashPassFromDB = $this -> getHashPassFromDB($_POST['login']);
            if (!empty($hashPassFromDB)){
                if (password_verify($_POST['password1'], $hashPassFromDB)){
                    $_SESSION['login'] = $_POST['login'];
                    header('location: /');
                } else {  
                    $this -> controller -> loginAction();
                    echo  "<script>document.getElementById('errPass').innerText = 'invalid password' ;</script>";
                }
            } else {
                
                $this -> controller -> loginAction();
                echo  "<script>document.getElementById('errLogin').innerText = 'this user not found' ;</script>";
            }
        }
    }

    private function loginFormIsSet() {
        if (isset($_POST['login']) and
            isset($_POST['password1'])) {
            return true;
        }
        return false;
    }

    private function getHashPassFromDB($login){
        $preparedPDO = $this -> db -> prepare('SELECT `password` FROM `users` WHERE `login` = ?');
        $preparedPDO -> execute(array($login));
        $password = $preparedPDO -> fetch(PDO::FETCH_ASSOC);
        return $password['password'];
    }

    public function register() {
        if ($this -> registerFormIsSet() and
            $this -> loginNotExist($_POST['login'])) { // validate : js in views/register.php
            $login = $_POST['login'];
            $password = $_POST['password1'];
            $this -> addUser($login, $password);
            unset($_POST['login'], $_POST['password1'], $_POST['password2']); // ???
            echo"<script> alert('Welcome') </script>";
            return true;
        }
        return false;
    }

    private function registerFormIsSet() {
        if ((isset($_POST['login']) and
            isset($_POST['password1']) and
            isset($_POST['password2']))){
            return true;
        } else {
            return false;
        }
    }

    // true - данный логин не занят
    private function loginNotExist($login) {
        $loginNotExist = true;
        $preparedPDO = $this -> db -> prepare('SELECT * FROM `users`');
        $preparedPDO -> execute(array());
        $allUser = $preparedPDO -> fetchAll(PDO::FETCH_COLUMN, 1);
        if (count($allUser)) {
            foreach($allUser as $user) {
                if ($user == $login){
                    $loginNotExist = false;
                    $this -> controller -> registerAction();
                    echo  "<script>document.getElementById('errLogin').innerText = 'this login is taken' ;</script>";
                    break;
                }
            }
        }
        return $loginNotExist;
    }

    private function addUser($login, $password) {
        $query = 'INSERT INTO `users` (login, password) VALUES (?, ?)';
        $preparedPDO = $this -> db -> prepare($query);
        $userLogPass = array ($login, password_hash($password, PASSWORD_DEFAULT));
        $preparedPDO -> execute($userLogPass);
    }
}

