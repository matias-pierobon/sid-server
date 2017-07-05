<?php

namespace SID\Api\SubstanceBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use SID\Api\DrugBundle\Entity\Division;
use SID\Api\DrugBundle\Entity\Droguero;
use SID\Api\DrugBundle\Entity\Stock;
use SID\Api\MovementBundle\Entity\Movimiento;
use SID\Api\MovementBundle\Entity\MovimientoFisico;
use SID\Api\SubstanceBundle\Entity\GHS;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class GHSController extends Controller
{
    public function imageAction(GHS $ghs)
    {
        return new Response(
            stream_get_contents($ghs->getImage()),
            200,
            array('Content-Type' => $ghs->getImageMime())
        );

    }
}
