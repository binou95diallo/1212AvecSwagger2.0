<?php

namespace App\Repository;

use App\Entity\TypeLocalite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeLocalite|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeLocalite|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeLocalite[]    findAll()
 * @method TypeLocalite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeLocaliteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeLocalite::class);
    }

    // /**
    //  * @return TypeLocalite[] Returns an array of TypeLocalite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeLocalite
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
