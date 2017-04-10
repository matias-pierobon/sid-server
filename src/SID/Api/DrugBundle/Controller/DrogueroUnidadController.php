<?php

namespace SID\Api\DrugBundle\Controller;

use SID\Api\DrugBundle\Entity\DrogueroUnidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Droguerounidad controller.
 *
 */
class DrogueroUnidadController extends Controller
{
    /**
     * Lists all drogueroUnidad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $drogueroUnidads = $em->getRepository('DrugBundle:DrogueroUnidad')->findAll();

        return $this->render('droguerounidad/index.html.twig', array(
            'drogueroUnidads' => $drogueroUnidads,
        ));
    }

    /**
     * Creates a new drogueroUnidad entity.
     *
     */
    public function newAction(Request $request)
    {
        $drogueroUnidad = new Droguerounidad();
        $form = $this->createForm('SID\Api\DrugBundle\Form\DrogueroUnidadType', $drogueroUnidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($drogueroUnidad);
            $em->flush($drogueroUnidad);

            return $this->redirectToRoute('droguerounidad_show', array('id' => $drogueroUnidad->getId()));
        }

        return $this->render('droguerounidad/new.html.twig', array(
            'drogueroUnidad' => $drogueroUnidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a drogueroUnidad entity.
     *
     */
    public function showAction(DrogueroUnidad $drogueroUnidad)
    {
        $deleteForm = $this->createDeleteForm($drogueroUnidad);

        return $this->render('droguerounidad/show.html.twig', array(
            'drogueroUnidad' => $drogueroUnidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing drogueroUnidad entity.
     *
     */
    public function editAction(Request $request, DrogueroUnidad $drogueroUnidad)
    {
        $deleteForm = $this->createDeleteForm($drogueroUnidad);
        $editForm = $this->createForm('SID\Api\DrugBundle\Form\DrogueroUnidadType', $drogueroUnidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('droguerounidad_edit', array('id' => $drogueroUnidad->getId()));
        }

        return $this->render('droguerounidad/edit.html.twig', array(
            'drogueroUnidad' => $drogueroUnidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a drogueroUnidad entity.
     *
     */
    public function deleteAction(Request $request, DrogueroUnidad $drogueroUnidad)
    {
        $form = $this->createDeleteForm($drogueroUnidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($drogueroUnidad);
            $em->flush();
        }

        return $this->redirectToRoute('droguerounidad_index');
    }

    /**
     * Creates a form to delete a drogueroUnidad entity.
     *
     * @param DrogueroUnidad $drogueroUnidad The drogueroUnidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DrogueroUnidad $drogueroUnidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('droguerounidad_delete', array('id' => $drogueroUnidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
