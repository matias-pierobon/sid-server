<?php

namespace SID\Api\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SidSecurityBundle:Default:index.html.twig');
    }
}
