<?php

namespace App\Repository;

use App\Entity\Entreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Entreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entreprise[]    findAll()
 * @method Entreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entreprise::class);
    }
    public function  searchbis($nom,$region,$domaine){
        return $this->createQueryBuilder('e')
        ->leftJoin('e.localite', 'l')
        ->leftJoin('l.type_localite', 't')
        ->leftJoin('e.domaine', 'd')    
        ->where("e.nom LIKE :nom ")
            ->orWhere('l.libelle  LIKE :region')
            ->orWhere('d.nom  LIKE :domaine')
            ->andWhere('t.id  =:id')
	        ->setParameter('nom', '%'.$nom.'%')
            ->setParameter('region', '%'.$region.'%')
            ->setParameter('domaine', '%'.$domaine.'%')
            ->setParameter('id', 1)
	        ->getQuery()
	        ->getResult();
    }
    public function  search($nom,$region,$domaine){
        $query = $this->createQueryBuilder('e') 
        ->leftJoin('e.localite', 'l')
        ->leftJoin('l.type_localite', 't')
        ->leftJoin('e.domaine', 'd')   
        ->where("e.nom LIKE :nom ")
	    ->setParameter('nom', '%'.$nom.'%');
        if($region!=null){
         $query->andWhere('l.libelle  LIKE :region')
               ->andWhere('t.id  =:id')
               ->setParameter('region', '%'.$region.'%')
               ->setParameter('id', 1);
        }
        if($domaine!=null){
            $query->andWhere('d.nom  LIKE :domaine')
                     ->setParameter('domaine', '%'.$domaine.'%');
           }
         return $query->getQuery()
                  ->getResult();
    }
    
}
