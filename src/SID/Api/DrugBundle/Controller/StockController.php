<?php

namespace SID\Api\DrugBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use SID\Api\DrugBundle\Entity\Division;
use SID\Api\DrugBundle\Entity\Droguero;
use SID\Api\DrugBundle\Entity\Stock;
use SID\Api\MovementBundle\Entity\Movimiento;
use SID\Api\MovementBundle\Entity\MovimientoFisico;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class StockController extends Controller
{
    public function addAction(Droguero $droguero, Division $division)
    {
        $calidades = $this->findAll('Drug', 'Calidad');
        $sustancias = $this->findAll('Substance', 'Droga');
        $motivos = $this->findAll('Movement', 'Motivo');
        return $this->render('DrugBundle:Stock:add.html.twig', array(
            'droguero' => $droguero,
            'division' => $division,
            'sustancias' => $sustancias,
            'calidades' => $calidades,
            'motivos' => $motivos
        ));
    }

    protected function findAll($bundle, $entity)
    {
        $doctrine = $this->getDoctrine();
        $repo = $doctrine->getRepository($bundle . 'Bundle:' . $entity);
        return new ArrayCollection($repo->findAll());
    }


    public function loadAction(Droguero $droguero, Division $division, Request $request)
    {
        $stock = new Stock();

        $em = $this->getDoctrine()->getManager();

        $droga = $em->getRepository('SubstanceBundle:Droga')->find($request->get('sustancia'));
        $motivo = $em->getRepository('MovementBundle:Motivo')->find($request->get('motivo'));
        $calidad = $em->getRepository('DrugBundle:Calidad')->find($request->get('calidad'));

        $cantidad = $request->get('cantidad');
        $peso = $request->get('peso');


        $stock
            ->setCantidad($cantidad)
            ->setDivision($division)
            ->setDroga($droga)
            ->setCalidad($calidad)
            ->setLote($request->get('lote'))
            ->setMarca($request->get('marca'))
            ->setNumeroInterno($request->get('interno'))
            ->setNumeroEvnase($request->get('envase'))
            ->setNumeroProducto($request->get('producto'))
            ->setImageBlob($request->files->get('image'))
            ->setPesoBruto($peso)
            ->setPesoBrutoActual($peso)
            ->setStockActual($cantidad);


        if ($request->get('vencimiento') != "")
            $stock->setFechaVencimiento(new \DateTime($request->get('vencimiento')));

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
        if(!$stock->isActive()){
            $extraction = $stock->getExtraccionActiva();
            if($extraction->getUsuario()->getId() != $this->getUser()->getId())
                throw new UnauthorizedHttpException('Movment', 'El Stock esta en uso');

            $extraction->setHashta(new \DateTime());
        }

        $em = $this->getDoctrine()->getManager();
        $motivo = $em->getRepository('MovementBundle:Motivo')->find($request->get('motivo'));

        $cantidad = floatval($request->get('cantidad'));


        if ($request->get('sum', 'off') != 'on')
            $cantidad = $cantidad * (-1);

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

    public function showAction(Stock $stock)
    {
        return $this->render('DrugBundle:Stock:show.html.twig', array(
            'stock' => $stock
        ));
    }

    public function imageAction(Stock $stock)
    {
        if (!$stock->getImagen()) {
            $file = new File(__DIR__ . '/../Resources/public/image/blank.png');
            $imageFile = fopen($file->getRealPath(), 'r');
            $imageContent = fread($imageFile, $file->getSize());
            fclose($imageFile);
            return new Response($imageContent, 200, array('Content-Type' => $file->getMimeType()));
        }
        return new Response(
            stream_get_contents($stock->getImagen()),
            200,
            array('Content-Type' => $stock->getImageMime())
        );

    }

    public function extractAction(Stock $stock)
    {
        $extraction = new MovimientoFisico();
        $extraction
            ->setUsuario($this->getUser())
            ->setStock($stock);

        $em = $this->getDoctrine()->getManager();

        $em->persist($extraction);
        $em->flush();

        return $this->redirectToRoute('drug_drogueros_show', array(
            'droguero' => $stock->getDivision()->getDroguero()->getId()
        ));
    }


}
