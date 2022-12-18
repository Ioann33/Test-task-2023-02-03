<?php

namespace Controllers;

use Models\QuestionModel;
use Models\UserModel;
use Services\Service;

class ApiController
{
    public function auth() : void
    {
        $pass = md5($_POST['pass']);
        $userModel = new UserModel();
        $res = $userModel->getUserByEmailOrAndPass($_POST['email'], $pass);
        if (!$res){
            echo "Credentials didn't match!";
            http_response_code(422);
            exit();
        }

        $_SESSION['MY_TOKEN'] = hash('ripemd160', $_POST['email']);

        echo json_encode(['my_token'=>$_SESSION['MY_TOKEN']]);
    }

    public function logauth(){
        unset($_SESSION['MY_TOKEN']);
        echo 'ok';
    }

    public function testApiAuth(){
        if (!isset($_SESSION['MY_TOKEN']) || $_SESSION['MY_TOKEN'] != $_SERVER['HTTP_MY_TOKEN']){
            echo "Unauthorized !";
            http_response_code(422);
            exit();
        }
        echo 'test api auth ok';
    }

    public function getQuestById()
    {
        $model = new QuestionModel();
        $quest_id = $_GET['quest_id'];
        $question = $model->getQuestionById($quest_id);
        echo json_encode(Service::arrayCovert($question));
    }
}