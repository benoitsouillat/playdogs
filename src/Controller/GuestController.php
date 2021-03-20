<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuestController extends AbstractController
{
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
    /**
     * @Route ("/postulation", name="postulation")
     */
    public function postulation(): Response
    {
        return $this->render('playdogs/postulation.html.twig', [
            'title' => 'Nous Rejoindre'
        ]);
    }


}
