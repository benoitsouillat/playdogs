<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(): Response
    {
        return $this->render('playdogs/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('playdogs/home.html.twig', [
            'title' => 'Bienvenue sur le site Playdog\'s ',
        ]);
    }
    /**
     * @Route("/price", name="price")
     */
    public function price(): Response
    {
        return $this->render('playdogs/price.html.twig', [
            'title' => 'Retrouvez nos tarifs',
        ]);
    }
    /**
     * @Route("/rdv", name="rdv")
     */
    public function rdv(): Response
    {
        return $this->render('playdogs/rdv.html.twig', [
            'title' => 'Prendre Rendez-vous',
        ]);
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('playdogs/contact.html.twig', [
            'title' => 'Nous contacter',
        ]);
    }

}
