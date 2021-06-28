<?php


namespace Arca\CategoryBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Arca\CategoryBundle\Entity\Category;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Faker\Factory;


class LoadCategories implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $catsDefault = ['Auto','Beauty and Fitness', 'Entertainment', 'Food and Dining', 'Health', 'Sports', 'Travel'];

        foreach ($catsDefault as $cat) {
            $category  = new Category();
            $category->setTitle($cat);
            $manager->persist($category);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}