<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 03/09/2017
 * Time: 03:55
 */

namespace AppBundle\Controller\Admin;



use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin")
 */
class UseradminController extends Controller
{


    /**
     * @Route("/users", name="app.admin.user.index")
    */
    public function indexAction(Request $request)
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        //exit(dump($users));


        return $this->render('admin/user/index.html.twig',[
            'users' => $users,
            ]);
    }


    /**
     * @Route("/users/edit/{id}", name="app.admin.user.edit")
     */
    public function editAction(Request $request, User $user)
    {
        // instanciation de l'entity manager
        $em = $this->getDoctrine()->getManager();


        // création du formulaire
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // récupération des données
            $dataPost = $form->getData();
            //exit(dump($dataPost, $user));


            $em->persist($user);
            $em->flush();
            // ajout du message flash
            $request->getSession()->getFlashBag()->add('notice','Votre a été crée avec succès');
            // redirection à la page de login pour une connexion
            return $this->redirectToRoute('app.admin.user.index');

        }


        return $this->render('admin/user/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/users/add", name="app.admin.user.add")
     */
    public function addAction(Request $request)
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
            $dataPost = $form->getData();
            //exit(dump($dataPost, $user));


            $em->persist($user);
            $em->flush();
            // ajout du message flash
            $request->getSession()->getFlashBag()->add('notice','Votre a été crée avec succès');
            // redirection à la page de login pour une connexion
            return $this->redirectToRoute('app.admin.user.index');

        }


        return $this->render('admin/user/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/users/delete/{id}", name="app.admin.user.delete")
     */
    public function deleteAction(Request $request, User $user)
    {
        exit(dump($user));
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);

        $em->flush();
        $this->addFlash('notice', "L'utilisateur a été supprimé avec succès");

        //return $this->render('admin/user/index.html.twig');
    }

}