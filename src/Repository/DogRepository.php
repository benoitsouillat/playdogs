<?php

namespace App\Repository;

use App\Entity\Dog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dog[]    findAll()
 * @method Dog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dog::class);
    }
    public function findByName()
    {
        return $this->createQueryBuilder('d')
                ->orderBy('d.name', 'ASC')
                ->getQuery()
                ->getResult()
                ;
    }

    public function findByOwner()
    {
        return $this->createQueryBuilder('d')
                ->orderBy('d.owner', 'ASC')
                ->getQuery()
                ->getResult()
                ;
    }

    public function findSearch($value)
    {
        return $this->createQueryBuilder('d')
                    ->andWhere('d.race = :val')
                    ->setParameter('val', $value)
                    ->orderBy('d.name', 'ASC')
                    ->getQuery()
                    ->getResult()
                    ;
    }

    // /**
    //  * @return Dog[] Returns an array of Dog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dog
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
