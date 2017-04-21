<?php

namespace SID\Api\SubstanceBundle\Controller;

use SID\Api\SubstanceBundle\Entity\Droga;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Droga controller.
 *
 */
class DrogaController extends Controller
{
    /**
     * Lists all droga entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $drogas = $em->getRepository('SubstanceBundle:Droga')->findAll();

        return new JsonResponse(array('data' => $this->serializeDrogas($drogas)));
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
            'cas' => $droga->getCas(),
            'accionesEmergencia'=>$droga->getAccionesEmergencia(),
            'cid'=>$droga->getCid(),
            'densidad'=>$droga->getDensidad(),
            'desechos'=>$droga->getDesechos(),
            'fechaIngreso'=>$droga->getFechaIngreso(),
            'tipoMedida'=>$droga->getTipoMedida(),
            'fichaSeguridad'=>$droga->getFichaSeguridad()
        );
    }

    /**
     * Creates a new droga entity.
     *
     */
    public function newAction(Request $request)
    {
        $droga = new Droga();
        $droga
            ->setNombre($request->get('nombre'))
            ->setAccionesEmergencia($request->get('accionesEmergencia'))
            ->setCas($request->get('cas'))
            ->setCid($request->get('cid'))
            ->setDensidad($request->get('densidad'))
            ->setFormulaMolecular($request->get('formula'))
            ->setDesechos($request->get('desechos'))
            ->setFichaSeguridad($request->get('fichaSeguridad'))
            ->setTipoMedida($request->get('tipoMedida'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($droga);
        $em->flush();

        return new JsonResponse(array(
            'status' => 'created',
            'data' => $this->serializeDroga($droga)
        ), JsonResponse::HTTP_CREATED);
    }

    /**
     * Finds and displays a droga entity.
     *
     */
    public function showAction(Droga $droga)
    {
        return new JsonResponse(array('data' => $this->serializeDroga($droga)));
    }

    /**
     * Displays a form to edit an existing droga entity.
     *
     */
    public function editAction(Request $request, Droga $droga)
    {
        $droga
            ->setNombre($request->get('nombre'))
            ->setAccionesEmergencia($request->get('accionesEmergencia'))
            ->setCas($request->get('cas'))
            ->setCid($request->get('cid'))
            ->setDensidad($request->get('densidad'))
            ->setFormulaMolecular($request->get('formula'))
            ->setDesechos($request->get('desechos'))
            ->setFichaSeguridad($request->get('fichaSeguridad'))
            ->setTipoMedida($request->get('tipoMedida'));

        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array(
            'status' => 'updated',
            'data' => $this->serializeDroga($droga)
        ), JsonResponse::HTTP_ACCEPTED);
    }

    /**
     * Deletes a droga entity.
     *
     */
    public function deleteAction(Request $request, Droga $droga)
    {
        return new JsonResponse();
    }
}
