<?php

namespace SID\Api\ProviderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProviderBundle:Default:index.html.twig');
    }
}
