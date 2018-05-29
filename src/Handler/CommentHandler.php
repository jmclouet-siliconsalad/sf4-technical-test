<?php

namespace App\Handler;

use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ObjectManager;

class CommentHandler
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param string $username
     * @return Collection
     */
    public function getByUsername(string $username): Collection
    {
        $commentRepository = $this->objectManager->getRepository("App:Comment");

        return new ArrayCollection($commentRepository->findByGitHubUsername($username));
    }

    /**
     * @param array $model
     * @param User $user
     */
    public function create(array $model, User $user): void
    {
        $depotExploded = explode("/", $model['depot']);

        $gitHubUsername = $depotExploded[0];
        $gitHubRepository = $depotExploded[1];

        $comment = (new Comment())
            ->setGitHubUsername($gitHubUsername)
            ->setGitHubRepository($gitHubRepository)
            ->setContent($model['content'])
            ->setUser($user);
        $this->objectManager->persist($comment);

        $this->objectManager->flush();
    }
}
