<?php

namespace SID\Api\UnityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UnidadEjecutora
 *
 * @ORM\Table(name="unidad_ejecutora")
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
     * @ORM\Column(name="cufe", type="string", length=255)
     */
    private $cufe;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text")
     */
    private $detalle;

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
}

