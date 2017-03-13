<?php

namespace SID\Api\UnityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UnityBundle:Default:index.html.twig');
    }
}
