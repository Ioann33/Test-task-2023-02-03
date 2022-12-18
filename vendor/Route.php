<?php


class Route
{
    static public function init(){
        $uri = $_SERVER['REQUEST_URI'];
        $uriComponents = explode('/', $uri);
        array_shift($uriComponents);
        if (count($uriComponents)>3){
            self::notFound();
        }
        $controllerName = 'IndexController';
        $action = 'index';
        if (!empty($uriComponents[0])){
            $controllerName = mb_strtolower(urldecode($uriComponents[0])).'Controller';
        }
        if (!empty($uriComponents[1])){
            $action = mb_strtolower(urldecode($uriComponents[1]));
        }
        $controllerClass = '\Controllers\\'.mb_ucfirst($controllerName);
        if (!class_exists($controllerClass)){
            self::notFound();
        }
        $controller = new $controllerClass();
        if (!method_exists($controller, $action)){
            self::notFound();
        }
        try {
            $controller->$action();
        }catch (Exception $e){
            exit($e->getMessage());
        }





    }

    static public function notFound(){
        http_response_code(404);
        //TODO pretty view for 404 status
        exit();
    }

    /**
     * create url by controller and action
     * @param string $controller
     * @param string $action
     * @return string
     */
    static public function url(string $controller = 'index', string $action = 'index', string $saction = '') : string
    {
        if (!empty($saction)){
            return "/$controller/$action/$saction";
        }else{
            return "/$controller/$action";
        }
    }

    /**
     * redirect to URL
     * @param string $url
     */
    static public function redirect(string $url): void
    {
        header("Location: $url");
        exit();
    }

    /**
     * set errors to the session
     * @param array $errors
     */
    static public function addErrors(array $errors): void
    {
        $_SESSION['errors'] = $errors;
    }

    /**
     * @param array $message
     * @return void
     */
    static public function addMessage(array $message): void
    {
        $_SESSION['message'] = $message;
    }

    /**
     * get errors from session
     * @return array
     */
    static public function getErrors() : array
    {
        $errors = [];
        if (isset($_SESSION['errors'])){
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
        return $errors;
    }
}