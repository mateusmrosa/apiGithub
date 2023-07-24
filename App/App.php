<?php

namespace App;

use App\Controllers\GitHubRepositoryController;
use App\Services\GitHubRepositoryService;
use App\Entities\GitHubRepository;

class App
{
    private $controller;
    private $controllerFile;
    private $action;
    private $params;
    public  $controllerName;
    private $gitHubRepositoryController;

    public function __construct()
    {
        define('APP_HOST', $_SERVER['HTTP_HOST'] . '/apiGithub');
        define('PATH', realpath('./'));
        define('TITLESITE', "Api Github");
        define('TOKEN', "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");
        define('USERNAME', "mateusmrosa");

        $this->url();

        $gitHubRepository = new GitHubRepository(TOKEN, USERNAME);
        $gitHubRepositoryService = new GitHubRepositoryService($gitHubRepository);

        $this->gitHubRepositoryController = new GitHubRepositoryController($gitHubRepositoryService);
    }

    public function run()
    {
        if ($this->controller) {
            $this->controllerName = ucwords($this->controller) . 'Controller';
            $this->controllerName = preg_replace('/[^a-zA-Z]/i', '', $this->controllerName);
        } else {
            $this->controllerName = "GitHubRepositoryController";
        }

        $this->controllerFile   = $this->controllerName . '.php';
        $this->action           = preg_replace('/[^a-zA-Z]/i', '', $this->action);

        if (!$this->controller) {
            $this->gitHubRepositoryController->index();
        }
    }

    public function url()
    {

        if (isset($_GET['url'])) {

            $path = $_GET['url'];
            $path = rtrim($path, '/');
            $path = filter_var($path, FILTER_SANITIZE_URL);

            $path = explode('/', $path);

            $this->controller  = $this->verificaArray($path, 0);
            $this->action      = $this->verificaArray($path, 1);

            if ($this->verificaArray($path, 2)) {
                unset($path[0]);
                unset($path[1]);
                $this->params = array_values($path);
            }
        }
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    private function verificaArray($array, $key)
    {
        if (isset($array[$key]) && !empty($array[$key])) {
            return $array[$key];
        }
        return null;
    }
}
