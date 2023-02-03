<?php

namespace Models;

class UserModel
{
    public function getUsers(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Alex Bit',
                'email' => 'alex@gmail.com'
            ],
            [
                'id' => 2,
                'name' => 'Ioann Kar',
                'email' => 'ioann@gmail.com'
            ],
            [
                'id' => 3,
                'name' => 'Jon Jonovich',
                'email' => 'jon@gmail.com'
            ],
        ];
    }

    public function getUserByEmail(string $email): bool
    {
        foreach ($this->getUsers() as $user){
            if ($user['email'] === $email){
                return true;
            }
        }
        return false;
    }
}