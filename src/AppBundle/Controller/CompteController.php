<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
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
        // instanciation de l'entity manager
        $em = $this->getDoctrine()->getManager();

        // instanciation de l'utilisateur
        $user = new User();

        // création du formulaire
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // récupération des données
            //$dataPost = $form->getData();
            //exit(dump($dataPost));


            $em->persist($user);
            // ajout du message flash
            $request->getSession()->getFlashBag()->add('notice','Votre a été crée avec succès');
            // redirection à la page de login pour une connexion
            return $this->redirectToRoute('app.security.login');

        }


        return $this->render('compte/inscrire.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/oubli-mot-passe", name="app.compte.oubli.motpasse")
     */
    public function oubliMotPasseAction(Request $request)
    {
      

        
        return $this->render('compte/oubli-mot-passe.html.twig');
    }
    

}
