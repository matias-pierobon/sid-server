<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clase
 *
 * @ORM\Table(name="clases_droga")
 * @ORM\Entity(repositoryClass="SID\Api\SubstanceBundle\Repository\ClaseRepository")
 */
class Clase
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
     * Many Classes have Many Drugs.
     * @ORM\ManyToMany(targetEntity="Droga", mappedBy="clases")
     */
    private $drogas;

    /**
     * Many Classes have Many Incompatibilities.
     * @ORM\ManyToMany(targetEntity="Clase", mappedBy="incompatibleCon")
     */
    private $incompatibleConmigo;

    /**
     * Many Incompatibilitis have many classes.
     * @ORM\ManyToMany(targetEntity="Clase", inversedBy="incompatibleConmigo")
     * @ORM\JoinTable(name="incompatibilidades",
     *      joinColumns={@ORM\JoinColumn(name="droga_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="droga_incompatible_id", referencedColumnName="id")}
     *      )
     */
    private $incompatibleCon;


    public function incompatibilidades(){
        return;
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->drogas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->incompatibleConmigo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->incompatibleCon = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Clase
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
     * @return Clase
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
     * @param \SID\Api\SubstanceBundle\Entity\droga $droga
     *
     * @return Clase
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

    /**
     * Add incompatibleConmigo
     *
     * @param \SID\Api\SubstanceBundle\Entity\Clase $incompatibleConmigo
     *
     * @return Clase
     */
    public function addIncompatibleConmigo(\SID\Api\SubstanceBundle\Entity\Clase $incompatibleConmigo)
    {
        $this->incompatibleConmigo[] = $incompatibleConmigo;

        return $this;
    }

    /**
     * Remove incompatibleConmigo
     *
     * @param \SID\Api\SubstanceBundle\Entity\Clase $incompatibleConmigo
     */
    public function removeIncompatibleConmigo(\SID\Api\SubstanceBundle\Entity\Clase $incompatibleConmigo)
    {
        $this->incompatibleConmigo->removeElement($incompatibleConmigo);
    }

    /**
     * Get incompatibleConmigo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIncompatibleConmigo()
    {
        return $this->incompatibleConmigo;
    }

    /**
     * Add incompatibleCon
     *
     * @param \SID\Api\SubstanceBundle\Entity\Clase $incompatibleCon
     *
     * @return Clase
     */
    public function addIncompatibleCon(\SID\Api\SubstanceBundle\Entity\Clase $incompatibleCon)
    {
        $this->incompatibleCon[] = $incompatibleCon;

        return $this;
    }

    /**
     * Remove incompatibleCon
     *
     * @param \SID\Api\SubstanceBundle\Entity\Clase $incompatibleCon
     */
    public function removeIncompatibleCon(\SID\Api\SubstanceBundle\Entity\Clase $incompatibleCon)
    {
        $this->incompatibleCon->removeElement($incompatibleCon);
    }

    /**
     * Get incompatibleCon
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIncompatibleCon()
    {
        return $this->incompatibleCon;
    }
}
