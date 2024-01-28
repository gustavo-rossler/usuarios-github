<?php

namespace Inklo\Repositories;

use GuzzleHttp\Client;

class GithubUsersRepository implements IGithubUsersRepository
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.github.com/users/',
            'timeout'  => 5.0,
        ]);
    }

    /**
     * @param string $username
     * @return string
     */
    public function fetchUser(string $username): string
    {
        $response = $this->client->request('GET', $username);
        $body = $response->getBody();
        return $body;
    }
}
