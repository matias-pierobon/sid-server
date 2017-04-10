<?php

namespace SID\Api\SubstanceBundle\Controller;

use SID\Api\SubstanceBundle\Entity\Droga;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Droga controller.
 *
 */
class DrogaController extends Controller
{
    /**
     * Lists all droga entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $drogas = $em->getRepository('SubstanceBundle:Droga')->findAll();

        return $this->render('droga/index.html.twig', array(
            'drogas' => $drogas,
        ));
    }

    /**
     * Creates a new droga entity.
     *
     */
    public function newAction(Request $request)
    {
        $droga = new Droga();
        $form = $this->createForm('SID\Api\SubstanceBundle\Form\DrogaType', $droga);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($droga);
            $em->flush($droga);

            return $this->redirectToRoute('droga_show', array('id' => $droga->getId()));
        }

        return $this->render('droga/new.html.twig', array(
            'droga' => $droga,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a droga entity.
     *
     */
    public function showAction(Droga $droga)
    {
        $deleteForm = $this->createDeleteForm($droga);

        return $this->render('droga/show.html.twig', array(
            'droga' => $droga,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing droga entity.
     *
     */
    public function editAction(Request $request, Droga $droga)
    {
        $deleteForm = $this->createDeleteForm($droga);
        $editForm = $this->createForm('SID\Api\SubstanceBundle\Form\DrogaType', $droga);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('droga_edit', array('id' => $droga->getId()));
        }

        return $this->render('droga/edit.html.twig', array(
            'droga' => $droga,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a droga entity.
     *
     */
    public function deleteAction(Request $request, Droga $droga)
    {
        $form = $this->createDeleteForm($droga);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($droga);
            $em->flush();
        }

        return $this->redirectToRoute('droga_index');
    }

    /**
     * Creates a form to delete a droga entity.
     *
     * @param Droga $droga The droga entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Droga $droga)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('droga_delete', array('id' => $droga->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
