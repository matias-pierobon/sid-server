<?php

namespace SID\Api\DrugBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use SID\Api\DrugBundle\Entity\Acceso;
use SID\Api\DrugBundle\Entity\Droguero;
use SID\Api\DrugBundle\Entity\DrogueroUnidad;
use SID\Api\DrugBundle\Entity\Responsable;
use SID\Api\UnityBundle\Entity\UsuarioUnidad;
use SID\Api\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class DrogueroController extends Controller
{
    public function indexAction()
    {
        $droguerosRef = $this->getDoctrine()->getRepository('DrugBundle:Droguero')->findAll();

        $drogueros = new ArrayCollection();

        foreach ($droguerosRef as $droguero) {
            if($this->isGranted('view', $droguero))
                $drogueros->add($droguero);
        }

        $criteria = Criteria::create()
            ->orderBy(array('nombre' => Criteria::ASC));

        return $this->render('DrugBundle:Droguero:index.html.twig', array(
            'drogueros' => $drogueros->matching($criteria)
        ));
    }

    public function showAction(Droguero $droguero)
    {
        $this->denyAccessUnlessGranted('entry', $droguero);

        return $this->render('DrugBundle:Droguero:show.html.twig', array(
            'droguero' => $droguero
        ));
    }

    public function editAction(Droguero $droguero)
    {
        $this->denyAccessUnlessGranted('edit', $droguero);

        $doctrine = $this->getDoctrine();

        $criteria = Criteria::create()
            ->orderBy(array('nombre' => Criteria::ASC));

        $lugares = new ArrayCollection($doctrine->getRepository('DrugBundle:LugarFisico')->findAll());
        $unidades = new ArrayCollection($doctrine->getRepository('UnityBundle:UnidadEjecutora')->findAll());

        return $this->render('DrugBundle:Droguero:edit.html.twig', array(
            'droguero' => $droguero,
            'lugares' => $lugares->matching($criteria),
            'unidades' => $unidades->matching($criteria)
        ));
    }

    public function updateAction(Droguero $droguero, Request $request)
    {
        $lat = $request->get('lat', $droguero->getLatitud());
        $lat = trim($lat) == "" ? null : $lat;

        $long = $request->get('long', $droguero->getLongitud());
        $long = trim($long) == "" ? null : $long;


        $em = $this->getDoctrine()->getManager();

        $lugar = $em
            ->getRepository('DrugBundle:LugarFisico')
            ->find($request->get('lugar'));

        $droguero
            ->setLatitud($lat)
            ->setLongitud($long)
            ->setNumero($request->get('numero', $droguero->getNumero()))
            ->setLugar($lugar)
            ->setNombre($request->get('nombre', $droguero->getNombre()))
            ->setDetalle($request->get('detalle', $droguero->getDetalle()));

        if($request->files->get('image', null)){
            $droguero->setImageBlob($request->files->get('image'));
        }

        $unityRepository = $em->getRepository('UnityBundle:UnidadEjecutora');
        $unidades =  new ArrayCollection($request->get('unidades', array()));

        /* @var DrogueroUnidad $unidad */
        foreach ($droguero->getUnidades() as $unidad) {
            if(!$unidades->contains($unidad->getUnidad()->getId()))
                $unidad->setHasta(new \DateTime());
        }
        foreach ( $unidades as $id) {
            $droguero->addUnidad($unityRepository->find($id));
        }

        $user = $em->getRepository('UserBundle:User')->find($request->get('responsable'));
        if(!$droguero->isResponsable($user)){
            $responsable = $droguero->getResponsable();
            if($responsable)
                $responsable->setHasta(new \DateTime());

            $responsable = new Responsable();
            $responsable
                ->setDroguero($droguero)
                ->setUser($user);
            $em->persist($responsable);
        }

        $em->flush();

        return $this->redirectToRoute('drug_drogueros_index');
    }

    public function newAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $doctrine = $this->getDoctrine();

        $criteria = Criteria::create()
            ->orderBy(array('nombre' => Criteria::ASC));

        $lugares = new ArrayCollection($doctrine->getRepository('DrugBundle:LugarFisico')->findAll());
        $unidades = new ArrayCollection($doctrine->getRepository('UnityBundle:UnidadEjecutora')->findAll());

        return $this->render('DrugBundle:Droguero:new.html.twig', array(
            'lugares' => $lugares->matching($criteria),
            'unidades' => $unidades->matching($criteria),
        ));
    }

    public function createAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $droguero = new Droguero();
        $lat = $request->get('lat');
        $lat = trim($lat) == "" ? null : $lat;

        $long = $request->get('long');
        $long = trim($long) == "" ? null : $long;

        $em = $this->getDoctrine()->getManager();

        $lugar = $em->getRepository('DrugBundle:LugarFisico')->find($request->get('lugar'));

        $droguero
            ->setLatitud($lat)
            ->setLongitud($long)
            ->setNumero($request->get('numero'))
            ->setLugar($lugar)
            ->setNombre($request->get('nombre'))
            ->setDetalle($request->get('detalle'))
            ->setImageBlob($request->files->get('image'));


        $unityRepository = $em->getRepository('UnityBundle:UnidadEjecutora');
        foreach ( $request->get('unidades', array()) as $id) {
            $droguero->addUnidad($unityRepository->find($id));
        }

        $user = $em->getRepository('UserBundle:User')->find($request->get('responsable'));

        $responsable = new Responsable();
        $responsable
            ->setDroguero($droguero)
            ->setUser($user);



        $em->persist($responsable);
        $em->persist($droguero);
        $em->flush();

        return $this->redirectToRoute('drug_drogueros_index');
    }

    public function accessAction(Droguero $droguero)
    {
        $this->denyAccessUnlessGranted('access', $droguero);

        $doctrine = $this->getDoctrine();

        $criteria = Criteria::create()
            ->orderBy(array('lastname' => Criteria::ASC, 'name' => Criteria::ASC));

        $unidades = $droguero->getUnidades();

        $users = new ArrayCollection();

        /* @var DrogueroUnidad $unidad */
        foreach ($unidades as $unidad) {
            if($unidad->getHasta() == null){

                /* @var UsuarioUnidad $integrante */
                foreach ($unidad->getUnidad()->getIntegrantes() as $integrante) {
                    if(!$users->contains($integrante->getUsuario()))
                        $users->add($integrante->getUsuario());
                }
            }
        }


        return $this->render('DrugBundle:Droguero:access.html.twig', array(
            'droguero' => $droguero,
            'users' => $users->matching($criteria)
        ));
    }

    public function grantAccessAction(Droguero $droguero, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $users = new ArrayCollection();
        foreach ($request->get('usuarios', array()) as $userId) {
            $users->add($em->getRepository('UserBundle:User')->find($userId));
        }

        /* @var Acceso $acceso */
        foreach ($droguero->getAccesos() as $acceso){
            if(!$users->exists(function ($index, User $user) use ($acceso){
                return $user->getId() == $acceso->getUser()->getId() && $acceso->getHasta() != null;
            })){
                $acceso->setHasta(new \DateTime());
            }
        }

        /* @var User $user */
        foreach ($users as $user){
            if(!$droguero->hasAccess($user)){
                $droguero->addAcceso($user);
            }
        }

        $em->flush();

        return $this->redirectToRoute('drug_drogueros_index');
    }

    public function deleteAction(Droguero $droguero)
    {
        throw new UnauthorizedHttpException("barear");
    }

}
