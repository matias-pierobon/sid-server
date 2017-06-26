<?php

namespace SID\Api\MovementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovimientoFisico
 *
 * @ORM\Table(name="movimiento_fisico")
 * @ORM\Entity(repositoryClass="SID\Api\MovementBundle\Repository\MovimientoFisicoRepository")
 */
class MovimientoFisico
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
     * @ORM\Column(name="desde", type="datetime")
     */
    private $desde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hashta", type="datetime", nullable=true)
     */
    private $hashta;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="SID\Api\UserBundle\Entity\User", inversedBy="extracciones")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $usuario;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="SID\Api\DrugBundle\Entity\Stock", inversedBy="extracciones")
     * @ORM\JoinColumn(name="stock_id", referencedColumnName="id")
     */
    private $stock;


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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set desde
     *
     * @param \DateTime $desde
     *
     * @return $this
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
     * Set hashta
     *
     * @param \DateTime $hashta
     *
     * @return $this
     */
    public function setHashta($hashta)
    {
        $this->hashta = $hashta;

        return $this;
    }

    /**
     * Get hashta
     *
     * @return \DateTime
     */
    public function getHashta()
    {
        return $this->hashta;
    }

    /**
     * Set usuario
     *
     * @param \SID\Api\UserBundle\Entity\User $usuario
     *
     * @return $this
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
     * @return $this
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
}

