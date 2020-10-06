<?php

namespace App\Repository;

use App\Entity\Drivers;
use App\Entity\Team;
use App\Entity\Podiums;
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
        return $this->createQueryBuilder('d')
            ->select('d.id','d.Name','d.Surname','d.Number','d.Nationality','d.PolePositions','d.Points','d.Apperances','t.NameTeam',
                'p.FirstPlaces','p.SecondPlaces','p.ThirdPlaces')
            ->join(Team::class, 't','WITH','d.Team = t.id')
            ->join(Podiums::class, 'p','WITH','p.driver = d.id')
            ->distinct()
            ->getQuery()
            ->getResult()
            ;
    }

    public function findDriver($value)
    {
        return $this->createQueryBuilder('d')
            ->select('d.Surname','d.Name','d.Number','p.id')
            ->join(Team::class, 't','WITH','d.Team = t.id')
            ->join(Podiums::class, 'p','WITH','p.driver = d.id')
            ->andWhere('d.Name LIKE :val')
            ->orWhere('d.Surname LIKE :val')
            ->setParameter('val', $value."%")
            ->orderBy('d.Surname', 'ASC')
            ->distinct()
            ->getQuery()
            ->getResult()
        ;
    }
    public function findDriverOfNat($nat)
    {
        return $this->createQueryBuilder('d')
            ->select('d.id','d.Name','d.Surname','t.NameTeam','d.Number','d.Nationality')
            ->join(Team::class, 't','WITH','d.Team = t.id')
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
