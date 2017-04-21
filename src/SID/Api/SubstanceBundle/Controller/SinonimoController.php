<?php

namespace SID\Api\SubstanceBundle\Controller;

use SID\Api\SubstanceBundle\Entity\Sinonimo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sinonimo controller.
 *
 */
class SinonimoController extends Controller
{
    /**
     * Lists all sinonimo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sinonimos = $em->getRepository('SubstanceBundle:Sinonimo')->findAll();

        return $this->render('sinonimo/index.html.twig.twig', array(
            'sinonimos' => $sinonimos,
        ));
    }

    /**
     * Creates a new sinonimo entity.
     *
     */
    public function newAction(Request $request)
    {
        $sinonimo = new Sinonimo();
        $form = $this->createForm('SID\Api\SubstanceBundle\Form\SinonimoType', $sinonimo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sinonimo);
            $em->flush($sinonimo);

            return $this->redirectToRoute('sinonimo_show', array('id' => $sinonimo->getId()));
        }

        return $this->render('sinonimo/new.html.twig', array(
            'sinonimo' => $sinonimo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sinonimo entity.
     *
     */
    public function showAction(Sinonimo $sinonimo)
    {
        $deleteForm = $this->createDeleteForm($sinonimo);

        return $this->render('sinonimo/show.html.twig', array(
            'sinonimo' => $sinonimo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sinonimo entity.
     *
     */
    public function editAction(Request $request, Sinonimo $sinonimo)
    {
        $deleteForm = $this->createDeleteForm($sinonimo);
        $editForm = $this->createForm('SID\Api\SubstanceBundle\Form\SinonimoType', $sinonimo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sinonimo_edit', array('id' => $sinonimo->getId()));
        }

        return $this->render('sinonimo/edit.html.twig', array(
            'sinonimo' => $sinonimo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sinonimo entity.
     *
     */
    public function deleteAction(Request $request, Sinonimo $sinonimo)
    {
        $form = $this->createDeleteForm($sinonimo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sinonimo);
            $em->flush();
        }

        return $this->redirectToRoute('sinonimo_index');
    }

    /**
     * Creates a form to delete a sinonimo entity.
     *
     * @param Sinonimo $sinonimo The sinonimo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sinonimo $sinonimo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sinonimo_delete', array('id' => $sinonimo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
