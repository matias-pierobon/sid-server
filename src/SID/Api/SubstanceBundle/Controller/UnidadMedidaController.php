<?php

namespace SID\Api\SubstanceBundle\Controller;

use SID\Api\SubstanceBundle\Entity\UnidadMedida;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unidadmedida controller.
 *
 */
class UnidadMedidaController extends Controller
{
    /**
     * Lists all unidadMedida entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $unidadMedidas = $em->getRepository('SubstanceBundle:UnidadMedida')->findAll();

        return $this->render('SubstanceBundle:Unidad:index.html.twig', array(
            'unidades' => $unidadMedidas,
        ));
    }

    /**
     * Creates a new unidadMedida entity.
     *
     */
    public function newAction(Request $request)
    {
        $unidadMedida = new Unidadmedida();
        $form = $this->createForm('SID\Api\SubstanceBundle\Form\UnidadMedidaType', $unidadMedida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unidadMedida);
            $em->flush($unidadMedida);

            return $this->redirectToRoute('unidades_medidas_show', array('id' => $unidadMedida->getId()));
        }

        return $this->render('SubstanceBundle:Unidad:new.html.twig', array(
            'unidad' => $unidadMedida,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a unidadMedida entity.
     *
     */
    public function showAction(UnidadMedida $unidadMedida)
    {
        $deleteForm = $this->createDeleteForm($unidadMedida);

        return $this->render('SubstanceBundle:Unidad:show.html.twig', array(
            'unidad' => $unidadMedida,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing unidadMedida entity.
     *
     */
    public function editAction(Request $request, UnidadMedida $unidadMedida)
    {
        $deleteForm = $this->createDeleteForm($unidadMedida);
        $editForm = $this->createForm('SID\Api\SubstanceBundle\Form\UnidadMedidaType', $unidadMedida);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('unidades_medidas_show', array('id' => $unidadMedida->getId()));
        }

        return $this->render('SubstanceBundle:Unidad:edit.html.twig', array(
            'unidad' => $unidadMedida,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a unidadMedida entity.
     *
     */
    public function deleteAction(Request $request, UnidadMedida $unidadMedida)
    {
        $form = $this->createDeleteForm($unidadMedida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unidadMedida);
            $em->flush();
        }

        return $this->redirectToRoute('unidades_medidas_index');
    }

    /**
     * Creates a form to delete a unidadMedida entity.
     *
     * @param UnidadMedida $unidadMedida The unidadMedida entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UnidadMedida $unidadMedida)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unidades_medidas_delete', array('id' => $unidadMedida->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
