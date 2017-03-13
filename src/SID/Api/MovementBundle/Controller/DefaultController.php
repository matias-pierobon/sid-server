<?php

namespace SID\Api\MovementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MovementBundle:Default:index.html.twig');
    }
}
