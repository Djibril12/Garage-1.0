<?php

namespace AppBundle\Twig;

use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\Marque;
use AppBundle\Entity\CategoriePieceDetache;

class AppExtension extends \Twig_Extension {

    private $doctrine;
    private $twig;

    public function __construct(ManagerRegistry $doctrine, \Twig_Environment $twig) {
        $this->doctrine = $doctrine;
        $this->twig = $twig;
    }

    public function getFunctions() {

        return [
            new \Twig_SimpleFunction('generate_nav', [$this, 'generateNav']),
        ];
    }

    public function generateNav() {
        $marques = $this->doctrine->getRepository(Marque::class)->findAll();
        $categories = $this->doctrine->getRepository(CategoriePieceDetache::class)->findAll();
        
        dump($categories);
        //exit();
        
        return $this->twig->render('inc/nav.html.twig', [
                    'marques' => $marques,
                    'categories' => $categories
        ]);
    }

}
