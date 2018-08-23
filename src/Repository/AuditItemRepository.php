<?php

namespace App\Repository;

use App\Entity\AuditItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AuditItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuditItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuditItem[]    findAll()
 * @method AuditItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditItemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AuditItem::class);
    }

//    /**
//     * @return AuditItem[] Returns an array of AuditItem objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function findOneByIds($audit_id, $item_id, $zone_id, $rayons_magasin_id ): ?AuditItem
    {
        return $this->createQueryBuilder('ai')
            ->leftJoin("ai.audit", "a")
            ->leftJoin("ai.item", "i")
            ->leftJoin("ai.zone", "z")
            ->leftJoin("ai.rayonsMagasin", "rm")
            ->andWhere('a.id = :audit_id')
            ->andWhere('i.id = :item_id')
            ->andWhere('z.id = :zone_id')
            ->andWhere('rm.id = :rayons_magasin_id')
            ->setParameter('audit_id', $audit_id)
            ->setParameter('item_id', $item_id)
            ->setParameter('zone_id', $zone_id)
            ->setParameter('rayons_magasin_id', $rayons_magasin_id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
