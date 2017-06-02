<?php

namespace SID\Api\SubstanceBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use SID\Api\SubstanceBundle\Entity\Clase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClaseController extends Controller
{
    public function indexAction()
    {
        $clases = $this->getDoctrine()->getRepository('SubstanceBundle:Clase')->findAll();
        $clases = new ArrayCollection($clases);
        $criteria = Criteria::create()
            ->orderBy('nombre', Criteria::ASC);
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
            ->orderBy('nombre', Criteria::ASC);

        return $this->render('SubstanceBundle:Clase:edit.html.twig', array(
            'clase' => $clase,
            'clases' => $clases->matching($criteria)
        ));
    }

    public function newAction()
    {
        $clases = $this->getDoctrine()->getRepository('SubstanceBundle:Clase')->findAll();
        $clases = new ArrayCollection($clases);
        $criteria = Criteria::create()
            ->orderBy('nombre', Criteria::ASC);

        return $this->render('SubstanceBundle:Clase:new.html.twig', array(
            'clases' => $clases->matching($criteria)
        ));
    }

}
