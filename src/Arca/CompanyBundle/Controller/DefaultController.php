<?php

namespace Arca\CompanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index_search")
     */
    public function indexAction(Request $request)
    {
        $error = ($request->get('error')) ?: null;

        return $this->render('default/index.html.twig', [
            "error" => $error
        ]);
    }
}
