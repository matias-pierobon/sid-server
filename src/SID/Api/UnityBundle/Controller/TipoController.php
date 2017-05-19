<?php

namespace SID\Api\UnityBundle\Controller;

use SID\Api\UnityBundle\Entity\Tipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tipo controller.
 *
 */
class TipoController extends Controller
{
    /**
     * Lists all Tipos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipos = $em->getRepository('UnityBundle:Tipo')->findAll();

        return $this->render('UnityBundle:Tipos:index.html.twig', array(
            'tipos' => $tipos,
        ));
    }

    /**
     * Creates a new Tipos entity.
     *
     */
    public function newAction(Request $request)
    {
        $tipo = new Tipo();
        $form = $this->createForm('SID\Api\UnityBundle\Form\TipoType', $tipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipo);
            $em->flush($tipo);

            return $this->redirectToRoute('tipo_show', array('id' => $tipo->getId()));
        }

        return $this->render('UnityBundle:Tipos:new.html.twig', array(
            'tipo' => $tipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tipos entity.
     *
     */
    public function showAction(Tipo $tipo)
    {
        $deleteForm = $this->createDeleteForm($tipo);

        return $this->render('UnityBundle:Tipos:show.html.twig', array(
            'tipo' => $tipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tipos entity.
     *
     */
    public function editAction(Request $request, Tipo $tipo)
    {
        $deleteForm = $this->createDeleteForm($tipo);
        $editForm = $this->createForm('SID\Api\UnityBundle\Form\TipoType', $tipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipo_edit', array('id' => $tipo->getId()));
        }

        return $this->render('UnityBundle:Tipos:edit.html.twig', array(
            'tipo' => $tipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tipos entity.
     *
     */
    public function deleteAction(Request $request, Tipo $tipo)
    {
        $form = $this->createDeleteForm($tipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipo);
            $em->flush();
        }

        return $this->redirectToRoute('tipo_index');
    }

    /**
     * Creates a form to delete a Tipos entity.
     *
     * @param Tipo $tipo The Tipos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tipo $tipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipo_delete', array('id' => $tipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
