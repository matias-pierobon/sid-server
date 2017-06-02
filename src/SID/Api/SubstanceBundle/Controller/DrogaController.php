<?php

namespace SID\Api\SubstanceBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use SID\Api\SubstanceBundle\Entity\Droga;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DrogaController extends Controller
{
    public function indexAction()
    {
        $drogas = $this->getDoctrine()->getRepository('SubstanceBundle:Droga')->findAll();
        $drogas = new ArrayCollection($drogas);
        $criteria = Criteria::create()
            ->orderBy(array('nombre' => Criteria::ASC));
        return $this->render('SubstanceBundle:Droga:index.html.twig', array(
            'drogas' => $drogas->matching($criteria)
        ));
    }

    public function showAction(Droga $droga)
    {
        return $this->render('SubstanceBundle:Droga:show.html.twig', array(
            'droga' => $droga
        ));
    }

    public function editAction(Droga $droga)
    {
        return $this->render('SubstanceBundle:Droga:edit.html.twig', array(
            'droga' => $droga
        ));
    }

    public function updateAction(Droga $droga, Request $request) {
        $droga
            ->setNombre($request->get('nombre', $droga->getNombre()));

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('sustancias_show', array('id' => $droga->getId()));
    }

    public function newAction()
    {
       return $this->render('SubstanceBundle:Droga:new.html.twig', array(
        ));
    }

    public function createAction(Request $request) {
        $droga = new Droga();

        $droga
            ->setNombre($request->get('nombre'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($droga);
        $em->flush();

        return $this->redirectToRoute('sustancias_index');
    }

}
