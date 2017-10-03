<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PieceDetache;
use AppBundle\Service\PanierService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends Controller {

    /**
     * @Route("/panier", name="app.panier.panier")
     */
    public function panierAction(Request $request) {

        $panier = $this->get(PanierService::class)->listeProduit();
        //dump($request);
        //exit();

        if (!empty($panier)) {
            foreach ($panier as $key => $article) {
                if (array_key_exists('id', $article))
                    $idArticles[] = $article['id'];
            }
            // suppression des valeurs doubles dans le tableau 
            $result = array_unique($idArticles);
            //dump($result);
            //exit();
            for ($i = 0; $i < sizeof($result); $i++) {
                // dump($result[$i]);

                $produits[] = $this->getDoctrine()->getRepository(PieceDetache::class)->find($result[$i]);
            }
            //exit();
        } else {
            $produits = null;
        }
        //dump($produits);
       // exit();
        return $this->render('panier/panier.html.twig', [
                    'produits' => $produits,
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="app.panier.add", requirements={"id": "[0-9]+"})
     */
    public function addAction(Request $request, $id) {

        // recuperation du produit 
        $produit = $this->getDoctrine()->getRepository(PieceDetache::class)->find($id);
        // appel du service 
        $service = $this->get(PanierService::class);

        // injection du produit 
        $service->ajoutProduitDuPanier($produit);

        $referer = $request->headers->get('Referer');

        return $this->redirect($referer);
    }

    /**
     * @Route("/panier/delete/{id}", name="app.panier.delete", requirements={"id": "[0-9]+"})
     */
    public function deleteAction(Request $request, $id) {
        $produit = $this->getDoctrine()->getRepository(PieceDetache::class)->find($id);

        // supprimer id du panier
        $this->get(PanierService::class)->supprimerProduitDuPanier($produit);

        $referer = $request->headers->get('Referer');

        return $this->redirect($referer);
    }

}
