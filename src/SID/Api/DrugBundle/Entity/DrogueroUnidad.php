<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\UnityBundle\Entity\UnidadEjecutora;

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
     * @ORM\Column(name="fecha_desde", type="datetime")
     */
    private $desde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hasta", type="datetime", nullable=true)
     */
    private $hasta;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Droguero", inversedBy="unidades")
     * @ORM\JoinColumn(name="droguero_id", referencedColumnName="id")
     */
    private $droguero;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="UnidadEjecutora", inversedBy="drogueros")
     * @ORM\JoinColumn(name="unidad_id", referencedColumnName="id")
     */
    private $unidad;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set desde
     *
     * @param \DateTime $desde
     *
     * @return DrogueroUnidad
     */
    public function setDesde($desde)
    {
        $this->desde = $desde;

        return $this;
    }

    /**
     * Get desde
     *
     * @return \DateTime
     */
    public function getDesde()
    {
        return $this->desde;
    }

    /**
     * Set hasta
     *
     * @param \DateTime $hasta
     *
     * @return DrogueroUnidad
     */
    public function setHasta($hasta)
    {
        $this->hasta = $hasta;

        return $this;
    }

    /**
     * Get hasta
     *
     * @return \DateTime
     */
    public function getHasta()
    {
        return $this->hasta;
    }

    /**
     * Set droguero
     *
     * @param \SID\Api\DrugBundle\Entity\Droguero $droguero
     *
     * @return DrogueroUnidad
     */
    public function setDroguero(\SID\Api\DrugBundle\Entity\Droguero $droguero = null)
    {
        $this->droguero = $droguero;

        return $this;
    }

    /**
     * Get droguero
     *
     * @return \SID\Api\DrugBundle\Entity\Droguero
     */
    public function getDroguero()
    {
        return $this->droguero;
    }

    /**
     * Set unidad
     *
     * @param \SID\Api\DrugBundle\Entity\UnidadEjecutora $unidad
     *
     * @return DrogueroUnidad
     */
    public function setUnidad(\SID\Api\DrugBundle\Entity\UnidadEjecutora $unidad = null)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return \SID\Api\DrugBundle\Entity\UnidadEjecutora
     */
    public function getUnidad()
    {
        return $this->unidad;
    }
}
