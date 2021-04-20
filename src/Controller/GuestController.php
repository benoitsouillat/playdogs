<?php

namespace App\Controller;

use App\Entity\Price;
use App\Entity\Contact;
use App\Entity\Candidates;
use App\Form\ContactType;
use App\Form\CandidateType;
use App\Notification\ContactNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
            'title' => 'Bienvenue sur Playdog\'s ',
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
    public function contact(Request $request, ContactNotification $notification): Response
    {

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $notification->notify($contact);

            $this->addFlash('success', "Votre message a bien été envoyé ! ");
            return $this->redirectToRoute('home');
        }

        return $this->render('playdogs/contact.html.twig', [
            'title' => 'Nous contacter',
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route ("/postulation", name="postulation")
     */
    public function postulation(EntityManagerInterface $manager, Request $request): Response
    {
        $candidate = new Candidates();
        $form = $this->createForm(CandidateType::class, $candidate);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $candidate->setCreatedAt(new \DateTime());
            $manager->persist($candidate);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('playdogs/postulation.html.twig', [
            'title' => 'Nous Rejoindre',
            'form' => $form->createView(),
        ]);
    }


}
