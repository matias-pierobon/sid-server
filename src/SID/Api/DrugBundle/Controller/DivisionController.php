<?php

namespace SID\Api\DrugBundle\Controller;

use SID\Api\DrugBundle\Entity\Division;
use SID\Api\DrugBundle\Entity\Subdivision;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Droguero controller.
 *
 */
class DivisionController extends Controller
{

    public function serializeDivision(Division $division, $populate=true){

        $data = array(
            'id' => $division->getId(),
            'nombre' => $division->getNombre(),
            'detalle' => $division->getDetalle(),
            'droguero' => $division->getDroguero()->getId(),
        );
        if($division instanceof Subdivision){
            $data['alias'] = $division->getAlias();
        }
        if($populate){
            $data['subdivisiones'] = $this->serializeDivisiones($division->getSubdivisiones()->toArray());
            $data['path'] = $this->serializeDivisiones($division->getPath()->toArray());
        }

        return $data;
    }

    /**
     * @param array $divisiones
     * @param bool $populate
     *
     * @return array
     */
    public function serializeDivisiones(array $divisiones, $populate=false)
    {
        $data = array();
        foreach ($divisiones as $division){
            $data[] = $this->serializeDivision($division, $populate);
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

        $parent = $em->getRepository('DrugBundle:Division')->find($request->get('division'));

        $subdivision = new Subdivision();

        $subdivision
            ->setDetalle($request->get('detalle'))
            ->setNombre($request->get('nombre'))
            ->setAlias($request->get('alias'))
            ->setParent($parent);

        $em->persist($subdivision);
        $em->flush();

        return new JsonResponse(array(
            'status' => 'created',
            'data' => $this->serializeDivision($subdivision)
        ), JsonResponse::HTTP_CREATED);
    }

    /**
     * Finds and displays a droguero entity.
     *
     */
    public function showAction(Division $division)
    {
        if( !$division->getDroguero()->hasAccess($this->getUser()) ){
            return new JsonResponse(array(
                'status' => 'error',
                'error' => array(
                    'code' => JsonResponse::HTTP_UNAUTHORIZED,
                    'message' => 'No tiene permisos para ver este droguero'
                )
            ), JsonResponse::HTTP_UNAUTHORIZED);
        }
        return new JsonResponse(array(
            'data' => $this->serializeDivision($division)
        ));
    }
}
