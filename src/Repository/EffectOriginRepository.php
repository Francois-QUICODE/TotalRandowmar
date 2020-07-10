<?php

namespace App\Repository;

use App\Entity\EffectOrigin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EffectOrigin|null find($id, $lockMode = null, $lockVersion = null)
 * @method EffectOrigin|null findOneBy(array $criteria, array $orderBy = null)
 * @method EffectOrigin[]    findAll()
 * @method EffectOrigin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EffectOriginRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EffectOrigin::class);
    }

    // /**
    //  * @return EffectOrigin[] Returns an array of EffectOrigin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EffectOrigin
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
