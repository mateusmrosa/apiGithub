<?php

namespace App\Controllers;

abstract class Controller
{
    protected $app;
    private $viewVar;
    public function __construct($app)
    {
        $this->setViewParam('nameController', $app->getControllerName());

        $this->setViewParam('nameAction', $app->getAction());
    }
    public function render($view)
    {
        $viewVar   = $this->getViewVar();
        require_once PATH . '/App/Views/' . $view . '.php';
    }
    public function getViewVar()
    {
        return $this->viewVar;
    }
    public function setViewParam($varName, $varValue)
    {
        if ($varName != "" && $varValue != "") {

            $this->viewVar[$varName] = $varValue;
        }
    }
}
