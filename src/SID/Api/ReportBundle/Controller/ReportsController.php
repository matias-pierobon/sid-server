<?php

namespace SID\Api\ReportBundle\Controller;

use SID\Api\DrugBundle\Entity\DrogueroUnidad;
use SID\Api\MovementBundle\Repository\MotivoRepository;
use SID\Api\ReportBundle\Model\Report;
use SID\Api\SubstanceBundle\Entity\EntidadReguladora;
use SID\Api\UnityBundle\Entity\UnidadEjecutora;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SID\Api\UnityBundle\Repository\UnidadEjecutoraRepository;
use \Doctrine\Common\Collections\ArrayCollection;

class ReportsController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('ReportBundle:Reports:index.html.twig', array());
    }

    public function newAction(Request $request)
    {
        /** @var UnidadEjecutoraRepository $unityRepository */
        $unityRepository = $this->getDoctrine()->getRepository('UnityBundle:UnidadEjecutora');
        $unities = $unityRepository->findAll();
        return $this->render('ReportBundle:Reports:new.html.twig', array(
          'unidades' => $unities
        ));
    }

    public function createAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $idUnidad = $request->request->get('unidad');
        /** @var UnidadEjecutoraRepository $unityRepository */
        $unityRepository = $doctrine->getRepository('UnityBundle:UnidadEjecutora');
        /** @var UnidadEjecutora $unity */
        $unity = $unityRepository->find($idUnidad);

        /** @var UnidadEjecutoraRepository $substanceRepository */
        $substanceRepository = $doctrine->getRepository('SubstanceBundle:Droga');
        $substances = $substanceRepository->findAll();

        /** @var MotivoRepository $motiveRepository */
        $motiveRepository = $doctrine->getRepository('MovementBundle:Motivo');
        $motives = $motiveRepository->findAll();

        $from = new \DateTime($request->request->get('from'));
        $to = new \DateTime($request->request->get('to'));

        $report = new Report($substances, $motives, $from, $to);

        /** @var DrogueroUnidad $du */
        foreach ($unity->getDrogueros() as $du) {
            $report->process($du->getDroguero());
        }

        return $this->render('ReportBundle:Reports:report.html.twig', array(
          'report' => $report,
          'unity' => $unity
        ));
    }
}
