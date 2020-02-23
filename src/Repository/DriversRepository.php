<?php

namespace App\Repository;

use App\Entity\Drivers;
use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Drivers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Drivers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Drivers[]    findAll()
 * @method Drivers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DriversRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Drivers::class);
    }

    // /**
    //  * @return Drivers[] Returns an array of Drivers objects
    //  */
    public function fetchAll() {
        return $this->findAll();
    }

    public function findDriver($value)
    {
        return $this->createQueryBuilder('d')
            ->join(Team::class, 'name','d.team_id = t.id')
            ->andWhere('d.Name LIKE :val')
            ->orWhere('d.Surname LIKE :val')
            ->setParameter('val', $value."%")
            ->orderBy('d.Surname', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findDriverOfNat($nat)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.Nationality LIKE :nat')
            ->setParameter('nat', $nat)
            ->orderBy('d.Surname', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?Drivers
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
