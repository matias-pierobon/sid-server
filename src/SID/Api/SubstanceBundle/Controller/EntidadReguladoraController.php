<?php

namespace SID\Api\SubstanceBundle\Controller;

use SID\Api\SubstanceBundle\Entity\EntidadReguladora;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Entidadreguladora controller.
 *
 */
class EntidadReguladoraController extends Controller
{
    /**
     * Lists all entidadReguladora entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entidadReguladoras = $em->getRepository('SubstanceBundle:EntidadReguladora')->findAll();

        return $this->render('SubstanceBundle:Entidad:index.html.twig', array(
            'entidades' => $entidadReguladoras,
        ));
    }

    /**
     * Creates a new entidadReguladora entity.
     *
     */
    public function newAction(Request $request)
    {
        $entidadReguladora = new Entidadreguladora();
        $form = $this->createForm('SID\Api\SubstanceBundle\Form\EntidadReguladoraType', $entidadReguladora);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entidadReguladora);
            $em->flush($entidadReguladora);

            return $this->redirectToRoute('entidades_show', array('id' => $entidadReguladora->getId()));
        }

        return $this->render('SubstanceBundle:Entidad:new.html.twig', array(
            'entidad' => $entidadReguladora,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a entidadReguladora entity.
     *
     */
    public function showAction(EntidadReguladora $entidadReguladora)
    {
        $deleteForm = $this->createDeleteForm($entidadReguladora);

        return $this->render('SubstanceBundle:Entidad:show.html.twig', array(
            'entidad' => $entidadReguladora,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing entidadReguladora entity.
     *
     */
    public function editAction(Request $request, EntidadReguladora $entidadReguladora)
    {
        $deleteForm = $this->createDeleteForm($entidadReguladora);
        $editForm = $this->createForm('SID\Api\SubstanceBundle\Form\EntidadReguladoraType', $entidadReguladora);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entidades_edit', array('id' => $entidadReguladora->getId()));
        }

        return $this->render('SubstanceBundle:Entidad:edit.html.twig', array(
            'entidad' => $entidadReguladora,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a entidadReguladora entity.
     *
     */
    public function deleteAction(Request $request, EntidadReguladora $entidadReguladora)
    {
        $form = $this->createDeleteForm($entidadReguladora);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entidadReguladora);
            $em->flush();
        }

        return $this->redirectToRoute('entidades_index');
    }

    /**
     * Creates a form to delete a entidadReguladora entity.
     *
     * @param EntidadReguladora $entidadReguladora The entidadReguladora entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EntidadReguladora $entidadReguladora)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('entidades_delete', array('id' => $entidadReguladora->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
