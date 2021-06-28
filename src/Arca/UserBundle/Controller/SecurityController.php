<?php


namespace Arca\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends Controller
{
    /**
     * @Route ("/login", name="login_form")
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);

        $lastUsername = $session->get(SecurityContextInterface::LAST_USERNAME);

        return $this->render("/Security/login.html.twig",[
            // last username entered by the user
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route ("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        
    }

    /**
     * @Route ("/logout", name="logout")
     */
    public function logoutAction()
    {

    }

}