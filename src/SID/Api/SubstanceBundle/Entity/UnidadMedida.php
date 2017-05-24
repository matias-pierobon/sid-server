<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UnidadMedida
 *
 * @ORM\Table(name="unidad_medida")
 * @ORM\Entity(repositoryClass="SID\Api\SubstanceBundle\Repository\UnidadMedidaRepository")
 */
class UnidadMedida
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaIngreso", type="datetimetz")
     */
    private $fechaIngreso;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=255, unique=true)
     */
    private $sigla;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text")
     */
    private $detalle;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaIngreso = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return UnidadMedida
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set sigla
     *
     * @param string $sigla
     *
     * @return UnidadMedida
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return UnidadMedida
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get detalle
     *
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }
}

