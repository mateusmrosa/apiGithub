<?php

class GitHubRepositorie {
    private $token;

    public function __construct($token) {
        $this->token = $token;
    }

    public function getRepositories($username) {
        $url = "https://api.github.com/users/{$username}/repos";
        $headers = array(
            "Authorization: token {$this->token}",
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

    public function displayRepositories($username) {
        $repositories = $this->getRepositories($username);

        if (empty($repositories)) {
            echo "<h3>Nenhum repositório encontrado para o usuário {$username}.</h3>";
            return;
        }

        echo "<h1 class='mb-4'>Repositórios de {$username}</h1>";
        echo "<div class='list-group'>";
        foreach ($repositories as $repo) {
            echo "<a href='{$repo['html_url']}' class='list-group-item list-group-item-action'>";
            echo "<h5 class='mb-1'>Nome: {$repo['name']}</h5>";
            echo "<p class='mb-1'>Descrição: {$repo['description']}</p>";
            echo "<p class='mb-1'>Número de estrelas: {$repo['stargazers_count']}</p>";
            echo "<p class='mb-1'>Url: {$repo['git_url']}</p>";
            echo "<p class='mb-1'>Data de Criação: {$repo['created_at']}</p>";
            echo "</a>";
        }
        echo "</div>";
    }
}

$token = "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"; 
$username = "mateusmrosa";

$repoViewer = new GitHubRepositorie($token);
$repoViewer->displayRepositories($username);
