<?php

namespace SID\Api\UnityBundle\Controller;

use SID\Api\UnityBundle\Entity\UsuarioUnidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Usuariounidad controller.
 *
 */
class UsuarioUnidadController extends Controller
{
    /**
     * Lists all usuarioUnidad entities.
     *
     */
    public function indexAction()
    {
        return new JsonResponse();
    }

    /**
     * Creates a new usuarioUnidad entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('UserBundle:User')->find($request->get('usuario'));
        $unidad = $em->getRepository('UnityBundle:UnidadEjecutora')->find($request->get('unidad'));
        $usuarioUnidad = new UsuarioUnidad($usuario, $unidad);

        $em->persist($usuarioUnidad);
        $em->flush();

        return new JsonResponse(array(
            'status' => 'created'
        ), JsonResponse::HTTP_CREATED);
    }

    /**
     * Finds and displays a usuarioUnidad entity.
     *
     */
    public function showAction(UsuarioUnidad $usuarioUnidad)
    {
        return new JsonResponse();
    }

    /**
     * Displays a form to edit an existing usuarioUnidad entity.
     *
     */
    public function editAction(Request $request, UsuarioUnidad $usuarioUnidad)
    {
        return new JsonResponse();
    }

    /**
     * Deletes a usuarioUnidad entity.
     *
     */
    public function deleteAction(Request $request, UsuarioUnidad $usuarioUnidad)
    {
        return new JsonResponse();
    }
}
