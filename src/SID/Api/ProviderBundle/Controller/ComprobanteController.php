<?php

namespace SID\Api\ProviderBundle\Controller;

use SID\Api\ProviderBundle\Entity\Comprobante;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Comprobante controller.
 *
 */
class ComprobanteController extends Controller
{
    /**
     * Lists all comprobante entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comprobantes = $em->getRepository('ProviderBundle:Comprobante')->findAll();

        return $this->render('comprobante/index.html.twig', array(
            'comprobantes' => $comprobantes,
        ));
    }

    /**
     * Creates a new comprobante entity.
     *
     */
    public function newAction(Request $request)
    {
        $comprobante = new Comprobante();
        $comprobante->setFecha(new \DateTime());
        $form = $this->createForm('SID\Api\ProviderBundle\Form\ComprobanteType', $comprobante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comprobante);
            $em->flush();

            return $this->redirectToRoute('comprobantes_provider_show', array('id' => $comprobante->getId()));
        }

        return $this->render('comprobante/new.html.twig', array(
            'comprobante' => $comprobante,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a comprobante entity.
     *
     */
    public function showAction(Comprobante $comprobante)
    {
        $deleteForm = $this->createDeleteForm($comprobante);

        return $this->render('comprobante/show.html.twig', array(
            'comprobante' => $comprobante,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing comprobante entity.
     *
     */
    public function editAction(Request $request, Comprobante $comprobante)
    {
        $deleteForm = $this->createDeleteForm($comprobante);
        $editForm = $this->createForm('SID\Api\ProviderBundle\Form\ComprobanteType', $comprobante);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comprobantes_provider_edit', array('id' => $comprobante->getId()));
        }

        return $this->render('comprobante/edit.html.twig', array(
            'comprobante' => $comprobante,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a comprobante entity.
     *
     */
    public function deleteAction(Request $request, Comprobante $comprobante)
    {
        $form = $this->createDeleteForm($comprobante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comprobante);
            $em->flush();
        }

        return $this->redirectToRoute('comprobantes_provider_index');
    }

    /**
     * Creates a form to delete a comprobante entity.
     *
     * @param Comprobante $comprobante The comprobante entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comprobante $comprobante)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comprobantes_provider_delete', array('id' => $comprobante->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
