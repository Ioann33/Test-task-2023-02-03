<?php

namespace Models;

class AnswerModel extends Model
{
    public function save($values){
        $sql = trim("insert into answers (text, question_id, voices) values {$values}", ',');
        $this->db->query($sql);
    }

    public function update(int $id, string $text, int $voices){
        $sql = "update answers set text = '{$text}', voices = {$voices} where id = {$id}";
        $this->db->query($sql);
    }

    public function delete($id){
        $sql = "delete from answers where id = {$id}";
        $this->db->query($sql);
    }

    public function deleteByQuestId($id){
        $sql = "delete from answers where question_id = {$id}";
        $this->db->query($sql);
    }
}