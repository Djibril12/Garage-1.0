<?php

namespace AppBundle\Twig;

use AppBundle\Service\PanierService;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\Marque;
use AppBundle\Entity\CategoriePieceDetache;

class AppExtension extends \Twig_Extension {

    private $doctrine;
    private $twig;
    private $panier;

    public function __construct(ManagerRegistry $doctrine, \Twig_Environment $twig, PanierService $panier) {
        $this->doctrine = $doctrine;
        $this->twig = $twig;
        $this->panier = $panier;
    }

    public function getFunctions() {

        return [
            new \Twig_SimpleFunction('generate_nav', [$this, 'generateNav']),
            new \Twig_SimpleFunction('nombre_article_panier', [$this, 'nombreArticlePanier']),

        ];
    }


    public function nombreArticlePanier()
    {
        return $this->panier->nombreArticlePanier();
    }

    public function generateNav() {
        $marques = $this->doctrine->getRepository(Marque::class)->findAll();
        $categories = $this->doctrine->getRepository(CategoriePieceDetache::class)->findAll();
        
        //dump($categories);
        //exit();
        
        return $this->twig->render('inc/nav.html.twig', [
                    'marques' => $marques,
                    'categories' => $categories
        ]);
    }

}
