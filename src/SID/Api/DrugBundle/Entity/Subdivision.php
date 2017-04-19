<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subdivision
 *
 * @ORM\Table(name="subdivisiones")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\SubdivisionRepository")
 */
class Subdivision extends Division
{
    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;

    /**
     * Many Categories have One Category.
     * @ORM\ManyToOne(targetEntity="Division", inversedBy="subdivisiones")
     * @ORM\JoinColumn(name="padre_id", referencedColumnName="id")
     */
    private $parent;


    public function getDroguero(){
        return $this->parent->getDroguero();
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stocks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subdiviciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Subdivision
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
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
     * @return Subdivision
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
     * @return Subdivision
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
     * @return Subdivision
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
     * @return Subdivision
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
     * Set parent
     *
     * @param \SID\Api\DrugBundle\Entity\Division $parent
     *
     * @return Subdivision
     */
    public function setParent(\SID\Api\DrugBundle\Entity\Division $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \SID\Api\DrugBundle\Entity\Division
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add stock
     *
     * @param \SID\Api\DrugBundle\Entity\Stock $stock
     *
     * @return Subdivision
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
     * @return Subdivision
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
