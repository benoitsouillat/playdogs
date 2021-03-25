<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request): Response
    {
        return $this->render('administration/login.html.twig',[
            'title' => 'Se connecter',
        ]);
    }

    /**
     * @Route("/admin/inscription", name="admin_inscription")
     */
    public function inscription(UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager, Request $request): Response
    {

        $repo = $this->getDoctrine()->getRepository(User::class);
        $lists = $repo->findAll();


        $user = new User();

        $form = $this->createForm(InscriptionType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $encoded = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($encoded);

            $manager->persist($user);
            $manager->flush();
        }

        return $this->render('administration/inscription.html.twig', [
            'title' => 'Inscrire',
            'form' => $form->createView(),
            'lists' => $lists,
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {}
}
