<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;

class GithubApiService
{
    private $client;
    private $username;
    private $token;

    public function __construct(
        HttpClientInterface $client, 
        string $githubUsername,
        string $githubToken
    ) {
        $this->client = $client;
        $this->username = $githubUsername;
        $this->token = $githubToken;
    }

    public function fetchRepositories(bool $includePrivate = false): array
    {
        $url = "https://api.github.com/user/repos";
        $query = [
            'affiliation' => 'owner',
            'visibility' => $includePrivate ? 'all' : 'public',
            'sort' => 'updated',
            'direction' => 'desc'
        ];

        $response = $this->client->request(
            'GET', 
            $url,
            [
                'headers' => [
                    'Authorization' => "token {$this->token}",
                    'Accept' => 'application/vnd.github.v3+json',
                ],
                'query' => $query
            ]
        );

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new \Exception('Erreur API GitHub : '.$response->getContent(false));
        }

        return $response->toArray();
    }
}
