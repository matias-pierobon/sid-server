<?php

namespace SID\Api\MovementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Motivo
 *
 * @ORM\Table(name="motivos_movimientos")
 * @ORM\Entity(repositoryClass="SID\Api\MovementBundle\Repository\MotivoRepository")
 */
class Motivo
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text")
     */
    private $detalle;

    /**
     * One Movement has Many Users.
     * @ORM\OneToMany(targetEntity="Movimiento", mappedBy="motivo")
     */
    private $movimientos;

    /**
     * @var string
     *
     * @ORM\Column(name="suma", type="boolean", nullable=true)
     */
    private $suma;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->movimientos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Motivo
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
     * @return Motivo
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
     * Add movimiento
     *
     * @param \SID\Api\MovementBundle\Entity\Movimiento $movimiento
     *
     * @return Motivo
     */
    public function addMovimiento(\SID\Api\MovementBundle\Entity\Movimiento $movimiento)
    {
        $this->movimientos[] = $movimiento;

        return $this;
    }

    /**
     * Remove movimiento
     *
     * @param \SID\Api\MovementBundle\Entity\Movimiento $movimiento
     */
    public function removeMovimiento(\SID\Api\MovementBundle\Entity\Movimiento $movimiento)
    {
        $this->movimientos->removeElement($movimiento);
    }

    /**
     * Get movimientos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMovimientos()
    {
        return $this->movimientos;
    }

    /**
     * Set suma
     *
     * @param float $suma
     *
     * @return self
     */
    public function setSuma($suma)
    {
        $this->suma = $suma;

        return $this;
    }

    /**
     * Get suma
     *
     * @return float
     */
    public function getSuma()
    {
        return $this->suma;
    }
}
