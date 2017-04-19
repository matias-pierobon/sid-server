<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GHS
 *
 * @ORM\Table(name="ghs")
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
     * Many Classes have Many Incompatibilities.
     * @ORM\ManyToMany(targetEntity="Droga", mappedBy="ghs")
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
     * Set imageMime
     *
     * @param string $imageMime
     *
     * @return GHS
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
     * Add droga
     *
     * @param \SID\Api\SubstanceBundle\Entity\Droga $droga
     *
     * @return GHS
     */
    public function addDroga(\SID\Api\SubstanceBundle\Entity\Droga $droga)
    {
        $this->drogas[] = $droga;

        return $this;
    }

    /**
     * Remove droga
     *
     * @param \SID\Api\SubstanceBundle\Entity\Droga $droga
     */
    public function removeDroga(\SID\Api\SubstanceBundle\Entity\Droga $droga)
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
