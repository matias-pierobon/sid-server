<?php

namespace SID\Api\MovementBundle\Controller;

use SID\Api\MovementBundle\Entity\Motivo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Motivo controller.
 *
 */
class MotivoController extends Controller
{
    /**
     * Lists all Motivo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $motivos = $em->getRepository('MovementBundle:Motivo')->findAll();

        return $this->render('MovementBundle:Motivo:index.html.twig', array(
            'motivos' => $motivos,
        ));
    }

    /**
     * Creates a new Motivo entity.
     *
     */
    public function newAction(Request $request)
    {
        $motivo = new Motivo();
        $form = $this->createForm('SID\Api\MovementBundle\Form\MotivoType', $motivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($motivo);
            $em->flush($motivo);

            return $this->redirectToRoute('motivo_show', array('id' => $motivo->getId()));
        }

        return $this->render('MovementBundle:Motivo:new.html.twig', array(
            'motivo' => $motivo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Motivo entity.
     *
     */
    public function showAction(Motivo $motivo)
    {
        $deleteForm = $this->createDeleteForm($motivo);

        return $this->render('MovementBundle:Motivo:show.html.twig', array(
            'motivo' => $motivo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Motivo entity.
     *
     */
    public function editAction(Request $request, Motivo $motivo)
    {
        $deleteForm = $this->createDeleteForm($motivo);
        $editForm = $this->createForm('SID\Api\MovementBundle\Form\MotivoType', $motivo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('motivo_edit', array('id' => $motivo->getId()));
        }

        return $this->render('MovementBundle:Motivo:edit.html.twig', array(
            'motivo' => $motivo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Motivo entity.
     *
     */
    public function deleteAction(Request $request, Motivo $motivo)
    {
        $form = $this->createDeleteForm($motivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($motivo);
            $em->flush();
        }

        return $this->redirectToRoute('motivo_index');
    }

    /**
     * Creates a form to delete a Motivo entity.
     *
     * @param Motivo $motivo The Motivo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Motivo $motivo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('motivo_delete', array('id' => $motivo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
