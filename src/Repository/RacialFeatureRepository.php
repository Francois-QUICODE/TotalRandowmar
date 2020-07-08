<?php

namespace App\Repository;

use App\Entity\RacialFeature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RacialFeature|null find($id, $lockMode = null, $lockVersion = null)
 * @method RacialFeature|null findOneBy(array $criteria, array $orderBy = null)
 * @method RacialFeature[]    findAll()
 * @method RacialFeature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RacialFeatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RacialFeature::class);
    }

    // /**
    //  * @return RacialFeature[] Returns an array of RacialFeature objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RacialFeature
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
