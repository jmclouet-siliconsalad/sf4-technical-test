<?php

namespace App\Controller;

use App\Form\CommentType;
use App\Handler\CommentHandler;
use App\Model\CommentModel;
use App\Service\GitHubApiService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/comment", name="comment_")
 * @return \Symfony\Component\HttpFoundation\Response
 */
class CommentController extends AbstractController
{
    /**
     * @Route("", name="index")
     * @param Request $request
     * @param GitHubApiService $gitHubApiService
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(Request $request, GitHubApiService $gitHubApiService)
    {
        $users = [];
        $username = $request->query->get("username");

        if ($request->query->has("username") && "" != $username) {
            $users = $gitHubApiService->getUsersByUsername($username);
        };

        return $this->render("comment/index.html.twig", [
            "gitHubUsers" => $users,
        ]);
    }

    /**
     * @Route("/{username}/comment", name="new")
     * @param Request $request
     * @param CommentHandler $commentHandler
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request, CommentHandler $commentHandler)
    {
        $comment = new CommentModel();
        $comment->depot = $request->get("username") . "/";

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentHandler->create($comment->toArray(), $this->getUser());
        }

        return $this->render('comment/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
