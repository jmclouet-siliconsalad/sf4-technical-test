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

        $response = $this->getResponseByUsername($username);

        return json_decode($response->getBody())->items;
    }

    /**
     * @param string $username
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkUserExistByUsername(string $username): bool
    {
        if (!$username) {
            return false;
        }

        $response = $this->getResponseByUsername($username);

        return !!json_decode($response->getBody())->total_count;
    }

    /**
     * @param string $username
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getResponseByUsername(string $username)
    {
        $url = 'api.github.com/search/users?q=' . $username;
        return (new \GuzzleHttp\Client())->request('GET', $url);

    }
}
