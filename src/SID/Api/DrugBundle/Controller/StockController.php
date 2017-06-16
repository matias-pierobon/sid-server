<?php

namespace SID\Api\DrugBundle\Controller;

use SID\Api\DrugBundle\Entity\Division;
use SID\Api\DrugBundle\Entity\Droguero;
use SID\Api\DrugBundle\Entity\Stock;
use SID\Api\DrugBundle\Entity\Subdivision;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class StockController extends Controller
{
    public function addAction(Droguero $droguero, Division $division)
    {

        return $this->render('DrugBundle:Stock:Add', array(
            'droguero' => $droguero,
            'dvision' => $division
        ));
    }


    public function loadAction(Droguero $droguero, Division $division, Request $request)
    {
        $stock = new Stock();

        $em = $this->getDoctrine()->getManager();

        $droga = $em->getRepository('SubstanceBundle:Droga')->find($request->get('droga'));

        $stock
            ->setCantidad($request->get('cantidad'))
            ->setDivision($division)
            ->setDroga($droga)
            ->setFechaVencimiento($request->get('vencimiento'))
            ->setLote($request->get('lote'))
            ->setMarca($request->get('marca'))
            ->setNumeroEvnase($request->get('envase'))
            ->setNumeroProducto($request->get('producto'))
            ->setPesoBruto($request->get('pesoBruto'))
            ->setPesoBrutoActual($request->get('pesoBruto'))
            ->setStockActual(null);
    }


}
