<?php

namespace App\Repository;

use App\Entity\RequestService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RequestService|null find($id, $lockMode = null, $lockVersion = null)
 * @method RequestService|null findOneBy(array $criteria, array $orderBy = null)
 * @method RequestService[]    findAll()
 * @method RequestService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequestServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RequestService::class);
    }

    // /**
    //  * @return RequestService[] Returns an array of RequestService objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RequestService
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
