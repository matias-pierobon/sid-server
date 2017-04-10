<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\MovementBundle\Entity\Movimiento;
use SID\Api\SubstanceBundle\Entity\Droga;

/**
 * Stock
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\StockRepository")
 */
class Stock
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
     * @ORM\Column(name="marca", type="string", length=255)
     */
    private $marca;

    /**
     * @var int
     *
     * @ORM\Column(name="numeroEvnase", type="integer", nullable=true)
     */
    private $numeroEvnase;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaVencimiento", type="date", nullable=true)
     */
    private $fechaVencimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="lote", type="string", length=255, nullable=true)
     */
    private $lote;

    /**
     * @var string
     *
     * @ORM\Column(name="pesoBrutoActual", type="string", length=255, nullable=true)
     */
    private $pesoBrutoActual;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="blob", nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="imageMime", type="string", length=255, nullable=true)
     */
    private $imageMime;

    /**
     * @var int
     *
     * @ORM\Column(name="pesoBruto", type="integer")
     */
    private $pesoBruto;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroProducto", type="string", length=255)
     */
    private $numeroProducto;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaIngreso", type="datetimetz")
     */
    private $fechaIngreso;

    /**
     * @var int
     *
     * @ORM\Column(name="stockActual", type="integer")
     */
    private $stockActual;

    /**
     * Many Stocks have One Divition.
     * @ORM\ManyToOne(targetEntity="Division", inversedBy="stocks")
     * @ORM\JoinColumn(name="division_id", referencedColumnName="id")
     */
    private $division;

    /**
     * One Movement has Many Users.
     * @ORM\OneToMany(targetEntity="SID\Api\MovementBundle\Entity\Movimiento", mappedBy="stock")
     */
    private $movimientos;

    /**
     * Many Stocks have One Divition.
     * @ORM\ManyToOne(targetEntity="SID\Api\SubstanceBundle\Entity\Droga", inversedBy="stocks")
     * @ORM\JoinColumn(name="droga_id", referencedColumnName="id")
     */
    private $droga;

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
     * Set marca
     *
     * @param string $marca
     *
     * @return Stock
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set numeroEvnase
     *
     * @param integer $numeroEvnase
     *
     * @return Stock
     */
    public function setNumeroEvnase($numeroEvnase)
    {
        $this->numeroEvnase = $numeroEvnase;

        return $this;
    }

    /**
     * Get numeroEvnase
     *
     * @return integer
     */
    public function getNumeroEvnase()
    {
        return $this->numeroEvnase;
    }

    /**
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     *
     * @return Stock
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    /**
     * Get fechaVencimiento
     *
     * @return \DateTime
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    /**
     * Set lote
     *
     * @param string $lote
     *
     * @return Stock
     */
    public function setLote($lote)
    {
        $this->lote = $lote;

        return $this;
    }

    /**
     * Get lote
     *
     * @return string
     */
    public function getLote()
    {
        return $this->lote;
    }

    /**
     * Set pesoBrutoActual
     *
     * @param string $pesoBrutoActual
     *
     * @return Stock
     */
    public function setPesoBrutoActual($pesoBrutoActual)
    {
        $this->pesoBrutoActual = $pesoBrutoActual;

        return $this;
    }

    /**
     * Get pesoBrutoActual
     *
     * @return string
     */
    public function getPesoBrutoActual()
    {
        return $this->pesoBrutoActual;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Stock
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set imageMime
     *
     * @param string $imageMime
     *
     * @return Stock
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
     * Set pesoBruto
     *
     * @param integer $pesoBruto
     *
     * @return Stock
     */
    public function setPesoBruto($pesoBruto)
    {
        $this->pesoBruto = $pesoBruto;

        return $this;
    }

    /**
     * Get pesoBruto
     *
     * @return integer
     */
    public function getPesoBruto()
    {
        return $this->pesoBruto;
    }

    /**
     * Set numeroProducto
     *
     * @param string $numeroProducto
     *
     * @return Stock
     */
    public function setNumeroProducto($numeroProducto)
    {
        $this->numeroProducto = $numeroProducto;

        return $this;
    }

    /**
     * Get numeroProducto
     *
     * @return string
     */
    public function getNumeroProducto()
    {
        return $this->numeroProducto;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Stock
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return Stock
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set stockActual
     *
     * @param integer $stockActual
     *
     * @return Stock
     */
    public function setStockActual($stockActual)
    {
        $this->stockActual = $stockActual;

        return $this;
    }

    /**
     * Get stockActual
     *
     * @return integer
     */
    public function getStockActual()
    {
        return $this->stockActual;
    }

    /**
     * Set division
     *
     * @param \SID\Api\DrugBundle\Entity\Division $division
     *
     * @return Stock
     */
    public function setDivision(\SID\Api\DrugBundle\Entity\Division $division = null)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return \SID\Api\DrugBundle\Entity\Division
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Add movimiento
     *
     * @param \SID\Api\DrugBundle\Entity\Movimiento $movimiento
     *
     * @return Stock
     */
    public function addMovimiento(\SID\Api\DrugBundle\Entity\Movimiento $movimiento)
    {
        $this->movimientos[] = $movimiento;

        return $this;
    }

    /**
     * Remove movimiento
     *
     * @param \SID\Api\DrugBundle\Entity\Movimiento $movimiento
     */
    public function removeMovimiento(\SID\Api\DrugBundle\Entity\Movimiento $movimiento)
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
     * Set droga
     *
     * @param \SID\Api\DrugBundle\Entity\Droga $droga
     *
     * @return Stock
     */
    public function setDroga(\SID\Api\DrugBundle\Entity\Droga $droga = null)
    {
        $this->droga = $droga;

        return $this;
    }

    /**
     * Get droga
     *
     * @return \SID\Api\DrugBundle\Entity\Droga
     */
    public function getDroga()
    {
        return $this->droga;
    }
}
