<?php

namespace SID\Api\ProviderBundle\Controller;

use SID\Api\ProviderBundle\Entity\Proveedor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Proveedor controller.
 *
 */
class ProveedorController extends Controller
{
    /**
     * Lists all proveedor entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $proveedors = $em->getRepository('ProviderBundle:Proveedor')->findAll();

        return $this->render('proveedor/index.html.twig', array(
            'proveedors' => $proveedors,
        ));
    }

    /**
     * Creates a new proveedor entity.
     *
     */
    public function newAction(Request $request)
    {
        $proveedor = new Proveedor();
        $form = $this->createForm('SID\Api\ProviderBundle\Form\ProveedorType', $proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proveedor);
            $em->flush();

            return $this->redirectToRoute('proveedores_provider_show', array('id' => $proveedor->getId()));
        }

        return $this->render('proveedor/new.html.twig', array(
            'proveedor' => $proveedor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a proveedor entity.
     *
     */
    public function showAction(Proveedor $proveedor)
    {
        $deleteForm = $this->createDeleteForm($proveedor);

        return $this->render('proveedor/show.html.twig', array(
            'proveedor' => $proveedor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing proveedor entity.
     *
     */
    public function editAction(Request $request, Proveedor $proveedor)
    {
        $deleteForm = $this->createDeleteForm($proveedor);
        $editForm = $this->createForm('SID\Api\ProviderBundle\Form\ProveedorType', $proveedor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proveedores_provider_edit', array('id' => $proveedor->getId()));
        }

        return $this->render('proveedor/edit.html.twig', array(
            'proveedor' => $proveedor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a proveedor entity.
     *
     */
    public function deleteAction(Request $request, Proveedor $proveedor)
    {
        $form = $this->createDeleteForm($proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($proveedor);
            $em->flush();
        }

        return $this->redirectToRoute('proveedores_provider_index');
    }

    /**
     * Creates a form to delete a proveedor entity.
     *
     * @param Proveedor $proveedor The proveedor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Proveedor $proveedor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proveedores_provider_delete', array('id' => $proveedor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
