<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Voiture;

class VoitureController extends Controller
{
    /**
     * @Route("/voiture/{slug}", name="app.voiture.index")
     */
    public function indexAction(Request $request, $slug)
    {
        // service de traduction
        //$translator = $this->get('translator');

        $voitures = $this->getDoctrine()->getRepository(\AppBundle\Entity\Voiture::class)->getVoitureParSlug($slug);
        
        //$translator->transchoice('voiture.nombre', sizeof($voitures));
        
        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,
            'slug' => $slug
        ]);
    }
}
