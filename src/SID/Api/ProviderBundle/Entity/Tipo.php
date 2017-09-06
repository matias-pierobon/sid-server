<?php

namespace SID\Api\ProviderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipo
 *
 * @ORM\Table(name="tipo")
 * @ORM\Entity(repositoryClass="SID\Api\ProviderBundle\Repository\TipoRepository")
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
     * One Movement has Many Users.
     * @ORM\OneToMany(targetEntity="Comprobante", mappedBy="tipo")
     */
    private $comprobantes;


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comprobantes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add comprobante
     *
     * @param \SID\Api\ProviderBundle\Entity\Comprobante $comprobante
     *
     * @return Tipo
     */
    public function addComprobante(\SID\Api\ProviderBundle\Entity\Comprobante $comprobante)
    {
        $this->comprobantes[] = $comprobante;

        return $this;
    }

    /**
     * Remove comprobante
     *
     * @param \SID\Api\ProviderBundle\Entity\Comprobante $comprobante
     */
    public function removeComprobante(\SID\Api\ProviderBundle\Entity\Comprobante $comprobante)
    {
        $this->comprobantes->removeElement($comprobante);
    }

    /**
     * Get comprobantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComprobantes()
    {
        return $this->comprobantes;
    }
}
