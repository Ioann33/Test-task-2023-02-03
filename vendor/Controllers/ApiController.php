<?php

namespace Controllers;

use Facade\Auth;
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
        $_SESSION['auth_user'] = $res->id;
        echo json_encode(['my_token'=>$_SESSION['MY_TOKEN']]);
    }

    public function logauth(){
        unset($_SESSION['MY_TOKEN']);
        unset($_SESSION['auth_user']);
        echo 'ok';
    }

    public function getRandomQuest(): void
    {
        if (!isset($_SESSION['MY_TOKEN']) || $_SESSION['MY_TOKEN'] != $_SERVER['HTTP_MY_TOKEN']){
            echo "Unauthorized !";
            http_response_code(422);
            exit();
        }
        $model = new QuestionModel();
        $random_quest_id = $model->getRandomQuest(Auth::User());
        $question = $model->getQuestionById($random_quest_id);
        $resArr = [];

        $tmp = Service::arrayCovert($question);
        $tmp = array_shift($tmp);
        $resArr['quest'] = $tmp['text'];

        foreach ($tmp['answers'] as $item){
            $resArr['answers'][] = $item['answer'].' : '.$item['voices'];
        }

        echo json_encode($resArr);
    }

    public function getQuestById()
    {
        $model = new QuestionModel();
        $quest_id = $_GET['quest_id'];
        $question = $model->getQuestionById($quest_id);
        echo json_encode(Service::arrayCovert($question));
    }
}