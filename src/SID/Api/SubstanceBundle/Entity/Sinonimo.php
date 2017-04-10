<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sinonimo
 *
 * @ORM\Table(name="sinonimos")
 * @ORM\Entity(repositoryClass="SID\Api\SubstanceBundle\Repository\SinonimoRepository")
 */
class Sinonimo
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
     * Many Classes have Many Incompatibilities.
     * @ORM\ManyToMany(targetEntity="Droga", mappedBy="sinonimos")
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
     * @return Sinonimo
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
     * Add droga
     *
     * @param \SID\Api\SubstanceBundle\Entity\Droga $droga
     *
     * @return Sinonimo
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
