<?php


namespace Controllers;

use Core\View;

abstract class Controller
{
    /**
     * @var View
     */
    public $view;
    public function __construct()
    {
        $this->view = new View();
    }
}