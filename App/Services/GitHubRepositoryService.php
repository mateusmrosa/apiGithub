<?php

namespace App\Services;

use App\Entities\GitHubRepository;

class GitHubRepositoryService
{
    private $gitHubRepository;

    public function __construct(GitHubRepository $gitHubRepository)
    {
        $this->gitHubRepository = $gitHubRepository;
    }

    public function getRepositories()
    {
        $token = $this->gitHubRepository->getToken();
        $username = $this->gitHubRepository->getUsername();

        $url = "https://api.github.com/users/{$username}/repos";
        $headers = array(
            "Authorization: token {$token}",
            "User-Agent: PHP"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $repositories = json_decode($response, true);
        return $repositories;
    }
}
