<?php

namespace App\Repository;

use App\Entity\ParcFixe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ParcFixe|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParcFixe|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParcFixe[]    findAll()
 * @method ParcFixe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParcFixeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParcFixe::class);
    }

    // /**
    //  * @return ParcFixe[] Returns an array of ParcFixe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParcFixe
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
