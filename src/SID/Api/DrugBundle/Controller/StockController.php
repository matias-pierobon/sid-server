<?php

namespace SID\Api\DrugBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use SID\Api\DrugBundle\Entity\Division;
use SID\Api\DrugBundle\Entity\Droguero;
use SID\Api\DrugBundle\Entity\Stock;
use SID\Api\MovementBundle\Entity\Movimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StockController extends Controller
{
    public function addAction(Droguero $droguero, Division $division)
    {
        $unidadesMedida = $this->findAll('Substance', 'UnidadMedida');
        $calidades = $this->findAll('Drug', 'Calidad');
        $sustancias = $this->findAll('Substance', 'Droga');
        $motivos = $this->findAll('Movement', 'Motivo');
        return $this->render('DrugBundle:Stock:add.html.twig', array(
            'droguero' => $droguero,
            'division' => $division,
            'unidadesMedida' => $unidadesMedida,
            'sustancias' => $sustancias,
            'calidades' => $calidades,
            'motivos' => $motivos
        ));
    }

    protected function findAll($bundle, $entity){
        $doctrine = $this->getDoctrine();
        $repo = $doctrine->getRepository($bundle . 'Bundle:' . $entity );
        return new ArrayCollection($repo->findAll());
    }


    public function loadAction(Droguero $droguero, Division $division, Request $request)
    {
        $stock = new Stock();

        $em = $this->getDoctrine()->getManager();

        $droga = $em->getRepository('SubstanceBundle:Droga')->find($request->get('sustancia'));
        $motivo = $em->getRepository('MovementBundle:Motivo')->find($request->get('motivo'));
        $calidad = $em->getRepository('DrugBundle:Calidad')->find($request->get('calidad'));
        $medida = $em->getRepository('SubstanceBundle:UnidadMedida')->find($request->get('medida'));

        $cantidad = $request->get('cantidad');
        $peso = $request->get('peso');


        $stock
            ->setCantidad($cantidad)
            ->setDivision($division)
            ->setDroga($droga)
            ->setCalidad($calidad)
            ->setUnidadMedida($medida)
            ->setFechaVencimiento(new \DateTime($request->get('vencimiento')))
            ->setLote($request->get('lote'))
            ->setMarca($request->get('marca'))
            ->setNumeroEvnase($request->get('envase'))
            ->setNumeroProducto($request->get('producto'))
            ->setPesoBruto($peso)
            ->setPesoBrutoActual($peso)
            ->setStockActual($cantidad);

        $em->persist($stock);

        $movimiento = new Movimiento();
        $movimiento
            ->setCantidad($cantidad)
            ->setDesde(new \DateTime())
            ->setHasta(new \DateTime())
            ->setMotivo($motivo)
            ->setStock($stock)
            ->setUsuario($this->getUser());

        $em->persist($movimiento);
        $em->flush();

        return $this->redirectToRoute('drug_drogueros_division_show', array(
            'droguero' => $division->getDroguero()->getId(),
            'division' => $division->getId()
        ));
    }

    public function movementAction(Stock $stock)
    {
        $motivos = $this->findAll('Movement', 'Motivo');
        return $this->render('DrugBundle:Stock:movement.html.twig', array(
            'stock' => $stock,
            'motivos' => $motivos
        ));
    }

    public function doMovementAction(Stock $stock, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $motivo = $em->getRepository('MovementBundle:Motivo')->find($request->get('motivo'));

        $cantidad = floatval($request->get('cantidad'));

        $stock->setCantidad($stock->getCantidad() + $cantidad);

        $movimiento = new Movimiento();
        $movimiento
            ->setCantidad($cantidad)
            ->setDesde(new \DateTime())
            ->setHasta(new \DateTime())
            ->setMotivo($motivo)
            ->setStock($stock)
            ->setComentario($request->get('comentario'))
            ->setUsuario($this->getUser());

        $em->persist($movimiento);
        $em->flush();

        return $this->redirectToRoute('drug_drogueros_division_show', array(
            'droguero' => $stock->getDivision()->getDroguero()->getId(),
            'division' => $stock->getDivision()->getId()
        ));

    }


}
