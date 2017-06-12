<?php

namespace SID\Api\DrugBundle\Controller;

use SID\Api\DrugBundle\Entity\Division;
use SID\Api\DrugBundle\Entity\Droguero;
use SID\Api\DrugBundle\Entity\Subdivision;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class DivisionController extends Controller
{
    public function showAction(Droguero $droguero, Division $division=null)
    {
        $this->denyAccessUnlessGranted('entry', $droguero);
        if($division == null){
            $division = $droguero;
        }

        if($division->getDroguero()->getId() != $droguero->getId()){
            throw new \Exception("La division y el droguero no concuerdan");
        }

        return $this->render('DrugBundle:Division:show.html.twig', array(
            'division' => $division
        ));
    }

    public function editAction(Droguero $droguero, Subdivision $division)
    {
        $this->denyAccessUnlessGranted('config', $droguero);
        if($division->getId() == $droguero->getId()){
            throw new UnauthorizedHttpException("Bad Qualifier","Operación no permitida");
        }

        if($division->getDroguero()->getId() != $droguero->getId()){
            throw new \Exception("La division y el droguero no concuerdan");
        }

        return $this->render('DrugBundle:Division:edit.html.twig', array(
            'subdivision' => $division
        ));
    }

    public function updateAction(Droguero $droguero, Subdivision $division, Request $request)
    {
        $this->denyAccessUnlessGranted('config', $droguero);
        $division
            ->setAlias($request->get('alias'))
            ->setNombre($request->get('nombre'))
            ->setDetalle($request->get('detalle'));

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('drug_drogueros_division_show', array(
            'droguero' => $division->getDroguero()->getId(),
            'division' => $division->getParent()->getId()
        ));
    }

    public function newAction(Droguero $droguero, Division $division)
    {
        $this->denyAccessUnlessGranted('config', $droguero);
        if($division->getDroguero()->getId() != $droguero->getId()){
            throw new \Exception("La division y el droguero no concuerdan");
        }

        return $this->render('DrugBundle:Division:new.html.twig', array(
            'division' => $division
        ));
    }

    public function createAction(Droguero $droguero, Division $division, Request $request)
    {
        $this->denyAccessUnlessGranted('config', $droguero);
        $subdivision = new Subdivision();
        $subdivision
            ->setAlias($request->get('alias'))
            ->setParent($division)
            ->setNombre($request->get('nombre'))
            ->setDetalle($request->get('detalle'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($subdivision);
        $em->flush();

        return $this->redirectToRoute('drug_drogueros_division_show', array(
            'droguero' => $division->getDroguero()->getId(),
            'division' => $division->getId()
        ));
    }


}
