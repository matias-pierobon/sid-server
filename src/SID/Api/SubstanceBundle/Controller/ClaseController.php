<?php

namespace SID\Api\SubstanceBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use SID\Api\SubstanceBundle\Entity\Clase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ClaseController extends Controller
{
    public function indexAction()
    {
        $clases = $this->getDoctrine()->getRepository('SubstanceBundle:Clase')->findAll();
        $clases = new ArrayCollection($clases);
        $criteria = Criteria::create()
            ->orderBy(array('nombre' => Criteria::ASC));
        return $this->render('SubstanceBundle:Clase:index.html.twig', array(
            'clases' => $clases->matching($criteria)
        ));
    }

    public function showAction(Clase $clase)
    {
        return $this->render('SubstanceBundle:Clase:show.html.twig', array(
            'clase' => $clase
        ));
    }

    public function editAction(Clase $clase)
    {
        $clases = $this->getDoctrine()->getRepository('SubstanceBundle:Clase')->findAll();
        $clases = new ArrayCollection($clases);
        $criteria = Criteria::create()
            ->orderBy(array('nombre' => Criteria::ASC));

        return $this->render('SubstanceBundle:Clase:edit.html.twig', array(
            'clase' => $clase,
            'clases' => $clases->matching($criteria)
        ));
    }

    public function updateAction(Clase $clase, Request $request) {
        $clase
            ->setDetalle($request->get('detalle', $clase->getDetalle()))
            ->setNombre($request->get('nombre', $clase->getNombre()));

        $em = $this->getDoctrine()->getManager();
        $claseRepository = $em->getRepository('SubstanceBundle:Clase');

        $incompatibilidades = new ArrayCollection($request->get('incompatibilidades', array()));

        foreach ($clase->getIncompatibleCon() as $incompatibilidad) {
            if(!$incompatibilidades->contains($incompatibilidad->getId())){
                $clase->removeIncompatibleCon($incompatibilidad);
            }
        }

        foreach ($incompatibilidades as $incompatibilidad) {
            $clase->addIncompatibleCon($claseRepository->find($incompatibilidad));
        }



        $em->flush();

        return $this->redirectToRoute('clases_sustancias_show', array('id' => $clase->getId()));
    }

    public function newAction()
    {
        $clases = $this->getDoctrine()->getRepository('SubstanceBundle:Clase')->findAll();
        $clases = new ArrayCollection($clases);
        $criteria = Criteria::create()
            ->orderBy(array('nombre' => Criteria::ASC));

        return $this->render('SubstanceBundle:Clase:new.html.twig', array(
            'clases' => $clases->matching($criteria)
        ));
    }

    public function createAction(Request $request) {
        $clase = new Clase();

        $clase
            ->setDetalle($request->get('detalle'))
            ->setNombre($request->get('nombre'));

        $em = $this->getDoctrine()->getManager();
        $claseRepository = $em->getRepository('SubstanceBundle:Clase');
        foreach ($request->get('incompatibilidades', array()) as $incompatibilidad) {
            $clase->addIncompatibleCon($claseRepository->find($incompatibilidad));
        }

        $em->persist($clase);
        $em->flush();

        return $this->redirectToRoute('clases_sustancias_index');
    }

    public function deleteAction(LugarFisico $lugar) {
        throw new UnauthorizedHttpException("barear");
    }

}
