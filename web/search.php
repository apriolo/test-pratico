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
$repo = $em->getRepository('CompanyBundle:Company');
$search = "Beauty and Fitness";
$result = $repo->createQueryBuilder("c")
    ->join('c.categories', 'cat')
    ->andWhere('c.title LIKE :title OR c.address LIKE :address OR c.postalcode LIKE :postalcode OR c.city LIKE :city OR cat.title LIKE :cat')
    ->setParameter('title', '%'.$search.'%')
    ->setParameter('address', '%'.$search.'%')
    ->setParameter('city', '%'.$search.'%')
    ->setParameter('postalcode', '%'.$search.'%')
    ->setParameter('cat', '%'.$search.'%')
    ->getQuery()
    ->execute();

echo "<pre>";
var_dump($result);
echo "teste";
exit();
