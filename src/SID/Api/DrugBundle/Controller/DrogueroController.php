<?php

namespace SID\Api\DrugBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use SID\Api\DrugBundle\Entity\Division;
use SID\Api\DrugBundle\Entity\Droguero;
use SID\Api\DrugBundle\Entity\Responsable;
use SID\Api\DrugBundle\Entity\Subdivision;
use SID\Api\UnityBundle\Entity\UnidadEjecutora;
use SID\Api\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

        if(!$this->getUser()->isAdmin()){
            $drogueros2 = new ArrayCollection();
            foreach ($drogueros as $droguero){
                if($droguero->hasAccess($this->getUser())){
                    $drogueros2->add($droguero);
                }
            }
            $drogueros = $drogueros2->toArray();
        }

        return new JsonResponse(array('data' => $this->serializeDrogueros($drogueros)));
    }

    protected function serializeDrogueros(array $drogueros, $populate = false){
        $data = array();
        foreach ($drogueros as $droguero){
            $data[] = $this->serializeDroguero($droguero, $populate);
        }
        return $data;
    }

    protected function serializeUnidades(array $unidades){
        $data = array();
        foreach ($unidades as $unidad){
            $data[] = $this->serializeUnidad($unidad->getUnidad());
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
                'nombre' => $droguero->getResponsable()->getUser()->getName(),
                'apellido' => $droguero->getResponsable()->getUser()->getLastname(),
                'email' => $droguero->getResponsable()->getUser()->getEmail(),
                'enabled' => $droguero->getResponsable()->getUser()->isEnabled()
            ),
            'unidades' => $this->serializeUnidades($droguero->getUnidades()->toArray())
        );
        if ($populate) {
            $data['drogas'] = $droguero->getDrogas();
            $data['subdivisiones'] = $this->serializeSubdivisiones($droguero->getSubdivisiones()->toArray());
        }
        return $data;
    }

    protected function serializeSubdivisiones(array $subdivisiones){
        $data = array();
        foreach ($subdivisiones as $subdivision){
            $data[] = $this->serializeSubdivision($subdivision);
        }
        return $data;
    }

    public function serializeSubdivision(Subdivision $subdivision){

        return array(
            'id' => $subdivision->getId(),
            'nombre' => $subdivision->getNombre(),
            'detalle' => $subdivision->getDetalle(),
            'subdivisiones' => $this->serializeSubdivisiones($subdivision->getSubdivisiones()->toArray())
        );
    }

    /**
     * Creates a new droguero entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $em = $this->getDoctrine()->getManager();

        $unidad = $em->getRepository('UnityBundle:UnidadEjecutora')->find($request->get('unidad'));
        $user = $em->getRepository('UserBundle:User')->find($request->get('responsable'));
        if(!$user->hasUnity($unidad)){
            return new JsonResponse(array(
                'status' => 'error',
                'error' => array(
                    'code' => JsonResponse::HTTP_BAD_REQUEST,
                    'message' => 'Responsable no trabaja en la Unidad Ejecutora'
                )
            ), JsonResponse::HTTP_BAD_REQUEST);
        }

        $droguero = new Droguero();
        $droguero
            ->setDetalle($request->get('detalle'))
            ->setNombre($request->get('nombre'))
            ->addUnidad($unidad);

        $responsable = new Responsable();
        $responsable
            ->setDroguero($droguero)
            ->setUser($user);

        $em->persist($responsable);
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
        if( !$droguero->hasAccess($this->getUser()) ){
            return new JsonResponse(array(
                'status' => 'error',
                'error' => array(
                    'code' => JsonResponse::HTTP_UNAUTHORIZED,
                    'message' => 'No tiene permisos para ver este droguero'
                )
            ), JsonResponse::HTTP_UNAUTHORIZED);
        }
        return new JsonResponse(array(
            'data' => $this->serializeDroguero($droguero)
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
