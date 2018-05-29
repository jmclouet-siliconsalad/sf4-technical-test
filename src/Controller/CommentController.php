<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/comment", name="comment_")
 * @return \Symfony\Component\HttpFoundation\Response
 */
class CommentController extends AbstractController
{
    /**
     * @Route("", name="index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render("comment/index.html.twig", [
            "gitHubUsers" => [
                0 => [
                    "id" => 1,
                    "login" => "JM",
                ]
            ]
        ]);
    }

    /**
     * @Route("/{username}/comment", name="new")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(User $user)
    {
        return $this->render("comment/new.html.twig", [
            "username" => $user->getUsername(),
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create()
    {
        return new Response("Hello3");
    }
}
