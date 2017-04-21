<?php

namespace SID\Api\DrugBundle\Controller;

use SID\Api\DrugBundle\Entity\Droguero;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Droguero controller.
 *
 */
class DrogueroController extends Controller
{
    /**
     * Lists all droguero entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $drogueros = $em->getRepository('DrugBundle:Droguero')->findAll();

        return new JsonResponse(array('data' => $this->serializeDrogueros($drogueros)));
    }

    protected function serializeDrogueros(array $drogueros, boolean $populate = false){
        $data = array();
        foreach ($drogueros as $droguero){
            $data[] = $this->serializeClase($droguero, $populate);
        }
        return $data;
    }

    public function serializeDroguero(Droguero $droguero, boolean $populate = true){
        $data = array(
            'id' => $droguero->getId(),
            'nombre' => $droguero->getNombre(),
            'apellido' => $droguero->getFechaIngreso(),
            'email' => $droguero->get(),
            'enabled' => $droguero->isEnabled()
        );
        if ($populate) {
            $data['incompatibilidades'] = $this->serializeClases($droguero->incompatibilidades());
            $data['drogas'] = $this->serializeDroga($droguero->getDrogas());
        }
        return $data;
    }

    /**
     * Creates a new droguero entity.
     *
     */
    public function newAction(Request $request)
    {
        $droguero = new Droguero();
        $form = $this->createForm('SID\Api\DrugBundle\Form\DrogueroType', $droguero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($droguero);
            $em->flush($droguero);

            return $this->redirectToRoute('droguero_show', array('id' => $droguero->getId()));
        }

        return $this->render('droguero/new.html.twig', array(
            'droguero' => $droguero,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a droguero entity.
     *
     */
    public function showAction(Droguero $droguero)
    {
        $deleteForm = $this->createDeleteForm($droguero);

        return $this->render('droguero/show.html.twig', array(
            'droguero' => $droguero,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing droguero entity.
     *
     */
    public function editAction(Request $request, Droguero $droguero)
    {
        $deleteForm = $this->createDeleteForm($droguero);
        $editForm = $this->createForm('SID\Api\DrugBundle\Form\DrogueroType', $droguero);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('droguero_edit', array('id' => $droguero->getId()));
        }

        return $this->render('droguero/edit.html.twig', array(
            'droguero' => $droguero,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a droguero entity.
     *
     */
    public function deleteAction(Request $request, Droguero $droguero)
    {
        $form = $this->createDeleteForm($droguero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($droguero);
            $em->flush();
        }

        return $this->redirectToRoute('droguero_index');
    }

    /**
     * Creates a form to delete a droguero entity.
     *
     * @param Droguero $droguero The droguero entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Droguero $droguero)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('droguero_delete', array('id' => $droguero->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
