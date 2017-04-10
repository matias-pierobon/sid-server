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



}
