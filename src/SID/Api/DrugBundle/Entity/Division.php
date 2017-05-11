<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Division
 *
 * @ORM\Table(name="divisiones")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\DivisionRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"subdivision" = "Subdivision", "droguero" = "Droguero"})
 */
abstract class Division
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", nullable=true)
     */
    protected $detalle;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", nullable=true)
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="image_mime", type="string", length=255, nullable=true)
     */
    protected $imageMime;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    protected $nombre;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="division")
     */
    protected $stocks;

    /**
     * One Category has Many Categories.
     * @ORM\OneToMany(targetEntity="Subdivision", mappedBy="parent")
     */
    protected $subdivisiones;


    public abstract function getDroguero();

    public abstract function getPath() : ArrayCollection;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stocks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subdivisiones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Division
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
     * @return Division
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
     * @return Division
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
     * @return Division
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
     * Add stock
     *
     * @param \SID\Api\DrugBundle\Entity\Stock $stock
     *
     * @return Division
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
     * Add Subdivisione
     *
     * @param \SID\Api\DrugBundle\Entity\Subdivision $Subdivisione
     *
     * @return Division
     */
    public function addSubdivision(\SID\Api\DrugBundle\Entity\Subdivision $subdivision)
    {
        $this->subdivisiones[] = $subdivision;

        return $this;
    }

    /**
     * Remove Subdivisione
     *
     * @param \SID\Api\DrugBundle\Entity\Subdivision $Subdivisione
     */
    public function removeSubdivision(\SID\Api\DrugBundle\Entity\Subdivision $subdivision)
    {
        $this->subdivisiones->removeElement($subdivision);
    }

    /**
     * Get Subdivisiones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubdivisiones()
    {
        return $this->subdivisiones;
    }
}
