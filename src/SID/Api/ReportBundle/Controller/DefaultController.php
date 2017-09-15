<?php

namespace SID\Api\ReportBundle\Controller;

use SID\Api\SubstanceBundle\Entity\EntidadReguladora;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $entidad = $request->get('entidad');
        $doctrine = $this->getDoctrine();
        if($entidad) {
            /* @var EntidadReguladora $entidad */
            $entidad = $doctrine
                ->getRepository('SubstanceBundle:EntidadReguladora')
                ->find($entidad);
            $drogas = $entidad->getDrogas();
        }else{
            $drogas = $doctrine
                ->getRepository('SubstanceBundle:Droga')
                ->findAll();
        }

        $motivos = $doctrine->getRepository('MovementBundle:Motivo')->findAll();


        return $this->render('ReportBundle:Default:index.html.twig', array(
            'drogas' => $drogas,
            'motivos' => $motivos
        ));
    }
}
