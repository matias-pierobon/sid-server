<?php

namespace SID\Api\MovementBundle\Controller;

use SID\Api\MovementBundle\Entity\Motivo;
use SID\Api\SubstanceBundle\Entity\Clase;
use SID\Api\SubstanceBundle\Entity\Droga;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Clase controller.
 *
 */
class MotivoController extends Controller
{
    /**
     * Lists all clase entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clases = $em->getRepository('MovementBundle:Motivo')->findAll();

        return new JsonResponse(array('data' => $this->serializeClases($clases)));
    }

    protected function serializeClases(array $clases){
        $data = array();
        foreach ($clases as $clase){
            $data[] = $this->serializeClase($clase);
        }
        return $data;
    }

    public function serializeClase(Motivo $clase){
        return array(
            'id' => $clase->getId(),
            'nombre' => $clase->getNombre(),
            'detalle' => $clase->getDetalle()
        );
    }

    /**
     * Creates a new clase entity.
     *
     */
    public function newAction(Request $request)
    {
        $clase = new Motivo();
        $clase
            ->setNombre($request->get('nombre'))
            ->setDetalle($request->get('detalle'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($clase);
        $em->flush();

        return new JsonResponse(array(
            'status' => 'created',
            'data' => $this->serializeClase($clase)
        ), JsonResponse::HTTP_CREATED);
    }

    /**
     * Finds and displays a clase entity.
     *
     */
    public function showAction(Motivo $clase)
    {
        return new JsonResponse(array(
            'data' => $this->serializeClase($clase)
        ));
    }

    /**
     * Displays a form to edit an existing clase entity.
     *
     */
    public function editAction(Request $request, Motivo $clase)
    {
        $clase
            ->setNombre($request->get('nombre', $clase->getNombre()))
            ->setDetalle($request->get('detalle', $clase->getDetalle()));

        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array(
            'status' => 'updated',
            'data' => $this->serializeClase($clase)
        ), JsonResponse::HTTP_ACCEPTED);
    }

    /**
     * Deletes a clase entity.
     *
     */
    public function deleteAction(Request $request, Clase $clase)
    {
        return new JsonResponse();
    }
}
