<?php

namespace App\Repository;

use App\Entity\TroopBuilding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TroopBuilding|null find($id, $lockMode = null, $lockVersion = null)
 * @method TroopBuilding|null findOneBy(array $criteria, array $orderBy = null)
 * @method TroopBuilding[]    findAll()
 * @method TroopBuilding[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TroopBuildingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TroopBuilding::class);
    }

    public function BorrarAllRecords(){
        return $this->getEntityManager()
                            ->createQuery('DELETE App\Entity\TroopBuilding')                             
                            ->getResult();
       }


    // /**
    //  * @return TroopBuilding[] Returns an array of TroopBuilding objects
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
    public function findOneBySomeField($value): ?TroopBuilding
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
