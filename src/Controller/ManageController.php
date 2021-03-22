<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Entity\User;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;
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
        $dogs = $repo->findBy(
            array(),
            array('name' => 'ASC'),
        );

        return $this->render('administration/manage.html.twig', [
            'title' => 'Gestion des clients',
            'dogs' => $dogs,
        ]);
    }


    /**
     * @Route("/manage/new", name="dog_create")
     * @Route ("/manage/{id}", name="dog_edit")
     */

    public function createDog(EntityManagerInterface $manager, Request $request, Dog $dog = null): Response {


        
        if(!$dog)
        {
            $dog = new Dog();
            $search = 0;
        }
        else {
            $id = $dog->getId();
            $repo = $this->getDoctrine()->getRepository(Dog::class);
            $search = $repo->find($id);
        }
        
        $form = $this->createForm(ClientType::class, $dog);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $dog->setCreatedAt(new \DateTime());
            $manager->persist($dog);
            $manager->flush();

            return $this->redirectToRoute('dog_edit', ['id' => $dog->getId()]);
        }

        return $this->render('administration/create.html.twig', [
            'formDog' => $form->createView(),
            'title' => 'Gérer un chien',
            'dog' => $search
        ]);
    }


    
    /**
     * @Route("/search/{id}", name="search")
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
