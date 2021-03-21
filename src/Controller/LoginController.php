<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request): Response
    {


        return $this->render('administration/login.html.twig',[
            'title' => 'Se connecter',
        ]);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(): Response
    {
        //Si inscriptions nécessaires pour sécuriser les mdp
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {}
}
