<?php

namespace SID\Api\DrugBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DrugBundle:Default:index.html.twig');
    }
}
