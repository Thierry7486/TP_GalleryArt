<?php

namespace App\Repository;

use App\Entity\PieceOfArt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PieceOfArt|null find($id, $lockMode = null, $lockVersion = null)
 * @method PieceOfArt|null findOneBy(array $criteria, array $orderBy = null)
 * @method PieceOfArt[]    findAll()
 * @method PieceOfArt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PieceOfArtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PieceOfArt::class);
    }

    // /**
    //  * @return PieceOfArt[] Returns an array of PieceOfArt objects
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
    public function findOneBySomeField($value): ?PieceOfArt
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
