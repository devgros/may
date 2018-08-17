<?php

namespace App\Repository;

use App\Entity\RayonsMagasin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RayonsMagasin|null find($id, $lockMode = null, $lockVersion = null)
 * @method RayonsMagasin|null findOneBy(array $criteria, array $orderBy = null)
 * @method RayonsMagasin[]    findAll()
 * @method RayonsMagasin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RayonsMagasinRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RayonsMagasin::class);
    }

//    /**
//     * @return RayonsMagasin[] Returns an array of RayonsMagasin objects
//     */
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
    public function findOneBySomeField($value): ?RayonsMagasin
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
