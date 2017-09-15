<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ds\Set;
use Ds\Queue;
use Ds\Map;
use Ds\Sequence;
use Ds\Vector;

/**
 * UnidadMedida
 *
 * @ORM\Table(name="unidad_medida")
 * @ORM\Entity(repositoryClass="SID\Api\SubstanceBundle\Repository\UnidadMedidaRepository")
 */
class UnidadMedida
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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaIngreso", type="datetimetz")
     */
    private $fechaIngreso;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=255, unique=true)
     */
    private $sigla;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text")
     */
    private $detalle;

    /**
     * One Calidad has Many Stocks.
     * @ORM\OneToMany(targetEntity="Droga", mappedBy="unidadMedida")
     */
    protected $drogas;

    /**
     * One Calidad has Many Stocks.
     * @ORM\OneToMany(targetEntity="SID\Api\DrugBundle\Entity\Stock", mappedBy="unidadMedida")
     */
    protected $stocks;

    /**
     * One Calidad has Many Stocks.
     * @ORM\OneToMany(targetEntity="SID\Api\MovementBundle\Entity\Movimiento", mappedBy="unidadMedida")
     */
    protected $movimientos;

    /**
     * One Calidad has Many Stocks.
     * @ORM\OneToMany(targetEntity="Conversion", mappedBy="de")
     */
    protected $conversionesOut;

    /**
     * One Calidad has Many Stocks.
     * @ORM\OneToMany(targetEntity="Conversion", mappedBy="a")
     */
    protected $conversionesIn;



    public function conversionPathTo(UnidadMedida $unidad)
    {
        if ($this->id == $unidad->id){
            return new Vector();
        }

        $q = new Queue(); $set = new Set(); $hash = new Map();
        foreach ($this->conversionesOut as $conversion) {
            $set->add($conversion);
            $q->push($conversion);
            $hash->put($conversion, null);
        }
        $last = null;
        while (!$q->isEmpty()){
            /* @var Conversion $current */
            $current = $q->pop();

            if($current->getA()->getId() == $unidad->getId() ){
                $last = $current;
                break;
            }

            foreach ($current->getA()->getConversionesOut() as $conversion) {
                if (!$set->contains($conversion)) {
                    $set->add($conversion);
                    $q->push($conversion);
                    $hash->put($conversion, $current);
                }

            }


        }


        function sequence($hash, $nodo, Sequence $lista=null): Sequence{
            if($nodo === null) return $lista;
            if($lista === null){ $lista = new Vector(); }
            $lista->push($nodo);
            return sequence($hash, $hash->get($nodo, null), $lista);
        };

        return sequence($hash, $current)->reversed();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaIngreso = new \DateTime();
        $this->drogas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stocks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->movimientos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->conversionesOut = new \Doctrine\Common\Collections\ArrayCollection();
        $this->conversionesIn = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return UnidadMedida
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
     * Set sigla
     *
     * @param string $sigla
     *
     * @return UnidadMedida
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return UnidadMedida
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
     * @param \SID\Api\SubstanceBundle\Entity\Droga $droga
     *
     * @return UnidadMedida
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
     * Add stock
     *
     * @param \SID\Api\DrugBundle\Entity\Stock $stock
     *
     * @return UnidadMedida
     */
    public function addStock(\SID\Api\DrugBundle\Entity\Stock $stock)
    {
        $this->stocks[] = $stock;

        return $this;
    }

    /**
     * Remove stock
     *
     * @param \SID\Api\DrugBundle\Entity\Stock $stock
     */
    public function removeStock(\SID\Api\DrugBundle\Entity\Stock $stock)
    {
        $this->stocks->removeElement($stock);
    }

    /**
     * Get stocks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * Add movimiento
     *
     * @param \SID\Api\MovementBundle\Entity\Movimiento $movimiento
     *
     * @return UnidadMedida
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
     * Add conversionesOut
     *
     * @param \SID\Api\SubstanceBundle\Entity\Conversion $conversionesOut
     *
     * @return UnidadMedida
     */
    public function addConversionesOut(\SID\Api\SubstanceBundle\Entity\Conversion $conversionesOut)
    {
        $this->conversionesOut[] = $conversionesOut;

        return $this;
    }

    /**
     * Remove conversionesOut
     *
     * @param \SID\Api\SubstanceBundle\Entity\Conversion $conversionesOut
     */
    public function removeConversionesOut(\SID\Api\SubstanceBundle\Entity\Conversion $conversionesOut)
    {
        $this->conversionesOut->removeElement($conversionesOut);
    }

    /**
     * Get conversionesOut
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConversionesOut()
    {
        return $this->conversionesOut;
    }

    /**
     * Add conversionesIn
     *
     * @param \SID\Api\SubstanceBundle\Entity\Conversion $conversionesIn
     *
     * @return UnidadMedida
     */
    public function addConversionesIn(\SID\Api\SubstanceBundle\Entity\Conversion $conversionesIn)
    {
        $this->conversionesIn[] = $conversionesIn;

        return $this;
    }

    /**
     * Remove conversionesIn
     *
     * @param \SID\Api\SubstanceBundle\Entity\Conversion $conversionesIn
     */
    public function removeConversionesIn(\SID\Api\SubstanceBundle\Entity\Conversion $conversionesIn)
    {
        $this->conversionesIn->removeElement($conversionesIn);
    }

    /**
     * Get conversionesIn
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConversionesIn()
    {
        return $this->conversionesIn;
    }
}
