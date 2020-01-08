<?php

namespace App\Repository;

use App\Entity\ListeIndicatifs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ListeIndicatifs|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeIndicatifs|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeIndicatifs[]    findAll()
 * @method ListeIndicatifs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeIndicatifsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeIndicatifs::class);
    }

    // /**
    //  * @return ListeIndicatifs[] Returns an array of ListeIndicatifs objects
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
    public function findOneBySomeField($value): ?ListeIndicatifs
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
