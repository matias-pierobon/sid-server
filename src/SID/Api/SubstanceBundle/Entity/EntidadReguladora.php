<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadReguladora
 *
 * @ORM\Table(name="entidades_reguladoras")
 * @ORM\Entity(repositoryClass="SID\Api\SubstanceBundle\Repository\EntidadReguladoraRepository")
 */
class EntidadReguladora
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * Many Classes have Many Incompatibilities.
     * @ORM\ManyToMany(targetEntity="Drogas", mappedBy="entidades")
     */
    private $drogas;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->drogas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return EntidadReguladora
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
     * @return EntidadReguladora
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
     * Add droga
     *
     * @param \SID\Api\SubstanceBundle\Entity\Drogas $droga
     *
     * @return EntidadReguladora
     */
    public function addDroga(\SID\Api\SubstanceBundle\Entity\Drogas $droga)
    {
        $this->drogas[] = $droga;

        return $this;
    }

    /**
     * Remove droga
     *
     * @param \SID\Api\SubstanceBundle\Entity\Drogas $droga
     */
    public function removeDroga(\SID\Api\SubstanceBundle\Entity\Drogas $droga)
    {
        $this->drogas->removeElement($droga);
    }

    /**
     * Get drogas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDrogas()
    {
        return $this->drogas;
    }
}
