<?php

namespace SID\Api\SubstanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SubstanceBundle:Default:index.html.twig');
    }
}
