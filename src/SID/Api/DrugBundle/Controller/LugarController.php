<?php

namespace SID\Api\DrugBundle\Controller;

use SID\Api\DrugBundle\Entity\LugarFisico;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LugarController extends Controller
{
    public function indexAction() {
        $lugares = $this->getDoctrine()->getRepository('DrugBundle:LugarFisico')->findAll();
        return $this->render('DrugBundle:Lugar:index.html.twig', array(
            'lugares' => $lugares
        ));
    }

    public function newAction() {
        return $this->render('DrugBundle:Lugar:new.html.twig');
    }

    public function createAction(Request $request) {
        $lugar = new LugarFisico();

        $lat = $request->get('lat');
        $lat = trim($lat) == "" ? null : $lat;

        $long = $request->get('long');
        $long = trim($long) == "" ? null : $long;

        $lugar
            ->setDetalle($request->get('detalle'))
            ->setImageBlob($request->files->get('image'))
            ->setLatitud($lat)
            ->setLongitud($long)
            ->setNombre($request->get('nombre'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($lugar);
        $em->flush();

        return $this->redirectToRoute('lugares_fisicos_index');
    }

    public function showAction(LugarFisico $lugar) {
        return $this->render('DrugBundle:Lugar:show.html.twig', array(
            'lugar' => $lugar
        ));
    }

    public function editAction(LugarFisico $lugar) {
        return $this->render('DrugBundle:Lugar:edit.html.twig', array(
            'lugar' => $lugar
        ));
    }

    public function updateAction(LugarFisico $lugar, Request $request) {
        $lat = $request->get('lat', $lugar->getLatitud());
        $lat = trim($lat) == "" ? null : $lat;

        $long = $request->get('long', $lugar->getLongitud());
        $long = trim($long) == "" ? null : $long;

        $lugar
            ->setDetalle($request->get('detalle', $lugar->getDetalle()))
            ->setLatitud($lat)
            ->setLongitud($long)
            ->setNombre($request->get('nombre', $lugar->getNombre()));

        if($request->files->get('image', null)){
            $lugar->setImageBlob($request->files->get('image'));
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('lugares_fisicos_show', array('id' => $lugar->getId()));
    }

    public function deleteAction(LugarFisico $lugar) {

    }

    public function imageAction(LugarFisico $lugar) {
        if (!$lugar->getImage()) {
            $file = new File(__DIR__ . '/../Resources/public/image/blank.png');
            $imageFile = fopen($file->getRealPath(), 'r');
            $imageContent = fread($imageFile, $file->getSize());
            fclose($imageFile);
            return new Response($imageContent, 200, array('Content-Type' => $file->getMimeType()));
        }

        return new Response(
            stream_get_contents($lugar->getImage()),
            200,
            array('Content-Type' => $lugar->getImageMime())
        );
    }

}
