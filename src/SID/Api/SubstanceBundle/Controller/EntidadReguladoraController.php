<?php

namespace SID\Api\SubstanceBundle\Controller;

use SID\Api\SubstanceBundle\Entity\EntidadReguladora;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        return new JsonResponse(array('data' => $this->serializeEntidades($entidadReguladoras)));
    }

    protected function serializeDrogas(array $entidades){
        $data = array();
        foreach ($entidades as $entidad){
            $data[] = $this->serializeEntidad($entidad);
        }
        return $data;
    }

    public function serializeEntidad(EntidadReguladora $entidad){
        return array(
            'id' => $entidad->getId(),
            'nombre' => $entidad->getNombre(),
            'detalle' => $entidad->getDetalle()
        );
    }

    /**
     * Creates a new entidadReguladora entity.
     *
     */
    public function newAction(Request $request)
    {
        $entidad = new Entidadreguladora();
        $entidad
            ->setDetalle($request->get('detalle'))
            ->setNombre($request->get('nombre'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($entidad);
        $em->flush();

        return new JsonResponse(array(
            'status' => 'created',
            'data' => $this->serializeEntidad($entidad)
        ), JsonResponse::HTTP_CREATED);
    }

    /**
     * Finds and displays a entidadReguladora entity.
     *
     */
    public function showAction(EntidadReguladora $entida)
    {
        return new JsonResponse(array('data' => $this->serializeEntidad($entida)));
    }

    /**
     * Displays a form to edit an existing entidadReguladora entity.
     *
     */
    public function editAction(Request $request, EntidadReguladora $entidad)
    {
        $entidad
            ->setDetalle($request->get('detalle'))
            ->setNombre($request->get('nombre'));

        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array(
            'status' => 'updated',
            'data' => $this->serializeEntidad($entidad)
        ), JsonResponse::HTTP_ACCEPTED);
    }

    /**
     * Deletes a entidadReguladora entity.
     *
     */
    public function deleteAction(Request $request, EntidadReguladora $entidadReguladora)
    {
        return new JsonResponse();
    }
}
