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
     * @param GitHubApiService $gitHubApiService
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function new(Request $request, CommentHandler $commentHandler, GitHubApiService $gitHubApiService)
    {
        $error = null;
        $username = $request->get("username");

        $comment = new CommentModel();
        $comment->depot = $username . "/";

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($gitHubApiService->checkUserExistByUsername($username)) {
                $commentHandler->create($comment->toArray(), $this->getUser());
            } else {
                $error = "User doesn't exist.";
            }
        }

        return $this->render('comment/new.html.twig', [
            'form' => $form->createView(),
            'comments' => $commentHandler->getByUsername($username),
            'error' => $error,
        ]);
    }
}
