<?php

namespace Controllers;


use Models\UserModel;

class ApiController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function save(): void
    {
        $errors = [];

        if (!isset($_POST['email']) || !isset($_POST['pass']) || !isset($_POST['passConf'])){
            $errors[]="All fields must be filled!";
            echo json_encode($errors);
            http_response_code(422);
            exit();
        }

        if (!preg_match("/^[a-z0-9.]*@[a-z0-9.]*$/i", $_POST['email'])){
            $errors[] = "Email must be contain chart @";
        }

        if ($_POST['pass'] != $_POST['passConf']){
            $errors[] = "Didn't match password confirmation";
        }

        $res = $this->userModel->getUserByEmail($_POST['email']);

        if ($res){
            $errors[] = "This email already been taken";
        }

        if (count($errors)>0){
            echo json_encode($errors);
            http_response_code(422);
            exit();
        }
        $message[] = 'Successful registration';
        echo json_encode($message);
        http_response_code(200);
    }
}