<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Entity\User;
use App\Form\ClientType;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ManageController extends AbstractController
{

    /**
     * @Route("/manage", name="manage")
     * @ParamConverter("search", options={"search" = "search"})
     */
    public function manage(Request $request, ?String $value): Response
    {

        $repo = $this->getDoctrine()->getRepository(Dog::class);

        // $dogs = $repo->findByBreed(); // Pour trier par race
        // $breed = $this->createForm(SearchType::class, $value);
        $search = $request->getQueryString();
        if (!$search)
        {
            $dogs = $repo->findByName();
        }
        elseif ($search == 'search=owner')
        {
            $dogs = $repo->findByOwner();
        }
        //elseif ($search == 'search='.$value)
        //{
        //    $dogs = $repo->findSearch($value);
        //}
        else {
            $dogs = $repo->findByName();
        }

        return $this->render('administration/manage.html.twig', [
            'title' => 'Gestion des clients',
            'dogs' => $dogs,
            //'breed' => $breed->createView(),
            ]);
        }
        
    /**
     * @Route ("/manage/delete/{id}", name="dog_delete")
     */
    public function deleteClient(EntityManagerInterface $manager, Dog $dog): Response
    {
        $manager->remove($dog);
        $manager->flush();

        return $this->redirectToRoute('manage');
    }

    /**
     * @Route("/manage/number", name="dog_number")
     */
    public function searchNumber(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Dog::class);
        $dogs = $repo->findBy(
            array(),
            array('name' => 'ASC'),
        );

        return $this->render('administration/number.html.twig', [
            'title' => 'Rechercher un numéro',
            'dogs' => $dogs,
        ]);

    }

    /**
     * @Route("/manage/new", name="dog_create")
     * @Route ("/manage/{id}", name="dog_edit")
     */

    public function createDog(EntityManagerInterface $manager, Request $request, Dog $dog = null): Response 
    {
        if(!$dog)
        {
            $dog = new Dog();
            $search = 0;
            $dog->setFilename('oupsss.jpg');  // Défini une image par defaut 
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
            $proprio = $dog->getOwner();
            $dogName = $dog->getName();

            $repo = $this->getDoctrine()->getRepository(Dog::class);
            $owners = $repo->findBy(
                array('owner' => $proprio),
                array('id' => 'DESC')
            );
            $dogNames = $repo->findBy(
                array('name' => $dogName),
                array('id' => 'DESC')
            );
            if ($owners && $dogNames)
            {
                foreach ($owners as $owner)
                {
                    foreach ($dogNames as $dName)
                    {
                        if ($dName->getId() == $owner->getId() && $dName->getId() != $dog->getId())
                        {
                            dump($dName->getId());
                            dump($dog->getId());
                            return $this->render('administration/create.html.twig', [
                                'formDog' => $form->createView(),
                                'title' => 'Erreur : CE CHIEN EXISTE DEJA',
                                'dog' => $search,
                            ]);
                        }
                    }
                }
                $dog->setCreatedAt(new \DateTime());
                $manager->persist($dog);
                $manager->flush();
                
                return $this->redirectToRoute('manage');
            }
            else {
                $dog->setCreatedAt(new \DateTime());
                $manager->persist($dog);
                $manager->flush();
                
                return $this->redirectToRoute('manage');
            }
        }

        return $this->render('administration/create.html.twig', [
            'formDog' => $form->createView(),
            'title' => 'Gérer un chien',
            'dog' => $search,
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
