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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->unidades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->responsables = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stocks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subdiviciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return Droguero
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
     * Set latitud
     *
     * @param float $latitud
     *
     * @return Droguero
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get latitud
     *
     * @return float
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param float $longitud
     *
     * @return Droguero
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return float
     */
    public function getLongitud()
    {
        return $this->longitud;
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
     * Set detalle
     *
     * @param string $detalle
     *
     * @return Droguero
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
     * Set image
     *
     * @param string $image
     *
     * @return Droguero
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set imageMime
     *
     * @param string $imageMime
     *
     * @return Droguero
     */
    public function setImageMime($imageMime)
    {
        $this->imageMime = $imageMime;

        return $this;
    }

    /**
     * Get imageMime
     *
     * @return string
     */
    public function getImageMime()
    {
        return $this->imageMime;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Droguero
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
     * Add unidade
     *
     * @param \SID\Api\DrugBundle\Entity\DrogueroUnidad $unidade
     *
     * @return Droguero
     */
    public function addUnidade(\SID\Api\DrugBundle\Entity\DrogueroUnidad $unidade)
    {
        $this->unidades[] = $unidade;

        return $this;
    }

    /**
     * Remove unidade
     *
     * @param \SID\Api\DrugBundle\Entity\DrogueroUnidad $unidade
     */
    public function removeUnidade(\SID\Api\DrugBundle\Entity\DrogueroUnidad $unidade)
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

    /**
     * Add responsable
     *
     * @param \SID\Api\DrugBundle\Entity\Responsable $responsable
     *
     * @return Droguero
     */
    public function addResponsable(\SID\Api\DrugBundle\Entity\Responsable $responsable)
    {
        $this->responsables[] = $responsable;

        return $this;
    }

    /**
     * Remove responsable
     *
     * @param \SID\Api\DrugBundle\Entity\Responsable $responsable
     */
    public function removeResponsable(\SID\Api\DrugBundle\Entity\Responsable $responsable)
    {
        $this->responsables->removeElement($responsable);
    }

    /**
     * Get responsables
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponsables()
    {
        return $this->responsables;
    }

    /**
     * Add stock
     *
     * @param \SID\Api\DrugBundle\Entity\Stock $stock
     *
     * @return Droguero
     */
    public function addStock(\SID\Api\DrugBundle\Entity\Stock $stock)
    {
        $this->stocks[] = $stock;

        return $this;
    }

    /**
     * Remove stock
     *
     * @param \SID\Api\DrugBundle\Entity\Stock $stock
     */
    public function removeStock(\SID\Api\DrugBundle\Entity\Stock $stock)
    {
        $this->stocks->removeElement($stock);
    }

    /**
     * Get stocks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * Add subdivicione
     *
     * @param \SID\Api\DrugBundle\Entity\Subdivision $subdivicione
     *
     * @return Droguero
     */
    public function addSubdivicione(\SID\Api\DrugBundle\Entity\Subdivision $subdivicione)
    {
        $this->subdiviciones[] = $subdivicione;

        return $this;
    }

    /**
     * Remove subdivicione
     *
     * @param \SID\Api\DrugBundle\Entity\Subdivision $subdivicione
     */
    public function removeSubdivicione(\SID\Api\DrugBundle\Entity\Subdivision $subdivicione)
    {
        $this->subdiviciones->removeElement($subdivicione);
    }

    /**
     * Get subdiviciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubdiviciones()
    {
        return $this->subdiviciones;
    }
}
