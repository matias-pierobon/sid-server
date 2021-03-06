<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use SID\Api\MovementBundle\Entity\Movimiento;
use SID\Api\MovementBundle\Entity\MovimientoFisico;
use SID\Api\SubstanceBundle\Entity\Droga;
use SID\Api\SubstanceBundle\Entity\UnidadMedida;
use SID\Api\SubstanceBundle\Model\Cantidad;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
     * @ORM\Column(name="numeroEvnase",  type="string", length=255, nullable=true)
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
     * @ORM\Column(name="numeroProducto", type="string", length=255, nullable=true)
     */
    private $numeroProducto;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroInterno", type="string", length=255, nullable=true)
     */
    private $numeroInterno;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidad", type="float")
     */
    private $cantidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaIngreso", type="datetime")
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
     * One Movement has Many Users.
     * @ORM\OneToMany(targetEntity="SID\Api\MovementBundle\Entity\MovimientoFisico", mappedBy="stock")
     */
    private $extracciones;

    /**
     * Many Stocks have One Divition.
     * @ORM\ManyToOne(targetEntity="SID\Api\SubstanceBundle\Entity\Droga", inversedBy="stocks")
     * @ORM\JoinColumn(name="droga_id", referencedColumnName="id")
     */
    private $droga;

    /**
     * Many Stocks have One Calidad.
     * @ORM\ManyToOne(targetEntity="Calidad", inversedBy="stocks")
     * @ORM\JoinColumn(name="calidad_id", referencedColumnName="id")
     */
    private $calidad;

    /**
     * Many Stocks have One UnidadMedida.
     * @ORM\ManyToOne(targetEntity="SID\Api\SubstanceBundle\Entity\UnidadMedida", inversedBy="movimientos")
     * @ORM\JoinColumn(name="medida_id", referencedColumnName="id")
     */
    private $unidadMedida;


    public function updateCantidad(Cantidad $cantidad, $partial=true)
    {
        $normCantidad = $cantidad->convertirA($this->getUnidadMedida());

        if($partial){
            $normCantidad->setValor($normCantidad->getValor() + $this->cantidad);
        }

        $this->setCantidad($normCantidad->getValor());
    }
    /**
     * @return MovimientoFisico
     */
    public function getExtraccionActiva(){

        /* @var MovimientoFisico $extraccion */
        foreach ($this->extracciones as $extraccion) {
            if($extraccion->getHashta() == null)
                return $extraccion;
        }
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->getExtraccionActiva() == null;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->getDroga()->__toString();
    }


    /**
     * @return float
     */
    public function getDensidad()
    {
        return $this->getDroga()->getDensidad();
    }

    /**
     * @param UploadedFile $file
     * @return $this
     */
    public function setImageBlob($file)
    {
        if (!$file){
            $this->setImagen(null);
            $this->setImageMime(null);
            return $this;
        }
        if(!$file->isValid()){
            throw new FileException("Invalid File");
        }
        $imageFile    = fopen($file->getRealPath(), 'r');
        $imageContent = fread($imageFile, $file->getClientSize());
        fclose($imageFile);
        $this->setImagen($imageContent);
        $this->setImageMime($file->getMimeType());
        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaIngreso = new \DateTime();
        $this->movimientos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->extracciones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param string $numeroEvnase
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
     * @return string
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
     * Set numeroInterno
     *
     * @param string $numeroInterno
     *
     * @return Stock
     */
    public function setNumeroInterno($numeroInterno)
    {
        $this->numeroInterno = $numeroInterno;

        return $this;
    }

    /**
     * Get numeroInterno
     *
     * @return string
     */
    public function getNumeroInterno()
    {
        return $this->numeroInterno;
    }

    /**
     * Set cantidad
     *
     * @param float $cantidad
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
     * @return float
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
     * @param \SID\Api\MovementBundle\Entity\Movimiento $movimiento
     *
     * @return Stock
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
     * Add extraccione
     *
     * @param \SID\Api\MovementBundle\Entity\MovimientoFisico $extraccione
     *
     * @return Stock
     */
    public function addExtraccione(\SID\Api\MovementBundle\Entity\MovimientoFisico $extraccione)
    {
        $this->extracciones[] = $extraccione;

        return $this;
    }

    /**
     * Remove extraccione
     *
     * @param \SID\Api\MovementBundle\Entity\MovimientoFisico $extraccione
     */
    public function removeExtraccione(\SID\Api\MovementBundle\Entity\MovimientoFisico $extraccione)
    {
        $this->extracciones->removeElement($extraccione);
    }

    /**
     * Get extracciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExtracciones()
    {
        return $this->extracciones;
    }

    /**
     * Set droga
     *
     * @param \SID\Api\SubstanceBundle\Entity\Droga $droga
     *
     * @return Stock
     */
    public function setDroga(\SID\Api\SubstanceBundle\Entity\Droga $droga = null)
    {
        $this->droga = $droga;

        return $this;
    }

    /**
     * Get droga
     *
     * @return \SID\Api\SubstanceBundle\Entity\Droga
     */
    public function getDroga()
    {
        return $this->droga;
    }

    /**
     * Set calidad
     *
     * @param \SID\Api\DrugBundle\Entity\Calidad $calidad
     *
     * @return Stock
     */
    public function setCalidad(\SID\Api\DrugBundle\Entity\Calidad $calidad = null)
    {
        $this->calidad = $calidad;

        return $this;
    }

    /**
     * Get calidad
     *
     * @return \SID\Api\DrugBundle\Entity\Calidad
     */
    public function getCalidad()
    {
        return $this->calidad;
    }

    /**
     * Set unidadMedida
     *
     * @param \SID\Api\SubstanceBundle\Entity\UnidadMedida $unidadMedida
     *
     * @return Stock
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
}
