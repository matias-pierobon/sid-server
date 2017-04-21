<?php

namespace SID\Api\SubstanceBundle\Controller;

use SID\Api\SubstanceBundle\Entity\GHS;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Gh controller.
 *
 */
class GHSController extends Controller
{
    /**
     * Lists all gH entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gHSs = $em->getRepository('SubstanceBundle:GHS')->findAll();

        return $this->render('ghs/index.html.twig.twig', array(
            'gHSs' => $gHSs,
        ));
    }

    /**
     * Creates a new gH entity.
     *
     */
    public function newAction(Request $request)
    {
        $gH = new Gh();
        $form = $this->createForm('SID\Api\SubstanceBundle\Form\GHSType', $gH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gH);
            $em->flush($gH);

            return $this->redirectToRoute('ghs_show', array('id' => $gH->getId()));
        }

        return $this->render('ghs/new.html.twig', array(
            'gH' => $gH,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a gH entity.
     *
     */
    public function showAction(GHS $gH)
    {
        $deleteForm = $this->createDeleteForm($gH);

        return $this->render('ghs/show.html.twig', array(
            'gH' => $gH,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gH entity.
     *
     */
    public function editAction(Request $request, GHS $gH)
    {
        $deleteForm = $this->createDeleteForm($gH);
        $editForm = $this->createForm('SID\Api\SubstanceBundle\Form\GHSType', $gH);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ghs_edit', array('id' => $gH->getId()));
        }

        return $this->render('ghs/edit.html.twig', array(
            'gH' => $gH,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gH entity.
     *
     */
    public function deleteAction(Request $request, GHS $gH)
    {
        $form = $this->createDeleteForm($gH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gH);
            $em->flush();
        }

        return $this->redirectToRoute('ghs_index');
    }

    /**
     * Creates a form to delete a gH entity.
     *
     * @param GHS $gH The gH entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GHS $gH)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ghs_delete', array('id' => $gH->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
