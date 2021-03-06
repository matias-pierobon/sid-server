<?php

namespace SID\Api\UserBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use SID\Api\UnityBundle\Entity\UnidadEjecutora;
use SID\Api\UnityBundle\Entity\UsuarioUnidad;
use SID\Api\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RestController extends Controller
{
    public function filterAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $unityRepository = $doctrine->getRepository('UnityBundle:UnidadEjecutora');

        $users = new ArrayCollection();
        foreach ( $request->get('unidades', array()) as $id) {

            /* @var UnidadEjecutora $unidad */
            $unidad = $unityRepository->find($id);

            /* @var UsuarioUnidad $integrante */
            foreach ($unidad->getIntegrantes() as $integrante) {
                if($integrante->getHasta())
                    continue;
                if (!($users->contains($integrante->getUsuario()) || $integrante->getUsuario()->isAdmin()))
                    $users->add($integrante->getUsuario());
            }
        }

        $criteria = Criteria::create()
            ->orderBy(array('lastname' => Criteria::ASC, 'name' => Criteria::ASC));

        return new JsonResponse(array(
            'data' => $this->serializeUsers($users->matching($criteria))
        ));
    }

    /**
     * @param ArrayCollection $users
     *
     * @return array
     */
    public function serializeUsers($users)
    {
        return $users->map(function (User $user){
            return array(
                'id' => $user->getId(),
                'nombre' => $user->getName(),
                'apellido' => $user->getLastname()
            );
        })->toArray();
    }
}
