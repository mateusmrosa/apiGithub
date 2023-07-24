<?php

namespace App\Entities;

class GitHubRepository
{
    private $token;
    private $username;
    public function __construct($token, $username)
    {
        $this->token = $token;
        $this->username = $username;
    }
    public function getToken()
    {
        return $this->token;
    }
    public function getUsername()
    {
        return $this->username;
    }
}
