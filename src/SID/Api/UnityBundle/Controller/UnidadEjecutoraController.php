<?php

namespace SID\Api\UnityBundle\Controller;

use SID\Api\UnityBundle\Entity\UnidadEjecutora;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unidadejecutora controller.
 *
 */
class UnidadEjecutoraController extends Controller
{
    /**
     * Lists all unidadEjecutora entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $unidadEjecutoras = $em->getRepository('UnityBundle:UnidadEjecutora')->findAll();

        return $this->render('unidadejecutora/index.html.twig', array(
            'unidadEjecutoras' => $unidadEjecutoras,
        ));
    }

    /**
     * Creates a new unidadEjecutora entity.
     *
     */
    public function newAction(Request $request)
    {
        $unidadEjecutora = new Unidadejecutora();
        $form = $this->createForm('SID\Api\UnityBundle\Form\UnidadEjecutoraType', $unidadEjecutora);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unidadEjecutora);
            $em->flush($unidadEjecutora);

            return $this->redirectToRoute('unidadejecutora_show', array('id' => $unidadEjecutora->getId()));
        }

        return $this->render('unidadejecutora/new.html.twig', array(
            'unidadEjecutora' => $unidadEjecutora,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a unidadEjecutora entity.
     *
     */
    public function showAction(UnidadEjecutora $unidadEjecutora)
    {
        $deleteForm = $this->createDeleteForm($unidadEjecutora);

        return $this->render('unidadejecutora/show.html.twig', array(
            'unidadEjecutora' => $unidadEjecutora,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing unidadEjecutora entity.
     *
     */
    public function editAction(Request $request, UnidadEjecutora $unidadEjecutora)
    {
        $deleteForm = $this->createDeleteForm($unidadEjecutora);
        $editForm = $this->createForm('SID\Api\UnityBundle\Form\UnidadEjecutoraType', $unidadEjecutora);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('unidadejecutora_edit', array('id' => $unidadEjecutora->getId()));
        }

        return $this->render('unidadejecutora/edit.html.twig', array(
            'unidadEjecutora' => $unidadEjecutora,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a unidadEjecutora entity.
     *
     */
    public function deleteAction(Request $request, UnidadEjecutora $unidadEjecutora)
    {
        $form = $this->createDeleteForm($unidadEjecutora);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unidadEjecutora);
            $em->flush();
        }

        return $this->redirectToRoute('unidadejecutora_index');
    }

    /**
     * Creates a form to delete a unidadEjecutora entity.
     *
     * @param UnidadEjecutora $unidadEjecutora The unidadEjecutora entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UnidadEjecutora $unidadEjecutora)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unidadejecutora_delete', array('id' => $unidadEjecutora->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
