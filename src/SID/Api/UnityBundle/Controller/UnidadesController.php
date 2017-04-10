<?php

namespace SID\Api\UnityBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use SID\Api\UnityBundle\Entity\UnidadEjecutora;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class UnidadesController extends Controller
{
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('UnityBundle:UnidadEjecutora');
        $data = new ArrayCollection();
        foreach ($repo->findAll() as $unidad){
            $data.add($unidad);
        }
        return new JsonResponse($data);
    }

    public function createAction()
    {
        $repo = $this->getDoctrine()->getRepository('UnityBundle:');
        $data = array();
        return new JsonResponse($data);
    }

    public function readAction(int $id)
    {
        $repo = $this->getDoctrine()->getRepository('UnityBundle:');
        $data = array();
        return new JsonResponse($data);
    }

    public function updateAction(int $id)
    {
        $repo = $this->getDoctrine()->getRepository('UnityBundle:');
        $data = array();
        return new JsonResponse($data);
    }

    public function deleteAction(int $id)
    {
        $repo = $this->getDoctrine()->getRepository('UnityBundle:');
        $data = array();
        return new JsonResponse($data);
    }
}
