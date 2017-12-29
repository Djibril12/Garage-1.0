<?php


namespace AppBundle\Controller\Admin;



use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * @Route("/admin")
 */
class UseradminController extends Controller
{
    /**
     * @Route("/users", name="app.admin.user.index")*
    */
    public function indexAction(Request $request)
    {


        $pager = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAllQueryBuilder('asc', 1, 0);

        $page = $request->query->get('page',1);
        //$pager->
        $pager->haveToPaginate(); // Retourne true si le nombre de résultats est supérieur au nombre maximum d'éléments par page

        $pager->getNbPages(); // Nombre total de pages

        $pager->hasPreviousPage(); // Retourne true si la page courante possède une page précédente

        $pager->hasNextPage();

        $pager->setCurrentPage($page);
        
        //exit(dump($pager));
        return $this->render('admin/user/index.html.twig',[
            'users' => $pager,
            'my_pager' => $pager,
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