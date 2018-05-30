<?php

namespace App\Service;

class GitHubApiService
{
    /**
     * @param string $username
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUsersByUsername(string $username): array
    {
        if (!$username) {
            return [];
        }

        $url = 'api.github.com/search/users?q=' . $username;
        $response = (new \GuzzleHttp\Client())->request('GET', $url);

        return json_decode($response->getBody())->items;
    }
}
