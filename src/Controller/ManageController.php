<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Entity\Prestations;
use App\Entity\User;
use App\Form\ClientType;
use App\Form\PrestationsType;
use Doctrine\ORM\EntityManager;
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
        if (!$search) {
            $dogs = $repo->findByName();
        } elseif ($search == 'search=owner') {
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
     * @Route("/manage/presta/{id}", name="dog_presta")
     * @paramConverter("id", options={"id" = "dog_id"})
     */
    public function managePresta(EntityManagerInterface $manager, Request $request, Dog $dog): Response
    {

        $dogId = $dog->getId();
        $dogName = $dog->getName();
        $prestation = new Prestations;

        $repo = $this->getDoctrine()->getRepository(Prestations::class);
        $prestaArray = $repo->findBy(
            array(),
            array('date' => 'DESC'),
        );
        dump($prestaArray);
        $form = $this->createForm(PrestationsType::class, $prestation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $prestation->setDate(new \DateTime());
            $prestation->setDog($dog);
            $manager->persist($prestation);
            $manager->flush();

            return $this->redirectToRoute('dog_edit', ['id' => $dogId], 201);
        }

        return $this->render('administration/prestations.html.twig', [

            'title' => 'Créer une prestation de ' . $dogName,
            'dog' => $dog,
            'prestations' => $prestaArray,
            'form' => $form->createView(),


        ]);

        /*
        $var = $dog->getPrestations();
        $dogName = $dog->getName();

        $repo = $this->getDoctrine()->getRepository(Prestations::class);
        $prestations = $repo->findBy(
            array(),
            array('date' => 'DESC'),
        );

        return $this->render('administration/prestations.html.twig', [
            'title' => 'Prestations de '. $dogName,
            'prestations' => $prestations,
            'dog' => $dog,
        ]);
        /*
            /* Il faudra reporter la liste des dernière prestation sur la page manage et se servir de cette page comme AddPresta */
    }


    /**
     * @Route("/manage/new", name="dog_create")
     * @Route ("/manage/{id}", name="dog_edit")
     */

    public function createDog(EntityManagerInterface $manager, Request $request, Dog $dog = null): Response
    {
        if (!$dog) {
            $dog = new Dog();
            $search = 0;
            $dog->setFilename('oupsss.jpg');  // Défini une image par defaut 
        } else {
            $id = $dog->getId();
            $repo = $this->getDoctrine()->getRepository(Dog::class);
            $search = $repo->find($id);
        }

        $form = $this->createForm(ClientType::class, $dog);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
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
            if ($owners && $dogNames)  /* Vérifie si le chien n'a pas déjà été créé */ {
                foreach ($owners as $owner) {
                    foreach ($dogNames as $dName) {
                        if ($dName->getId() == $owner->getId() && $dName->getId() != $dog->getId()) {
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
            } else {
                $dog->setCreatedAt(new \DateTime()); /* Modifie la valeur de CreatedAt pour valider les changements du flush */
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
}
