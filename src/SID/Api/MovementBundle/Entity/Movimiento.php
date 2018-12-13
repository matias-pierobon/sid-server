<?php

namespace SID\Api\MovementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\SubstanceBundle\Model\Cantidad;
use SID\Api\UserBundle\Entity\User;
use SID\Api\DrugBundle\Entity\Stock;

/**
 * Movimiento
 *
 * @ORM\Table(name="movimientos")
 * @ORM\Entity(repositoryClass="SID\Api\MovementBundle\Repository\MovimientoRepository")
 */
class Movimiento
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
     * @ORM\Column(name="comentario", type="text", nullable=true)
     */
    private $comentario;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="float", nullable=true)
     */
    private $cantidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="desde", type="datetime")
     */
    private $desde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hasta", type="datetime", nullable=true)
     */
    private $hasta;

    /**
     * @var string
     *
     * @ORM\Column(name="partial", type="boolean", nullable=true)
     */
    private $partial;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="SID\Api\UserBundle\Entity\User", inversedBy="movimientos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $usuario;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="SID\Api\DrugBundle\Entity\Stock", inversedBy="movimientos")
     * @ORM\JoinColumn(name="stock_id", referencedColumnName="id")
     */
    private $stock;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Motivo", inversedBy="movimientos")
     * @ORM\JoinColumn(name="motivo_id", referencedColumnName="id")
     */
    private $motivo;

    /**
     * Many Movimientos have One Comprobante.
     * @ORM\ManyToOne(targetEntity="SID\Api\ProviderBundle\Entity\Comprobante", inversedBy="movimientos")
     * @ORM\JoinColumn(name="comprobante_id", referencedColumnName="id", nullable=true)
     */
    private $comprobante;

    /**
     * Many Stocks have One UnidadMedida.
     * @ORM\ManyToOne(targetEntity="SID\Api\SubstanceBundle\Entity\UnidadMedida", inversedBy="movimientos")
     * @ORM\JoinColumn(name="medida_id", referencedColumnName="id")
     */
    private $unidadMedida;


    public function getNormCantidad()
    {
        return new Cantidad($this->getCantidad(), $this->getUnidadMedida(), $this->getDroga()->getDensidad());
    }

    /**
     * @return \SID\Api\SubstanceBundle\Entity\Droga
     */
    public function getDroga()
    {
        return $this->getStock()->getDroga();
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->desde = new \DateTime();
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
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Movimiento
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return Movimiento
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set desde
     *
     * @param \DateTime $desde
     *
     * @return Movimiento
     */
    public function setDesde($desde)
    {
        $this->desde = $desde;

        return $this;
    }

    /**
     * Get desde
     *
     * @return \DateTime
     */
    public function getDesde()
    {
        return $this->desde;
    }

    /**
     * Set hasta
     *
     * @param \DateTime $hasta
     *
     * @return Movimiento
     */
    public function setHasta($hasta)
    {
        $this->hasta = $hasta;

        return $this;
    }

    /**
     * Get hasta
     *
     * @return \DateTime
     */
    public function getHasta()
    {
        return $this->hasta;
    }

    /**
     * Set usuario
     *
     * @param \SID\Api\UserBundle\Entity\User $usuario
     *
     * @return Movimiento
     */
    public function setUsuario(\SID\Api\UserBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \SID\Api\UserBundle\Entity\User
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set stock
     *
     * @param \SID\Api\DrugBundle\Entity\Stock $stock
     *
     * @return Movimiento
     */
    public function setStock(\SID\Api\DrugBundle\Entity\Stock $stock = null)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return \SID\Api\DrugBundle\Entity\Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set Motivo
     *
     * @param \SID\Api\MovementBundle\Entity\Motivo $motivo
     *
     * @return Movimiento
     */
    public function setMotivo(\SID\Api\MovementBundle\Entity\Motivo $motivo = null)
    {
        $this->motivo = $motivo;

        return $this;
    }

    /**
     * Get Motivo
     *
     * @return \SID\Api\MovementBundle\Entity\Motivo
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * Set Motivo
     *
     * @param \SID\Api\ProviderBundle\Entity\Comprobante $comprobante
     *
     * @return Movimiento
     */
    public function setComprobante(\SID\Api\ProviderBundle\Entity\Comprobante $comprobante = null)
    {
        $this->comprobante = $comprobante;

        return $this;
    }

    /**
     * Get Comprobante
     *
     * @return \SID\Api\ProviderBundle\Entity\Comprobante
     */
    public function getComprobante()
    {
        return $this->comprobante;
    }

    /**
     * Set unidadMedida
     *
     * @param \SID\Api\SubstanceBundle\Entity\UnidadMedida $unidadMedida
     *
     * @return Movimiento
     */
    public function setUnidadMedida(\SID\Api\SubstanceBundle\Entity\UnidadMedida $unidadMedida = null)
    {
        $this->unidadMedida = $unidadMedida;

        return $this;
    }

    /**
     * Get unidadMedida
     *
     * @return \SID\Api\SubstanceBundle\Entity\UnidadMedida
     */
    public function getUnidadMedida()
    {
        return $this->unidadMedida;
    }

    /**
     * @return bool
     */
    public function getPartial(): bool
    {
        return $this->partial || false;
    }

    /**
     * @param bool $partial
     *
     * @return self
     */
    public function setPartial($partial)
    {
        $this->partial = $partial;

        return $this;
    }
}
