<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Droguero
 *
 * @ORM\Table(name="drogueros")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\DrogueroRepository")
 */
class Droguero extends Division
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="datetime")
     */
    private $fechaIngreso;

    /**
     * @var float
     *
     * @ORM\Column(name="latitud", type="float")
     */
    private $latitud;

    /**
     * @var float
     *
     * @ORM\Column(name="longitud", type="float")
     */
    private $longitud;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="DrogueroUnidad", mappedBy="droguero")
     */
    private $unidades;

}
