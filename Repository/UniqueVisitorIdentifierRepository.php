<?php

namespace GaylordP\UniqueVisitorIdentifierBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use GaylordP\UniqueVisitorIdentifierBundle\Entity\UniqueVisitorIdentifier;

class UniqueVisitorIdentifierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UniqueVisitorIdentifier::class);
    }

    public function findByAntiFlood(string $ip, \DateTime $date): ?UniqueVisitorIdentifier
    {
        return $this
            ->createQueryBuilder('uvi')
            ->andWhere('uvi.remoteAddr = :ip')
            ->andWhere('uvi.antiFloodDate >= :date')
            ->setParameter('ip', $ip)
            ->setParameter('date', $date)
            ->orderBy('uvi.id', 'DESC')
            ->setMaxResults(1)
            ->select('uvi')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
