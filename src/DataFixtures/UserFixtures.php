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
            ->setRoles(['ROLE_ADMIN']);

        $user1 = new User();
        $encoded = $this->encoder->encodePassword($user1, 'mdp');
        $user1->setUsername('Benoit')
            ->setPassword($encoded)
            ->setRoles(['ROLE_ADMIN']);
        // $product = new Product();
        // $manager->persist($product);

        //$userSimple = new User();
        //$userSimple->setUsername('Toiletteur')
    //  ->setPassword($encoded)
//      ->setRoles(['ROLE_USER']);

        $manager->persist($user);
        $manager->persist($user1);
        $manager->flush();
    }
}
