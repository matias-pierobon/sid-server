<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Division
 *
 * @ORM\Table(name="division")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\DivisionRepository")
 */
class Division
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
     * @ORM\Column(name="detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="imageMime", type="string", length=255, nullable=true)
     */
    private $imageMime;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;


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
}

