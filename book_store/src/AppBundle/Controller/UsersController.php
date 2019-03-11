<?php

// src/AppBundle/Controller/UserController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UsersController extends BaseController
{
    /**
     * @Route("/login")
     */
    public function LoginAction()
    {
        if (!$this->getUser())
            return $this->redirectToRoute('login');
    }
}