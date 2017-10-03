<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\PieceDetache;
use AppBundle\Entity\CategoriePieceDetacheTranslation;

class PieceDetacheController extends Controller
{
    /**
     * @Route("/piece-detache/{slug}", name="app.piece.detache.index")
     */
    public function indexAction(Request $request, $slug)
    {
        
       
        
        $piecesDetachees = $this->getDoctrine()->getRepository(PieceDetache::class)->getPieceParCategorie($slug);
        //dump($piecesDetachees);
        //exit();
        
        // replace this example code with whatever you need
        return $this->render('piece-detache/index.html.twig', [
            'piecesDetachees' => $piecesDetachees,
        ]);
    }
}
