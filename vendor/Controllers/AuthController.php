<?php

namespace Controllers;

use Models\UserModel;

class AuthController
{
    public $authUser;
    public $userModel;

    public function __construct()
    {
        if (isset($_SESSION['auth_user'])){
            $this->authUser = $_SESSION['auth_user'];
        }else{
            $this->authUser = null;
        }
        $this->userModel = new UserModel();
    }
    public function login(){
        $pass = md5($_POST['pass']);
        $res = $this->userModel->getUserByEmailOrAndPass($_POST['email'], $pass);
        if (!$res){
            $errors[]="Credentials didn't match!";
            \Route::addErrors($errors);
            \Route::redirect(\Route::url('index', 'login'));
            exit();
        }
        $_SESSION['auth_user'] = $res->id;
        \Route::redirect(\Route::url('index', 'profile'));
    }

    public function register(){

        $errors = [];
        $message = [];

        if ($_POST['email'] == '' || $_POST['pass'] == '' || $_POST['passConfirm'] == ''){
            $errors[]="All fields must be filled!";
        }
        if (strlen($_POST['email'])<6 || strlen($_POST['email'])>255 ){
            $errors[]="Min email length must be at least 6 charters.</br> Max length not more than 255 charters.";
        }
        if (strlen($_POST['pass'])<6 || strlen($_POST['pass'])>100 ){
            $errors[]="Min password length must be at least 6 charters.</br> Max length not more than 100 charters.";
        }
        if ($_POST['pass'] != $_POST['passConfirm']){
            $errors[]="Didn't match password confirmation";
        }

        $res = $this->userModel->getUserByEmailOrAndPass($_POST['email']);
        if (!empty($res)){
            $errors[]="This email already been taken";
        }
        $pass = md5($_POST['pass']);
        try {
            if (count($errors) == 0){
                $user = $this->userModel->create($_POST['email'], $pass);
            }
        }catch (\Exception $e){
            $errors[]=$e->getMessage();
        }
        if (count($errors)>0){
            \Route::addErrors($errors);
            \Route::redirect(\Route::url('index', 'register'));
            exit();
        }
        $message[] = 'Successful registration';
        \Route::addMessage($message);
        \Route::redirect(\Route::url('index', 'login'));
    }
    public function logout(){
        unset($_SESSION['auth_user']);
        \Route::redirect(\Route::url());
    }
}