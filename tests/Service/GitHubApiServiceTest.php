<?php

namespace App\Tests\Service;

use App\Service\GitHubApiService;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class GitHubApiServiceTest extends TestCase
{
    /**
     * @var GitHubApiService
     */
    private $gitHubApiService;

    public function setUp()
    {
        parent::setUp();
        $this->gitHubApiService = new GitHubApiService();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf(GitHubApiService::class, $this->gitHubApiService);
    }

    /**
     * @throws GuzzleException
     */
    public function testEmptyUsername()
    {
        $users = $this->gitHubApiService->getUsersByUsername("");

        $this->assertEquals([], $users);
    }

    /**
     * @throws GuzzleException
     */
    public function testNotExistsUsername()
    {
        $users = $this->gitHubApiService->getUsersByUsername("aaaaaaaazzzzzzzzzzzdddddd");

        $this->assertEquals([], $users);
    }

    /**
     * @throws GuzzleException
     */
    public function testExistsUsername()
    {
        $users = $this->gitHubApiService->getUsersByUsername("stadline");

        $this->assertNotEquals([], $users);
    }
}
