<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
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
