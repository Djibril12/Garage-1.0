<?php

namespace AppBundle\Controller\Profil;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/home")
 */
class HomepageController extends Controller
{
    /**
     * @Route("/profil", name="app.profil.homepage.index")
     */
    public function indexAction(Request $request)
    {
      
        
        
        return $this->render('admin/index.html.twig');
    }
}
