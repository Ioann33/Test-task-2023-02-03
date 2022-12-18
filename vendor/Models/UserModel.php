<?php

namespace Models;

class UserModel extends Model
{
    /**
     * @param $email
     * @param $pass
     * @return false|mixed|object|\stdClass|null
     */
    public function create($email, $pass){
        $sql = "insert into users (email, password) values ('$email', '$pass') returning id";
        return $this->db->query($sql)->fetchObject();
    }

    /**
     * @param $email
     * @return false|mixed|object|\stdClass|null
     */
    public function getUserByEmailOrAndPass($email, $pass = ''){
        $sql = "select * from users where email = '$email'";
        if (!empty($pass)){
            $sql .= " and password = '{$pass}'";
        }
        return $this->db->query($sql)->fetchObject();
    }

}