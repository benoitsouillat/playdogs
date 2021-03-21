<?php

namespace App\Controller;

use App\Entity\Price;
use App\Form\AddPriceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
* @Route("/admin", name="admin_")
*/

class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function admin(): Response
    {
        return $this->render('administration/admin.html.twig', [
            'title' => 'Administration',
        ]);
    }
    /**
     * @Route("/price", name="price")
     * @Route("/price/{id}", name="editprice")
     */
    public function addPrice(Price $price = null, EntityManagerInterface $manager, Request $request): Response
    {


        $form = $this->createForm(AddPriceType::class, $price);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($price);
            $manager->flush();
        }
        $repo = $this->getDoctrine()->getRepository(Price::class);
        $values = $repo->findBy(
            array(),
            array('race' => 'ASC')
        );
        
        return $this->render('administration/add_price.html.twig', [
            'form' => $form->createView(),
            'title' => 'Gérer les prix',
            'price' => $price,
            'values' => $values,
        ]);
    
    }
}
