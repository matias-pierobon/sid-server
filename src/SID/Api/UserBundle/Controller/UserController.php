<?php

namespace SID\Api\UserBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use SID\Api\UnityBundle\Entity\UsuarioUnidad;
use SID\Api\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UserController extends Controller
{
    public function indexAction()
    {
        $users = new ArrayCollection(
            $this->getDoctrine()->getRepository('UserBundle:User')->findAll()
        );

        $criteria = Criteria::create()
            ->orderBy(array('name' => Criteria::ASC, 'lastname' => Criteria::ASC));

        return $this->render('UserBundle:User:index.html.twig', array(
            'users' => $users->matching($criteria)
        ));
    }

    public function showAction(User $user)
    {
        return $this->render('UserBundle:User:show.html.twig', array(
            'user' => $user
        ));
    }

    public function editAction(User $user)
    {
        $doctrine = $this->getDoctrine();

        $criteria = Criteria::create()
            ->orderBy(array('nombre' => Criteria::ASC));

        $unidades = new ArrayCollection($doctrine->getRepository('UnityBundle:UnidadEjecutora')->findAll());

        return $this->render('UserBundle:User:edit.html.twig', array(
            'user' => $user,
            'unidades' => $unidades->matching($criteria)
        ));
    }

    public function updateAction(User $user, Request $request)
    {
        $user
            ->setEmail($request->get('mail', $user->getEmail()))
            ->setLastname($request->get('lastname', $user->getLastname()))
            ->setName($request->get('name', $user->getName()));

        if(trim($request->get('password', '')) != ''){
            $user->setPlainPassword($request->get('password'));
        }

        /*if($request->files->get('image', null)){
            $user->setImageBlob($request->files->get('image'));
        }*/

        $em = $this->getDoctrine()->getManager();

        $unityRepository = $em->getRepository('UnityBundle:UnidadEjecutora');
        $unidades =  new ArrayCollection($request->get('unidades', array()));

        /* @var UsuarioUnidad $unidad */
        foreach ($user->getUnidades() as $unidad) {
            if(!$unidades->contains($unidad->getUnidad()->getId()))
                $unidad->setHasta(new \DateTime());
        }
        foreach ( $unidades as $id) {
            $user->addUnidad($unityRepository->find($id));
        }

        $em->flush();

        return $this->redirectToRoute('users_index');
    }

    public function newAction()
    {
        $doctrine = $this->getDoctrine();

        $criteria = Criteria::create()
            ->orderBy(array('nombre' => Criteria::ASC));

        $unidades = new ArrayCollection($doctrine->getRepository('UnityBundle:UnidadEjecutora')->findAll());

        return $this->render('UserBundle:User:new.html.twig', array(
            'unidades' => $unidades->matching($criteria),
        ));
    }

    public function createAction(Request $request)
    {
        $user = new User();
        $user
            ->setEmail($request->get('mail'))
            ->setLastname($request->get('lastname'))
            ->setName($request->get('name'))
            ->setPassword('chunk')
            ->setSalt('chunk')
            ->setPlainPassword($request->get('password'))
            ->setUsername($request->get('username'))
            ->setRoles(array('ROLE_USER'));

        $em = $this->getDoctrine()->getManager();

        $unityRepository = $em->getRepository('UnityBundle:UnidadEjecutora');
        foreach ( $request->get('unidades', array()) as $id) {
            $user->addUnidad($unityRepository->find($id));
        }

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('users_index');
    }

    public function imageAction(User $user)
    {
        if (!$user->getImage()) {
            $file = new File(__DIR__ . '/../Resources/public/image/blank.jpg');
            $imageFile = fopen($file->getRealPath(), 'r');
            $imageContent = fread($imageFile, $file->getSize());
            fclose($imageFile);
            return new Response($imageContent, 200, array('Content-Type' => $file->getMimeType()));
        }
        return new Response(
            stream_get_contents($user->getImage()),
            200,
            array('Content-Type' => $user->getImageMime())
        );

    }

}
