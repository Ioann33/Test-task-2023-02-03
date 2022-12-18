<?php

namespace Controllers;

use Core\View;
use Facade\Auth;
use Models\AnswerModel;
use Models\QuestionModel;

class QuestionController extends Controller
{
    private object $question_model;
    private object $answer_model;

    public function __construct()
    {
        parent::__construct();
        $this->question_model = new QuestionModel();
        $this->answer_model = new AnswerModel();
    }

    public function create(){
        $this->view->render('create_quest_page');
    }

    public function save(){
        $input = json_decode(file_get_contents('php://input'));
        try {
            $question_id = '';
            if (!empty($input->text)){
                $question_id = $this->question_model->save($input->text, $input->state, Auth::User());
            }else{
                http_response_code(422);
                exit();
            }
            $values = '';
            foreach ($input->answers as $answer){
                if (empty($answer->answer) || empty($question_id)){
                    continue;
                }
                $values .= "('{$answer->answer}', {$question_id->id}, {$answer->voices}),";
            }
            if (!empty($values)){
                $this->answer_model->save($values);
            }
        }catch (\Exception $e){
            echo $e->getMessage();
            http_response_code(500);
            exit();
        }
    }

    public function edit(){
        $question_id = $_GET['quest_id'];
        $this->view->render('edit_quest_page', ['id' => $question_id]);
    }

    public function update(){
        $input = json_decode(file_get_contents('php://input'));
        if (!empty($input->text)){
            $this->question_model->update($input->id, $input->text, $input->published);
        }else{
            http_response_code(422);
            exit();
        }
        $creates = '';
        try {
            foreach ($input->answers as $key => $answer){
                if (!empty($answer->answer)){
                    if ($answer->update == 0){
                        $creates .= "('{$answer->answer}', {$input->id}, {$answer->voices}),";
                    }else if ($answer->update == 1){
                        $this->answer_model->update($key, $answer->answer, $answer->voices);
                    }else if ($answer->update == 2){
                        $this->answer_model->delete($key);
                    }
                }
            }
            if (!empty($creates)){
                $this->answer_model->save($creates);
            }
        }catch (\Exception $e){
            echo $e->getMessage();
            http_response_code(500);
            exit();
        }

    }

    public function delete(){
        $question_id = $_GET['quest_id'];
        try {
            $this->answer_model->deleteByQuestId($question_id);
            $this->question_model->delete($question_id);
            \Route::addMessage(['delete successful']);
        }catch (\Exception $e){
            \Route::addErrors([$e->getMessage()]);
        }

        \Route::redirect(\Route::url('index', 'profile'));
    }

}