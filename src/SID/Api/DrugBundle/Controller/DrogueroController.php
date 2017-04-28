<?php

namespace SID\Api\DrugBundle\Controller;

use SID\Api\DrugBundle\Entity\Droguero;
use SID\Api\DrugBundle\Entity\Responsable;
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

    protected function serializeDrogueros(array $drogueros, $populate = false){
        $data = array();
        foreach ($drogueros as $droguero){
            $data[] = $this->serializeClase($droguero, $populate);
        }
        return $data;
    }

    protected function serializeUnidades(array $unidades){
        $data = array();
        foreach ($unidades as $unidad){
            $data[] = $this->serializeUnidad($unidad);
        }
        return $data;
    }

    public function serializeUnidad(UnidadEjecutora $unidad){
        return array(
            'id' => $unidad->getId(),
            'nombre' => $unidad->getNombre(),
            'tipo' => $unidad->getTipo()->getNombre()
        );
    }

    public function serializeDroguero(Droguero $droguero, $populate = true){

        $data = array(
            'id' => $droguero->getId(),
            'nombre' => $droguero->getNombre(),
            'fecha' => $droguero->getFechaIngreso(),
            'detalle' => $droguero->getDetalle(),
            'responsable' => array(
                'id' => $droguero->getResponsable()->getUser()->getId(),
                'nombre' => $droguero->getResponsable()->getUser()->getNombre(),
                'apellido' => $droguero->getResponsable()->getUser()->getApellido(),
                'enabled' => $droguero->getResponsable()->getUser()->isEnabled()
            ),
            'unidades' => $this->serializeUnidades($droguero->getUnidades())
        );
        if ($populate) {
            $data['drogas'] = $droguero->getDrogas();
        }
        return $data;
    }

    /**
     * Creates a new droguero entity.
     *
     */
    public function newAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $unidad = $em->getRepository('UnityBundle:Unidad')->find($request->get('unidad'));
        $user = $em->getRepository('UserBundle:User')->find($request->get('responsable'));
        
        $droguero = new Droguero();
        $droguero
            ->setDetalle($request->get('detalle'))
            ->setNombre($request->get('nombre'))
            ->addUnidad($unidad);

        $responsable = new Responsable();
        $responsable
            ->setDroguero($droguero)
            ->setUser($user);

        $em->persist($droguero);
        $em->persist($droguero);
        $em->flush();

        return new JsonResponse(array(
            'status' => 'created',
            'data' => $this->serializeDroguero($droguero)
        ), JsonResponse::HTTP_CREATED);
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
