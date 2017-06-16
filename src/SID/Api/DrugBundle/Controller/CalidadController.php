<?php

namespace SID\Api\DrugBundle\Controller;

use SID\Api\DrugBundle\Entity\Calidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Calidad controller.
 *
 */
class CalidadController extends Controller
{
    /**
     * Lists all calidad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $calidads = $em->getRepository('DrugBundle:Calidad')->findAll();

        return $this->render('DrugBundle:Calidad:index.html.twig', array(
            'calidads' => $calidads,
        ));
    }

    /**
     * Creates a new calidad entity.
     *
     */
    public function newAction(Request $request)
    {
        $calidad = new Calidad();
        $form = $this->createForm('SID\Api\DrugBundle\Form\CalidadType', $calidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($calidad);
            $em->flush();

            return $this->redirectToRoute('calidades_show', array('id' => $calidad->getId()));
        }

        return $this->render('DrugBundle:Calidad:new.html.twig', array(
            'calidad' => $calidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a calidad entity.
     *
     */
    public function showAction(Calidad $calidad)
    {
        $deleteForm = $this->createDeleteForm($calidad);

        return $this->render('DrugBundle:Calidad:show.html.twig', array(
            'calidad' => $calidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing calidad entity.
     *
     */
    public function editAction(Request $request, Calidad $calidad)
    {
        $deleteForm = $this->createDeleteForm($calidad);
        $editForm = $this->createForm('SID\Api\DrugBundle\Form\CalidadType', $calidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('calidades_index');
        }

        return $this->render('DrugBundle:Calidad:edit.html.twig', array(
            'calidad' => $calidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a calidad entity.
     *
     */
    public function deleteAction(Request $request, Calidad $calidad)
    {
        $form = $this->createDeleteForm($calidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($calidad);
            $em->flush();
        }

        return $this->redirectToRoute('calidades_index');
    }

    /**
     * Creates a form to delete a calidad entity.
     *
     * @param Calidad $calidad The calidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Calidad $calidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('calidades_delete', array('id' => $calidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
