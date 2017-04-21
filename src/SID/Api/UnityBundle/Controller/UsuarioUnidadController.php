<?php

namespace SID\Api\UnityBundle\Controller;

use SID\Api\UnityBundle\Entity\UsuarioUnidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Usuariounidad controller.
 *
 */
class UsuarioUnidadController extends Controller
{
    /**
     * Lists all usuarioUnidad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuarioUnidads = $em->getRepository('UnityBundle:UsuarioUnidad')->findAll();

        return $this->render('usuariounidad/index.html.twig.twig', array(
            'usuarioUnidads' => $usuarioUnidads,
        ));
    }

    /**
     * Creates a new usuarioUnidad entity.
     *
     */
    public function newAction(Request $request)
    {
        $usuarioUnidad = new Usuariounidad();
        $form = $this->createForm('SID\Api\UnityBundle\Form\UsuarioUnidadType', $usuarioUnidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuarioUnidad);
            $em->flush($usuarioUnidad);

            return $this->redirectToRoute('usuariounidad_show', array('id' => $usuarioUnidad->getId()));
        }

        return $this->render('usuariounidad/new.html.twig', array(
            'usuarioUnidad' => $usuarioUnidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a usuarioUnidad entity.
     *
     */
    public function showAction(UsuarioUnidad $usuarioUnidad)
    {
        $deleteForm = $this->createDeleteForm($usuarioUnidad);

        return $this->render('usuariounidad/show.html.twig', array(
            'usuarioUnidad' => $usuarioUnidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing usuarioUnidad entity.
     *
     */
    public function editAction(Request $request, UsuarioUnidad $usuarioUnidad)
    {
        $deleteForm = $this->createDeleteForm($usuarioUnidad);
        $editForm = $this->createForm('SID\Api\UnityBundle\Form\UsuarioUnidadType', $usuarioUnidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usuariounidad_edit', array('id' => $usuarioUnidad->getId()));
        }

        return $this->render('usuariounidad/edit.html.twig', array(
            'usuarioUnidad' => $usuarioUnidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usuarioUnidad entity.
     *
     */
    public function deleteAction(Request $request, UsuarioUnidad $usuarioUnidad)
    {
        $form = $this->createDeleteForm($usuarioUnidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usuarioUnidad);
            $em->flush();
        }

        return $this->redirectToRoute('usuariounidad_index');
    }

    /**
     * Creates a form to delete a usuarioUnidad entity.
     *
     * @param UsuarioUnidad $usuarioUnidad The usuarioUnidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UsuarioUnidad $usuarioUnidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuariounidad_delete', array('id' => $usuarioUnidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
