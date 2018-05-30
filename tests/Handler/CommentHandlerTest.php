<?php

namespace App\Tests\Handler;

use App\Handler\CommentHandler;
use Doctrine\Common\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;

class CommentHandlerTest extends TestCase
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var CommentHandler
     */
    private $commentHandler;

    /**
     * @throws \ReflectionException
     */
    public function setUp()
    {
        parent::setUp();
        $this->objectManager = $this->createMock(ObjectManager::class);
        $this->commentHandler = new CommentHandler($this->objectManager);
    }

    public function testConstruct()
    {
        $this->assertInstanceOf(CommentHandler::class, $this->commentHandler);
    }

    public function testEmptyUsername()
    {
        $users = $this->commentHandler->getByUsername("");

        $this->assertEquals(null, $users);
    }
}
