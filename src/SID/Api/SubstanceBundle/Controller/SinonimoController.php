<?php

namespace SID\Api\SubstanceBundle\Controller;

use SID\Api\SubstanceBundle\Entity\Droga;
use SID\Api\SubstanceBundle\Entity\Sinonimo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Clase controller.
 *
 */
class SinonimoController extends Controller
{
    /**
     * Lists all clase entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clases = $em->getRepository('SubstanceBundle:Sinonimo')->findAll();

        return new JsonResponse(array('data' => $this->serializeClases($clases)));
    }

    protected function serializeClases(array $clases, $populate = false){
        $data = array();
        foreach ($clases as $clase){
            $data[] = $this->serializeClase($clase, $populate);
        }
        return $data;
    }

    public function serializeClase(Sinonimo $clase, $populate = true){
        $data = array(
            'id' => $clase->getId(),
            'nombre' => $clase->getNombre(),
            'detalle' => $this->serializeDroga($clase->getDrogas()->toArray())
        );
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
        $clase = new Sinonimo();
        $clase
            ->setNombre($request->get('nombre'));

        $em = $this->getDoctrine()->getManager();
        $droga = $em->getRepository('SubstanceBundle:Droga')->find($request->get('droga'));

        $droga->addSinonimo($clase);
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
    public function showAction(Sinonimo $clase)
    {
        return new JsonResponse(array(
            'data' => $this->serializeClase($clase)
        ));
    }

    /**
     * Displays a form to edit an existing clase entity.
     *
     */
    public function editAction(Request $request, Sinonimo $clase)
    {
        $clase
            ->setNombre($request->get('nombre', $clase->getNombre()));

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
    public function deleteAction(Request $request, Sinonimo $clase)
    {
        return new JsonResponse();
    }
}
