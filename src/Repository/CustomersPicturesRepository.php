<?php

namespace App\Repository;

use App\Entity\CustomersPictures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CustomersPictures|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomersPictures|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomersPictures[]    findAll()
 * @method CustomersPictures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomersPicturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomersPictures::class);
    }

    // /**
    //  * @return CustomersPictures[] Returns an array of CustomersPictures objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CustomersPictures
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
