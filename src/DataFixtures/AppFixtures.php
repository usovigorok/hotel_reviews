<?php
/**
 * Created by IntelliJ IDEA.
 * User: igor
 * Date: 15.12.17
 * Time: 17:57
 */

namespace App\DataFixtures;


use App\Entity\Hotel;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $hotel = new Hotel();
        $hotel->setName('Main Hotel');
        $hotel->setUiid('12345');

        $review1 = new Review();
        $review1->setCreatedDate(new \DateTime());
        $review1->setHotel($hotel);
        $review1->setRating(90);

        $review2 = new Review();
        $review2->setCreatedDate(new \DateTime());
        $review2->setHotel($hotel);
        $review2->setRating(80);

        $hotel->setReviews(new ArrayCollection([
            $review1, $review2
        ]));

        $manager->persist($review1);
        $manager->persist($review2);
        $manager->persist($hotel);
        $manager->flush();
    }
}