<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    

    public function load(ObjectManager $manager)
    {

        
        $user = new User();
        $encoded = $this->encoder->encodePassword($user, 'mdp');
        $user->setUsername('Sabine')
            ->setPassword($encoded)
            ->setRole('administrateur');
        // $product = new Product();
        // $manager->persist($product);

        $manager->persist($user);
        $manager->flush();
    }
}
