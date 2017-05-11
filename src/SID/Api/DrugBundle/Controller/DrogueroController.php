<?php

namespace SID\Api\DrugBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use SID\Api\DrugBundle\Entity\Acceso;
use SID\Api\DrugBundle\Entity\Division;
use SID\Api\DrugBundle\Entity\Droguero;
use SID\Api\DrugBundle\Entity\Responsable;
use SID\Api\DrugBundle\Entity\Subdivision;
use SID\Api\UnityBundle\Entity\UnidadEjecutora;
use SID\Api\UnityBundle\Entity\UsuarioUnidad;
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
            'responsable' => $this->serializeUser($droguero->getResponsable()->getUser()),
            'unidades' => $this->serializeUnidades($droguero->getUnidades()->toArray())
        );
        if ($populate) {
            $data['drogas'] = $droguero->getDrogas();
            $data['subdivisiones'] = $this->serializeSubdivisiones($droguero->getSubdivisiones()->toArray());
        }
        return $data;
    }

    public function serializeUser(User $user){

        return array(
            'id' => $user->getId(),
            'nombre' => $user->getName(),
            'apellido' => $user->getLastname(),
            'email' => $user->getEmail(),
            'enabled' => $user->isEnabled()
        );
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
        if(
            !$droguero->hasAccess($this->getUser()) ||
            !( $droguero->getResponsable()->getId() == $this->getUser()->getId() )
        ){
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

    public function serializeAccesos($accesos){
        $data = array();
        foreach ($accesos as $acceso){
            $data[] = $this->serializeAcceso($acceso);
        }
        return $data;
    }

    public function serializeAcceso(Acceso $acceso){

        return array(
            'id' => $acceso->getId(),
            'desde' => $acceso->getDesde(),
            'hasta' => $acceso->getHasta(),
            'usuario' => $this->serializeUser($acceso->getUser())
        );
    }

    public function usersAction(Droguero $droguero){
        if( !( $droguero->getResponsable()->getId() == $this->getUser()->getId() ) ){
            return new JsonResponse(array(
                'status' => 'error',
                'error' => array(
                    'code' => JsonResponse::HTTP_UNAUTHORIZED,
                    'message' => 'No tiene permisos para ver este droguero'
                )
            ), JsonResponse::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse(array(
            'data' => $this->serializeAccesos($droguero->getAccesos()->toArray())
        ));
    }

    public function grantAction(Request $request, Droguero $droguero){
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('UserBundle:User')->find($request->get('usuario'));
        $droguero->addAcceso($usuario);
        $em->flush();

        return new JsonResponse(array(
            'status' => 'created',
            'data' => $this->serializeAccesos($droguero->getAccesos()->toArray())
        ), JsonResponse::HTTP_CREATED);
    }

    public function revoke(Request $request, Droguero $droguero){
        return new JsonResponse();
    }
}
