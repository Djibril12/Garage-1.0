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
        
        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->getVoitureParSlug($slug);
        
        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }
}
