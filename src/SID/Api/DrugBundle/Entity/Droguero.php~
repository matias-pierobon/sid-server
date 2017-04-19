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
     * @ORM\Column(name="latitud", type="float", nullable=true)
     */
    private $latitud;

    /**
     * @var float
     *
     * @ORM\Column(name="longitud", type="float", nullable=true)
     */
    private $longitud;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="DrogueroUnidad", mappedBy="droguero")
     */
    private $unidades;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Responsable", mappedBy="droguero")
     */
    private $responsables;


    public function getDroguero(){
        return $this;
    }

    public function getResponsable(){
        return;
    }

    public function getUsuarios(){
        return;
    }


}
