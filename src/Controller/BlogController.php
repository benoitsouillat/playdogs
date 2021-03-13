<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Dog;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Dog::class);
        $dogs = $repo->findAll();

        return $this->render('playdogs/admin.html.twig',[
            'title' => 'Se connecter',
            'dogs' => $dogs
        ]);
    }

    /**
     * @Route("/admin/new", name="dog_create")
     */

    public function createDog(Request $request) {

        $dog = new Dog();
        $manager = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder($dog)
                    ->add('name')
                    ->add('race')
                    ->add('owner')
                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $dog->setCreatedAt(new \DateTime());

            $manager->persist($dog);
            $manager->flush();

            return $this->redirectToRoute('dog_create');
        }

        return $this->render('playdogs/create.html.twig', [
            'formDog' => $form->createView(),
            'title' => 'Ajouter un chien',
        ]);
    }

    /**
     * @Route ("/admin/{id}", name="search")
     */
    public function search($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Dog::class);
        $dog = $repo->find($id);

        return $this->render('playdogs/search.html.twig', [
            'title' => 'Recherche : '. $dog->getName(),
            'dog' => $dog
        ]);

    }


}
