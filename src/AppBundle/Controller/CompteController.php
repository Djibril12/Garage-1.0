<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class CompteController extends Controller
{


    /**
     * @Route("/inscription", name="app.compte.inscrire")
     */
    public function inscrireAction(Request $request)
    {




        return $this->render('compte/inscrire.html.twig');
    }

    /**
     * @Route("/oubli-mot-passe", name="app.compte.oubli.motpasse")
     */
    public function oubliMotPasseAction(Request $request)
    {
      

        
        return $this->render('compte/oubli-mot-passe.html.twig');
    }
    

}
