<?php

namespace SID\Api\UnityBundle\Controller;

use SID\Api\UnityBundle\Entity\Tipo;
use SID\Api\UnityBundle\Entity\UnidadEjecutora;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unidadejecutora controller.
 *
 */
class UnidadEjecutoraController extends Controller
{
    /**
     * Lists all unidadEjecutora entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $unidadesEjecutoras = $em->getRepository('UnityBundle:UnidadEjecutora')->findAll();

        return new JsonResponse(array('data' => $this->serializeUnidades($unidadesEjecutoras)));
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
            'detalle' => $unidad->getDetalle(),
            'cufe' => $unidad->getCufe(),
            'tipo' => $this->serializeTipo($unidad->getTipo())
        );
    }

    public function serializeTipo(Tipo $tipo){
        return array(
            'id' => $tipo->getId(),
            'nombre' => $tipo->getNombre(),
            'detalle' => $tipo->getDetalle(),
        );
    }

    /**
     * Creates a new unidadEjecutora entity.
     *
     */
    public function newAction(Request $request)
    {
        $unidadEjecutora = new Unidadejecutora();

        $em = $this->getDoctrine()->getManager();
        $tipo = $em->getRepository('UnityBundle:Tipo')->find($request->get('tipo'));

        $unidadEjecutora
            ->setDetalle($request->get('detalle'))
            ->setCufe($request->get('cufe'))
            ->setTipo($tipo)
            ->setNombre($request->get('nombre'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($unidadEjecutora);
        $em->flush();

        return new JsonResponse(array(
            'status' => 'created',
            'data' => $this->serializeUnidad($unidadEjecutora)
        ), JsonResponse::HTTP_CREATED);
    }

    /**
     * Finds and displays a unidadEjecutora entity.
     *
     */
    public function showAction(UnidadEjecutora $unidadEjecutora)
    {
        return new JsonResponse(array(
            'data' => $this->serializeUnidad($unidadEjecutora)
        ));
    }

    /**
     * Displays a form to edit an existing unidadEjecutora entity.
     *
     */
    public function editAction(Request $request, UnidadEjecutora $unidadEjecutora)
    {
        $em = $this->getDoctrine()->getManager();
        $tipo = $em
            ->getRepository('UnityBundle:Tipo')
            ->find($request->get('tipo', $unidadEjecutora->getTipo()->getId()));

        $unidadEjecutora
            ->setDetalle($request->get('detalle', $unidadEjecutora->getDetalle()))
            ->setCufe($request->get('cufe', $unidadEjecutora->getCufe()))
            ->setTipo($tipo)
            ->setNombre($request->get('nombre', $unidadEjecutora->getNombre()));

        $em->flush();

        return new JsonResponse(array(
            'status' => 'updated',
            'data' => $this->serializeUnidad($unidadEjecutora)
        ), JsonResponse::HTTP_ACCEPTED);
    }

    /**
     * Deletes a unidadEjecutora entity.
     *
     */
    public function deleteAction(UnidadEjecutora $unidadEjecutora)
    {
        return new JsonResponse();
    }
}
