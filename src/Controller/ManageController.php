<?php

namespace App\Controller;

use App\Entity\Dog;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManageController extends AbstractController
{

    /**
     * @Route("/manage", name="manage")
     */
    public function manage(): Response
    {

        $repo = $this->getDoctrine()->getRepository(Dog::class);
        $dogs = $repo->findAll();

        return $this->render('administration/manage.html.twig', [
            'title' => 'Gestion des clients',
            'dogs' => $dogs
        ]);
    }

    /**
     * @Route("/manage/new", name="dog_create")
     */

    public function createDog(Request $request): Response {

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

            return $this->redirectToRoute('manage');
        }

        return $this->render('administration/create.html.twig', [
            'formDog' => $form->createView(),
            'title' => 'Ajouter un chien',
        ]);
    }



    /**
     * @Route ("/manage/{id}", name="search")
     */
    public function search($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Dog::class);
        $dog = $repo->find($id);

        return $this->render('administration/search.html.twig', [
            'title' => 'Recherche : '. $dog->getName(),
            'dog' => $dog
        ]);
    }
}
