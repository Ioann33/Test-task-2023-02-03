<?php

namespace Models;

use PDO;

class QuestionModel extends Model
{
    public function getUserQuestions(int $user_id, array $filter): array | false
    {


        $sql = "select a.id as answer_id, a.text as answer, voices, q.id as quest_id, q.text as qustions, published, date from answers a right join questions q on a.question_id = q.id where q.id in (select id from questions where user_id = {$user_id})";

        if (!empty($filter)){
            switch (array_key_first($filter)){
                case 'qustions' : $sql.= " order by qustions {$filter['qustions']}";
                break;
                case 'date' : $sql.= " order by date {$filter['date']}";
                break;
                case 'published' : $sql.= " and published = {$filter['published']}";
            }
        }

        return $this->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public function getQuestionById(int $id): array | false
    {
        $sql = "select a.id as answer_id, a.text as answer, voices, q.id as quest_id, q.text as qustions, published, date from answers a right join questions q on a.question_id = q.id where q.id in (select id from questions where q.id = {$id})";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public function save(string $text, string $status, string $user_id) : object
    {
        $sql = "insert into questions (text, published, date, user_id) values ('{$text}', {$status}, now(), {$user_id}) returning id";
        return $this->db->query($sql)->fetchObject();
    }

    public function update(int $id, string $text, int $status)
    {
        $sql = "update questions set text = '{$text}', published = {$status}, date = now() where id = {$id}";
        $this->db->query($sql);
    }

    public function delete(int $id)
    {
        $sql = "delete from questions where id = {$id}";
        $this->db->query($sql);
    }
}