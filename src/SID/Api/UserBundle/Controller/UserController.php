<?php

namespace SID\Api\UserBundle\Controller;

use SID\Api\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('UserBundle:User')->findAll();

        return new JsonResponse(array('data' => $this->serializeUsers($users)));
    }

    protected function serializeUsers(array $users){
        $data = array();
        foreach ($users as $user){
            $data[] = $this->serializeUser($user);
        }
        return $data;
    }

    public function serializeUser(User $user){
        return array(
            'id' => $user->getId(),
            'nombre' => $user->getName(),
            'apellido' => $user->getLastname(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'enabled' => $user->isEnabled()
        );
    }

    /**
     * Creates a new user entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $user
            ->setUsername($request->get('username'))
            ->setEmail($request->get('email'))
            ->setName($request->get('name'))
            ->setLastname($request->get('lastname'))
            ->setPlainPassword($request->get('password'));

        $user->setPassword('chunk');
        $user->setSalt('chunk');

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new JsonResponse(array(
            'status' => 'created',
            'data' => $this->serializeUser($user)
        ), JsonResponse::HTTP_CREATED);
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function showAction(User $user)
    {
        return new JsonResponse(array(
            'data' => $this->serializeUser($user)
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     */
    public function editAction(Request $request, User $user)
    {
        $user
            ->setEmail($request->get('email', $user->getEmail()))
            ->setName($request->get('name', $user->getName()))
            ->setLastname($request->get('lastname', $user->getLastname()))
            ->setPlainPassword($request->get('password', null));

        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array(
            'status' => 'updated',
            'data' => $this->serializeUser($user)
        ), JsonResponse::HTTP_ACCEPTED);
    }

    /**
     * Deletes a user entity.
     *
     */
    public function deleteAction(Request $request, User $user)
    {
        return new JsonResponse();
    }
}
