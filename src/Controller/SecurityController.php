<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("", name="security_")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("", name="homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homepage()
    {
        return $this->redirectToRoute("comment_index");
    }

    /**
     * @Route("/login", name="login")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login()
    {
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/login/check", name="login_check")
     */
    public function loginCheck()
    {
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }
}