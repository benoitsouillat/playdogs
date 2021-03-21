<?php

namespace App\Controller;

use App\Entity\Price;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $repo = $this->getDoctrine()->getRepository(Price::class);
        $values = $repo->findBy(
            array(),
            array('race' => 'ASC')
        );
        return $this->render('playdogs/price.html.twig', [
            'title' => 'Retrouvez nos tarifs',
            'values' => $values
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
