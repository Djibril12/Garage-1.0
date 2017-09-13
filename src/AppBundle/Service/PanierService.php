<?php
/**
 * Created by PhpStorm.
 * User: wap57
 * Date: 19/07/17
 * Time: 10:33
 */

namespace AppBundle\Service;


use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{

    private $session;
    private $panier;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;

        // initialisation de la session
        if(!$this->session->has('panier')) {

            $this->session->set('panier', []);
        }
        else
        {
             $this->panier = $this->session->get('panier');
        }

        //dump($this->panier);

    }

    public function listeProduit()
    {
        return $this->panier;
    }

    public function ajoutProduitDuPanier($produit)
    {
        $comnande = [];

        $commande['id'] = $produit->getId();
        $commande['qte'] = 1;
        $commande['prix'] = $produit->getPrix();

        $this->panier[] = $commande;
        $this->session->set('panier', $this->panier);
        
       
    }

    public function  supprimerProduitDuPanier($produit)
    {
        //$copiePanier = $this->panier;
        
        if(!empty($this->panier))
        {
            foreach( $this->panier as $key => $article)
            {
                if(in_array($produit->getId(),$article))
                {
                    $articleASupp = $key;
                }
            }

            $this->session->remove('panier')[$articleASupp];            
        }
    }
}