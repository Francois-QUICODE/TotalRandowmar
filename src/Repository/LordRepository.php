<?php

namespace App\Repository;

use App\Entity\Lord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lord|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lord|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lord[]    findAll()
 * @method Lord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lord::class);
    }

    // /**
    //  * @return Lord[] Returns an array of Lord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lord
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
