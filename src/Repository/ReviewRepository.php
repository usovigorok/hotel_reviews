<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function findScoreForHotel($hotel)
    {
        $result = $this->createQueryBuilder('r')
            ->select('AVG(r.rating) as score')
            ->where('r.hotel = :hotel')
            ->setParameter('hotel', $hotel)
            ->getQuery()
            ->getResult();

        return $result[0]['score'];
    }
}
