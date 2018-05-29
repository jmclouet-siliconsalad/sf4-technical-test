<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Comment
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int The Comment Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The GitHubUsername of Comment
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $gitHubUsername;

    /**
     * @var string The GitHubRepository of Comment
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $gitHubRepository;

    /**
     * @var string The Content of Comment
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $content;

    /**
     * @var User The User of Comment
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     */
    private $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getGitHubUsername(): ?string
    {
        return $this->gitHubUsername;
    }

    /**
     * @param string $gitHubUsername
     * @return Comment
     */
    public function setGitHubUsername(string $gitHubUsername): Comment
    {
        $this->gitHubUsername = $gitHubUsername;
        return $this;
    }

    /**
     * @return string
     */
    public function getGitHubRepository(): ?string
    {
        return $this->gitHubRepository;
    }

    /**
     * @param string $gitHubRepository
     * @return Comment
     */
    public function setGitHubRepository(string $gitHubRepository): Comment
    {
        $this->gitHubRepository = $gitHubRepository;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Comment
     */
    public function setContent(string $content): Comment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Comment
     */
    public function setUser(User $user): Comment
    {
        $this->user = $user;
        return $this;
    }
}
