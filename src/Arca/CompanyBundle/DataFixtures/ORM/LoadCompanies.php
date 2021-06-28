<?php


namespace Arca\CompanyBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Arca\CompanyBundle\Entity\Company;
use Faker\Factory;
use Faker\Generator;

class LoadCompanies implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * @var Generator
     */
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        // Recuperando min e max das categorias para inserir randomico
        $query = $manager->createQuery('SELECT MAX(c.id) FROM Arca\CategoryBundle\Entity\Category c');
        $max = (INT) $query->getResult()[0][1];
        $query = $manager->createQuery('SELECT MIN(c.id) FROM Arca\CategoryBundle\Entity\Category c');
        $min = (INT) $query->getResult()[0][1];

        for ($aux = 0; $aux <= 10; $aux++) {
            $company = new Company();
            $company->setTitle($this->faker->company);
            $company->setTelephone($this->faker->phoneNumber);
            $company->setAddress($this->faker->address);
            $company->setPostalcode($this->faker->postcode);
            $company->setDescription($this->faker->text(20));
            $company->setState($this->faker->state);
            $company->setCity($this->faker->city);

            $category = $manager->getRepository("CategoryBundle:Category")->find(rand($min,$max));

            if ($category) {
                $company->getCategories()->add($category);
            }

            $manager->persist($company);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 20;
    }

}