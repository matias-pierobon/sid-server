<?php

namespace SID\Api\DrugBundle\Controller;

use SID\Api\DrugBundle\Entity\Subdivision;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Subdivision controller.
 *
 */
class SubdivisionController extends Controller
{
    /**
     * Lists all subdivision entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subdivisions = $em->getRepository('DrugBundle:Subdivision')->findAll();

        return $this->render('subdivision/index.html.twig.twig', array(
            'subdivisions' => $subdivisions,
        ));
    }

    /**
     * Creates a new subdivision entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $subdivision = new Subdivision();
        $subdivision
            ->setNombre($request->get('nombre'))
            ->setDetalle($request->get('detalle'));


        return new JsonResponse();
    }

    /**
     * Finds and displays a subdivision entity.
     *
     */
    public function showAction(Subdivision $subdivision)
    {
        $deleteForm = $this->createDeleteForm($subdivision);

        return $this->render('subdivision/show.html.twig', array(
            'subdivision' => $subdivision,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing subdivision entity.
     *
     */
    public function editAction(Request $request, Subdivision $subdivision)
    {
        $deleteForm = $this->createDeleteForm($subdivision);
        $editForm = $this->createForm('SID\Api\DrugBundle\Form\SubdivisionType', $subdivision);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subdivision_edit', array('id' => $subdivision->getId()));
        }

        return $this->render('subdivision/edit.html.twig', array(
            'subdivision' => $subdivision,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a subdivision entity.
     *
     */
    public function deleteAction(Request $request, Subdivision $subdivision)
    {
        $form = $this->createDeleteForm($subdivision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subdivision);
            $em->flush();
        }

        return $this->redirectToRoute('subdivision_index');
    }

    /**
     * Creates a form to delete a subdivision entity.
     *
     * @param Subdivision $subdivision The subdivision entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Subdivision $subdivision)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subdivision_delete', array('id' => $subdivision->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
