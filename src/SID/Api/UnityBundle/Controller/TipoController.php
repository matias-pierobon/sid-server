<?php

namespace SID\Api\UnityBundle\Controller;

use SID\Api\UnityBundle\Entity\Tipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tipo controller.
 *
 */
class TipoController extends Controller
{
    /**
     * Lists all tipo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipos = $em->getRepository('UnityBundle:Tipo')->findAll();

        return new JsonResponse(array('data' => $this->serializeTipos($tipos)));
    }

    protected function serializeTipos(array $tipos){
        $data = array();
        foreach ($tipos as $tipo){
            $data[] = $this->serializeTipo($tipo);
        }
        return $data;
    }

    public function serializeTipo(Tipo $tipo){
        return array(
            'id' => $tipo->getId(),
            'nombre' => $tipo->getNombre(),
            'detalle' => $tipo->getDetalle(),
        );
    }

    /**
     * Creates a new tipo entity.
     *
     */
    public function newAction(Request $request)
    {
        $tipo = new Tipo();
        $tipo
            ->setDetalle($request->get('detalle'))
            ->setNombre($request->get('nombre'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($tipo);
        $em->flush();

        return new JsonResponse(array(
            'status' => 'created',
            'data' => $this->serializeTipo($tipo)
        ), JsonResponse::HTTP_CREATED);
    }

    /**
     * Finds and displays a tipo entity.
     *
     */
    public function showAction(Tipo $tipo)
    {
        return new JsonResponse(array(
            'data' => $this->serializeTipo($tipo)
        ));
    }

    /**
     * Displays a form to edit an existing tipo entity.
     *
     */
    public function editAction(Request $request, Tipo $tipo)
    {
        $tipo
            ->setDetalle($request->get('detalle', $tipo->getDetalle()))
            ->setNombre($request->get('nombre', $tipo->getNombre()));

        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array(
            'status' => 'updated',
            'data' => $this->serializeTipo($tipo)
        ), JsonResponse::HTTP_ACCEPTED);
    }

    /**
     * Deletes a tipo entity.
     *
     */
    public function deleteAction(Request $request, Tipo $tipo)
    {
        return new JsonResponse();
    }
}
