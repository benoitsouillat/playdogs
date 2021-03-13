<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Dog;

class DogFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++ ){
            $dog = new Dog();
            $dog->setName("Chien n°$i")
                ->setRace("<p>Race de chien n°$i</p>")
                ->setOwner("Mr et Mme $i")
                ->setCreatedAt(new \DateTime());

            $manager->persist($dog);

        }

        $manager->flush();
    }
}
