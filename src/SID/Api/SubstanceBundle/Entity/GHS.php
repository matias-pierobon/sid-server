<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GHS
 *
 * @ORM\Table(name="g_h_s")
 * @ORM\Entity(repositoryClass="SID\Api\SubstanceBundle\Repository\GHSRepository")
 */
class GHS
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
     * @ORM\Column(name="detalle", type="text")
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
     * @ORM\Column(name="image_mime", type="string", length=255, nullable=true)
     */
    private $imageMime;


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
     * @return GHS
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
     * @return GHS
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
     * Set mime
     *
     * @param string $mime
     *
     * @return GHS
     */
    public function setMime($mime)
    {
        $this->mime = $mime;

        return $this;
    }

    /**
     * Get mime
     *
     * @return string
     */
    public function getMime()
    {
        return $this->mime;
    }
}

