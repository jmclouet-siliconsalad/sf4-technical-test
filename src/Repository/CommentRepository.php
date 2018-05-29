<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CommentRepository
 * @package App\Repository
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * @param string $gitHubUsername
     * @return array
     */
    public function findByGitHubUsername(string $gitHubUsername): array
    {
        return $this->findBy([
            "gitHubUsername" => $gitHubUsername
        ]);
    }
}
