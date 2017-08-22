<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
     /**
     * @Route("/login", name="app.security.login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {

        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }


    /**
     * @Route("/logout", name="app.security.logout")
     */
    public function logoutAction()
    {

    }


    /**
     * @Route("/redirect-by-role", name="app.redirect.by.role")
     * 
     */
    public function redirectByRoleAction(Request $request)
    {
        $user = $this->getUser();
        
        if(in_array("ROLE_USER", $user->getRoles()))
        {
            return $this->redirectToRoute('app.homepage.index');
        }
        else if(in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return $this->redirectToRoute('app.admin.index');
        }        
    }
}
