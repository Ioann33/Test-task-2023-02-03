<?php
namespace Facade;
class Auth
{
    public static function User(){
        if (isset($_SESSION['auth_user'])){
            return $_SESSION['auth_user'];
        }else{
            return null;
        }
    }
}