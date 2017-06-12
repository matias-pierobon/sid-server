<?php

namespace SID\Api\UnityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\DrugBundle\Entity\DrogueroUnidad;

/**
 * UnidadEjecutora
 *
 * @ORM\Table(name="unidades_ejecutoras")
 * @ORM\Entity(repositoryClass="SID\Api\UnityBundle\Repository\UnidadEjecutoraRepository")
 */
class UnidadEjecutora
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
     * @ORM\Column(name="cufe", type="string", length=255, nullable=True)
     */
    private $cufe;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", nullable=True)
     */
    private $detalle;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="SID\Api\DrugBundle\Entity\DrogueroUnidad", mappedBy="unidad")
     */
    private $drogueros;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Tipo", inversedBy="unidades")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
     */
    private $tipo;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="UsuarioUnidad", mappedBy="unidad")
     */
    private $integrantes;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->drogueros = new \Doctrine\Common\Collections\ArrayCollection();
        $this->integrantes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cufe
     *
     * @param string $cufe
     *
     * @return UnidadEjecutora
     */
    public function setCufe($cufe)
    {
        $this->cufe = $cufe;

        return $this;
    }

    /**
     * Get cufe
     *
     * @return string
     */
    public function getCufe()
    {
        return $this->cufe;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return UnidadEjecutora
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return UnidadEjecutora
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
     * Add droguero
     *
     * @param \SID\Api\DrugBundle\Entity\DrogueroUnidad $droguero
     *
     * @return UnidadEjecutora
     */
    public function addDroguero(\SID\Api\DrugBundle\Entity\DrogueroUnidad $droguero)
    {
        $this->drogueros[] = $droguero;

        return $this;
    }

    /**
     * Remove droguero
     *
     * @param \SID\Api\DrugBundle\Entity\DrogueroUnidad $droguero
     */
    public function removeDroguero(\SID\Api\DrugBundle\Entity\DrogueroUnidad $droguero)
    {
        $this->drogueros->removeElement($droguero);
    }

    /**
     * Get drogueros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDrogueros()
    {
        return $this->drogueros;
    }

    /**
     * Set Tipos
     *
     * @param \SID\Api\UnityBundle\Entity\Tipo $tipo
     *
     * @return UnidadEjecutora
     */
    public function setTipo(Tipo $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get Tipos
     *
     * @return \SID\Api\UnityBundle\Entity\Tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Add integrante
     *
     * @param \SID\Api\UnityBundle\Entity\UsuarioUnidad $integrante
     *
     * @return UnidadEjecutora
     */
    public function addIntegrante(\SID\Api\UnityBundle\Entity\UsuarioUnidad $integrante)
    {
        $this->integrantes[] = $integrante;

        return $this;
    }

    /**
     * Remove integrante
     *
     * @param \SID\Api\UnityBundle\Entity\UsuarioUnidad $integrante
     */
    public function removeIntegrante(\SID\Api\UnityBundle\Entity\UsuarioUnidad $integrante)
    {
        $this->integrantes->removeElement($integrante);
    }

    /**
     * Get integrantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIntegrantes()
    {
        return $this->integrantes;
    }
}
