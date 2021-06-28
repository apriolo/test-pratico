<?php

use Arca\CompanyBundle\Entity\Company;
use Faker\Factory;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../app/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
//$response->send();
$kernel->terminate($request, $response);

$container = $kernel->getContainer();
$em = $container->get('doctrine')->getEntityManager();
$faker = Factory::create();

$query = $em->createQuery('SELECT MAX(c.id) FROM Arca\CategoryBundle\Entity\Category c');
$max = (INT) $query->getResult()[0][1];
$query = $em->createQuery('SELECT MIN(c.id) FROM Arca\CategoryBundle\Entity\Category c');
$min = (INT) $query->getResult()[0][1];


$company = new Company();
$company->setTitle($faker->company);
$company->setTelephone($faker->phoneNumber);
$company->setAddress($faker->address);
$company->setPostalcode($faker->postcode);
$company->setDescription($faker->text(20));
$company->setState($faker->state);
$company->setCity($faker->city);

$category = $em->getRepository("CategoryBundle:Category")->find(rand($min,$max));

if ($category && !$company->hasCategory($category)) {
    $company->getCategories()->add($category);
}
$em->persist($company);

$em->flush();

echo "teste";
exit();
