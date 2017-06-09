<?php

namespace SID\Api\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityControllerController extends Controller
{
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('SidSecurityBundle:Security:login.html.twig', array(
            'error' => $error, 'lastUsername' => $lastUsername
        ));
    }

}
