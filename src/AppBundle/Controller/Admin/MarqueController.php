<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Marque;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Marque controller.
 *
 * @Route("/admin/marque")
 */
class MarqueController extends Controller
{
    /**
     * Lists all marque entities.
     *
     * @Route("/", name="admin_marque_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $marques = $em->getRepository('AppBundle:Marque')->findAll();

        return $this->render('admin/marque/index.html.twig', array(
            'marques' => $marques,
        ));
    }

    /**
     * Creates a new marque entity.
     *
     * @Route("/new", name="admin_marque_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $marque = new Marque();
        $form = $this->createForm('AppBundle\Form\MarqueType', $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($marque);
            $em->flush();

            return $this->redirectToRoute('admin_marque_show', array('id' => $marque->getId()));
        }

        return $this->render('admin/marque/new.html.twig', array(
            'marque' => $marque,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a marque entity.
     *
     * @Route("/{id}", name="admin_marque_show")
     * @Method("GET")
     */
    public function showAction(Marque $marque)
    {
        $deleteForm = $this->createDeleteForm($marque);

        return $this->render('admin/marque/show.html.twig', array(
            'marque' => $marque,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing marque entity.
     *
     * @Route("/{id}/edit", name="admin_marque_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Marque $marque)
    {
        $deleteForm = $this->createDeleteForm($marque);
        $editForm = $this->createForm('AppBundle\Form\MarqueType', $marque);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_marque_edit', array('id' => $marque->getId()));
        }

        return $this->render('admin/marque/edit.html.twig', array(
            'marque' => $marque,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a marque entity.
     *
     * @Route("/{id}", name="admin_marque_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Marque $marque)
    {
        $form = $this->createDeleteForm($marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($marque);
            $em->flush();
        }

        return $this->redirectToRoute('admin_marque_index');
    }

    /**
     * Creates a form to delete a marque entity.
     *
     * @param Marque $marque The marque entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Marque $marque)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_marque_delete', array('id' => $marque->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
