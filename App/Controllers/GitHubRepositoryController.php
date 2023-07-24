<?php

namespace App\Controllers;

use App\Services\GitHubRepositoryService;

class GitHubRepositoryController extends Controller
{
    private $gitHubRepositoryService;

    public function __construct(GitHubRepositoryService $gitHubRepositoryService)
    {
        $this->gitHubRepositoryService = $gitHubRepositoryService;
    }

    public function index()
    {
        $repositories = $this->gitHubRepositoryService->getRepositories();
       
        self::setViewParam("repositories", $repositories);
        $this->render('/githubrepository/index');
    }
}
