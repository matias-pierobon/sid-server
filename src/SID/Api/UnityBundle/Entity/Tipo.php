<?php

namespace SID\Api\UnityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipo
 *
 * @ORM\Table(name="tipo_unidades")
 * @ORM\Entity(repositoryClass="SID\Api\UnityBundle\Repository\TipoRepository")
 */
class Tipo
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="UnidadEjecutora", mappedBy="tipo")
     */
    private $unidades;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->unidades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNombre();
    }

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Tipo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return Tipo
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

    /**
     * Add unidade
     *
     * @param \SID\Api\UnityBundle\Entity\UnidadEjecutora $unidade
     *
     * @return Tipo
     */
    public function addUnidade(\SID\Api\UnityBundle\Entity\UnidadEjecutora $unidade)
    {
        $this->unidades[] = $unidade;

        return $this;
    }

    /**
     * Remove unidade
     *
     * @param \SID\Api\UnityBundle\Entity\UnidadEjecutora $unidade
     */
    public function removeUnidade(\SID\Api\UnityBundle\Entity\UnidadEjecutora $unidade)
    {
        $this->unidades->removeElement($unidade);
    }

    /**
     * Get unidades
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUnidades()
    {
        return $this->unidades;
    }
}
