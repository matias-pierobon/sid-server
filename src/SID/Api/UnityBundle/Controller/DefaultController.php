<?php

namespace SID\Api\UnityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('UnityBundle:');
        $data = array();
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
