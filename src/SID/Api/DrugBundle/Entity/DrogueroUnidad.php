<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DrogueroUnidad
 *
 * @ORM\Table(name="droguero_unidad")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\DrogueroUnidadRepository")
 */
class DrogueroUnidad
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
     * @ORM\Column(name="fechaDesde", type="datetime")
     */
    private $fechaDesde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaHasta", type="datetime", nullable=true)
     */
    private $fechaHasta;


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
     * Set fechaDesde
     *
     * @param \DateTime $fechaDesde
     *
     * @return DrogueroUnidad
     */
    public function setFechaDesde($fechaDesde)
    {
        $this->fechaDesde = $fechaDesde;

        return $this;
    }

    /**
     * Get fechaDesde
     *
     * @return \DateTime
     */
    public function getFechaDesde()
    {
        return $this->fechaDesde;
    }

    /**
     * Set fechaHasta
     *
     * @param \DateTime $fechaHasta
     *
     * @return DrogueroUnidad
     */
    public function setFechaHasta($fechaHasta)
    {
        $this->fechaHasta = $fechaHasta;

        return $this;
    }

    /**
     * Get fechaHasta
     *
     * @return \DateTime
     */
    public function getFechaHasta()
    {
        return $this->fechaHasta;
    }
}

