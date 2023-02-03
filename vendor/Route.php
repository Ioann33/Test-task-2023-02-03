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

}