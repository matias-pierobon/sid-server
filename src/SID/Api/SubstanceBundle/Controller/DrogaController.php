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
    protected function findAll($bundle, $entity)
    {
        $doctrine = $this->getDoctrine();
        $repo = $doctrine->getRepository($bundle . 'Bundle:' . $entity);
        return new ArrayCollection($repo->findAll());
    }

    public function editAction(Droga $droga)
    {

        $criteria = Criteria::create()
            ->orderBy(array('nombre' => Criteria::ASC));
        $criteria2 = Criteria::create()
            ->orderBy(array('detalle' => Criteria::ASC));

        $unidadesMedida = $this->findAll('Substance', 'UnidadMedida')->matching($criteria2);
        $clases = $this->findAll('Substance','Clase')->matching($criteria);
        $entidades = $this->findAll('Substance','EntidadReguladora')->matching($criteria);
        $sinonimos = $this->findAll('Substance','Sinonimo')->matching($criteria);
        $ghs = $this->findAll('Substance','GHS')->matching($criteria2);

        return $this->render('SubstanceBundle:Droga:edit.html.twig', array(
            'droga' => $droga,
            'entidades' => $entidades,
            'clases' => $clases,
            'sinonimos' => $sinonimos,
            'ghs' => $ghs,
            'unidadesMedida' => $unidadesMedida
        ));
    }

    public function updateAction(Droga $droga, Request $request)
    {
        $droga
            ->setNombre($request->get('nombre', $droga->getNombre()))
            ->setFormulaMolecular($request->get('formula', $droga->getFormulaMolecular()))
            ->setCas($request->get('cas', $droga->getCas()))
            ->setDensidad($request->get('densidad', $droga->getDensidad()))
            ->setRecAlm($request->get('recAlm', $droga->getRecAlm()))
            ->setDesechos($request->get('desechos', $droga->getDesechos()))
            ->setAccionesEmergencia($request->get('emergencias', $droga->getAccionesEmergencia()));

        $em = $this->getDoctrine()->getManager();

        $unidadRepository = $em->getRepository('SubstanceBundle:UnidadMedida');
        $droga->setUnidadMedida($unidadRepository->find($request->get('medida')));

        $clases = new ArrayCollection($request->get('clases', array()));
        foreach ($droga->getClases() as $clase) {
            if(!$clases->contains($clase->getId())){
                $droga->removeClase($clase);
            }
        }
        $claseRepository = $em->getRepository('SubstanceBundle:Clase');
        foreach ($clases as $clase) {
            $droga->addClase($claseRepository->find($clase));
        }


        $sinonimos = new ArrayCollection($request->get('sinonimos', array()));
        foreach ($droga->getSinonimos() as $sinonimo) {
            if(!$sinonimos->contains($sinonimo->getId())){
                $droga->removeSinonimo($sinonimo);
            }
        }
        $sinonimoRepository = $em->getRepository('SubstanceBundle:Sinonimo');
        foreach ($sinonimos as $sinonimo) {
            $droga->addSinonimo($sinonimoRepository->find($sinonimo));
        }

        $ghs = new ArrayCollection($request->get('ghs', array()));
        foreach ($droga->getGhs() as $gh) {
            if(!$ghs->contains($gh->getId())){
                $droga->removeGh($gh);
            }
        }
        $ghsRepository = $em->getRepository('SubstanceBundle:GHS');
        foreach ($ghs as $gh) {
            $droga->addGh($ghsRepository->find($gh));
        }

        $entidades = new ArrayCollection($request->get('entidades', array()));
        foreach ($droga->getEntidades() as $entidad) {
            if(!$entidades->contains($entidad->getId())){
                $droga->removeEntidade($entidad);
            }
        }
        $entidadesRepository = $em->getRepository('SubstanceBundle:EntidadReguladora');
        foreach ($entidades as $entidad) {
            $droga->addEntidade($entidadesRepository->find($entidad));
        }


        $em->flush();

        return $this->redirectToRoute('sustancias_show', array('id' => $droga->getId()));
    }

    public function newAction()
    {
        $criteria = Criteria::create()
            ->orderBy(array('nombre' => Criteria::ASC));
        $criteria2 = Criteria::create()
            ->orderBy(array('detalle' => Criteria::ASC));

        $unidadesMedida = $this->findAll('Substance', 'UnidadMedida')->matching($criteria2);
        $clases = $this->findAll('Substance','Clase')->matching($criteria);
        $entidades = $this->findAll('Substance','EntidadReguladora')->matching($criteria);
        $sinonimos = $this->findAll('Substance','Sinonimo')->matching($criteria);
        $ghs = $this->findAll('Substance','GHS')->matching($criteria2);

        return $this->render('SubstanceBundle:Droga:new.html.twig', array(
            'entidades' => $entidades,
            'clases' => $clases,
            'sinonimos' => $sinonimos,
            'ghs' => $ghs,
            'unidadesMedida' => $unidadesMedida
        ));
    }

    public function createAction(Request $request)
    {
        $droga = new Droga();

        $droga
            ->setNombre($request->get('nombre'))
            ->setFormulaMolecular($request->get('formula'))
            ->setCas($request->get('cas', $droga->getCas()))
            ->setDensidad($request->get('densidad'))
            ->setRecAlm($request->get('recAlm'))
            ->setDesechos($request->get('desechos'))
            ->setAccionesEmergencia($request->get('emergencias'));

        $em = $this->getDoctrine()->getManager();

        $unidadRepository = $em->getRepository('SubstanceBundle:UnidadMedida');
        $droga->setUnidadMedida($unidadRepository->find($request->get('medida')));

        $claseRepository = $em->getRepository('SubstanceBundle:Clase');
        foreach ($request->get('clases', array()) as $clase) {
            $droga->addClase($claseRepository->find($clase));
        }

        $sinonimoRepository = $em->getRepository('SubstanceBundle:Sinonimo');
        foreach ($request->get('sinonimos', array()) as $sinonimo) {
            $droga->addSinonimo($sinonimoRepository->find($sinonimo));
        }

        $ghsRepository = $em->getRepository('SubstanceBundle:GHS');
        foreach ($request->get('ghs', array()) as $ghs) {
            $droga->addGh($ghsRepository->find($ghs));
        }

        $entidadesRepository = $em->getRepository('SubstanceBundle:EntidadReguladora');
        foreach ($request->get('entidades', array()) as $entidad) {
            $droga->addEntidade($entidadesRepository->find($entidad));
        }


        $em->persist($droga);
        $em->flush();

        return $this->redirectToRoute('sustancias_index');
    }

}
