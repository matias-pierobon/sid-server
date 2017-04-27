<?php

namespace SID\Api\SubstanceBundle\Controller;

use SID\Api\SubstanceBundle\Entity\Clase;
use SID\Api\SubstanceBundle\Entity\Droga;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Clase controller.
 *
 */
class ClaseController extends Controller
{
    /**
     * Lists all clase entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clases = $em->getRepository('SubstanceBundle:Clase')->findAll();

        return new JsonResponse(array('data' => $this->serializeClases($clases)));
    }

    protected function serializeClases(array $clases, $populate = false){
        $data = array();
        foreach ($clases as $clase){
            $data[] = $this->serializeClase($clase, $populate);
        }
        return $data;
    }

    public function serializeClase(Clase $clase, $populate = true){
        $data = array(
            'id' => $clase->getId(),
            'nombre' => $clase->getNombre(),
            'detalle' => $clase->getDetalle()
        );
        if ($populate) {
            $data['incompatibilidades'] = $this->serializeClases($clase->incompatibilidades());
            $data['drogas'] = $this->serializeDroga($clase->getDrogas());
        }
        return $data;
    }

    protected function serializeDrogas(array $drogas){
        $data = array();
        foreach ($drogas as $droga){
            $data[] = $this->serializeDroga($droga);
        }
        return $data;
    }

    public function serializeDroga(Droga $droga){
        return array(
            'id' => $droga->getId(),
            'nombre' => $droga->getNombre(),
            'formula' => $droga->getFormulaMolecular(),
            'cas' => $droga->getCas()
        );
    }

    /**
     * Creates a new clase entity.
     *
     */
    public function newAction(Request $request)
    {
        $clase = new Clase();
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
    public function showAction(Clase $clase)
    {
        return new JsonResponse(array(
            'data' => $this->serializeClase($clase)
        ));
    }

    /**
     * Displays a form to edit an existing clase entity.
     *
     */
    public function editAction(Request $request, Clase $clase)
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
