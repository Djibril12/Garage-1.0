<?php


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
        $commande = [];
        $articleASupp = $this->getProduitByIndex($produit->getId());
        //dump($articleASupp); exit();
        if($articleASupp === -1)
        {
            $commande['id'] = $produit->getId();
            $commande['qte'] = 1;
            $commande['prix'] = $produit->getPrix();
            $this->panier[] = $commande;

        }
        else
        {
            $this->panier[$articleASupp]['qte'] +=  1;
        }

        $this->session->set('panier', $this->panier);

    }

    public function  supprimerProduitDuPanier($produit)
    {

        $articleASupp = $this->getProduitByIndex($produit->getId());
        array_splice($this->panier, $articleASupp, 1);
        $this->session->set('panier', $this->panier);

    }


    public function nombreArticlePanier()
    {
        //dump($this->session->get('panier'));
        $totalPanier = 0;
        if(!empty($this->session->get('panier')))
        {
            foreach ($this->session->get('panier') as $article)
            {
                $totalPanier += $article['qte'];
            }
        }

        //dump($quantite);
        //exit();
        return $totalPanier;

    }


    private function getProduitByIndex($id)
    {
        $articleASupp = -1;
        if(!empty($this->panier)) {
            foreach ($this->panier as $key => $article) {
                if (in_array($id, $article)) {
                    $articleASupp = $key;
                    break;
                }
            }
        }
        return $articleASupp;

    }

}