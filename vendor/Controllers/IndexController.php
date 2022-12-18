<?php

namespace Controllers;

use Core\View;
use Facade\Auth;
use Models\QuestionModel;
use Services\Service;


class IndexController extends Controller
{
    public function index(){
        $this->view->render('index_index_page');
    }

    public function login(){
        $this->view->render('log_in_page');
    }

    public function profile(){

        if(Auth::User()){
            $questions = new QuestionModel();
            $lists = $questions->getUserQuestions(Auth::User(), $_GET);
            $resArr = Service::arrayCovert($lists);
            $this->view->render('profile_page', ['questions' => $resArr]);
        }else{
            \Route::notFound();
        }
    }

    public function register(){
        $this->view->render('register_page');
    }

}