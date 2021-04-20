<?php

namespace App\Controller;

use App\Entity\Price;
use App\Entity\Candidates;
use App\Form\AddPriceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


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

        if(!$price)
        {
            $price = new Price();
        }


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

    /**
     * @Route ("/price/delete/{id}", name="delete_price")
     * @ParamConverter("id", options={"id" = "price_id"})
     */
    public function deletePrice(Price $price, EntityManagerInterface $manager)
    {
        $manager->remove($price);
        $manager->flush();

        return $this->redirectToRoute('admin_price');

    }

    /**
     * @Route("/candidate", name="candidate")
     */
    public function showCandidate()
    {
        $repo = $this->getDoctrine()->getRepository(Candidates::class);
        $candidates = $repo->findBy(
            array(),
            array('created_at' => 'DESC')
        );

        return $this->render('administration/candidate.html.twig', [
            'title' => 'Les Candidatures',
            'candidates' => $candidates,
        ]);
    }
    /**
     * @Route ("/candidate/delete/{id}", name="delete_candidate")
     * @ParamConverter("id", options={"id" = "candidates_id"})
     */
    public function deleteCandidate(EntityManagerInterface $manager, Candidates $candidates): Response
    {
        $manager->remove($candidates);
        $manager->flush();

        return $this->redirectToRoute('admin_candidate');

    }



}
