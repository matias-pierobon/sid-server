<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Droga
 *
 * @ORM\Table(name="droga")
 * @ORM\Entity(repositoryClass="SID\Api\SubstanceBundle\Repository\DrogaRepository")
 */
class Droga
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
     * @ORM\Column(name="desechos", type="string", length=255, nullable=true)
     */
    private $desechos;

    /**
     * @var string
     *
     * @ORM\Column(name="fichaSeguridad", type="text", nullable=true)
     */
    private $fichaSeguridad;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_medida", type="string", length=255, nullable=true)
     */
    private $tipoMedida;

    /**
     * @var int
     *
     * @ORM\Column(name="cid", type="integer", nullable=true)
     */
    private $cid;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="formulaMolecular", type="string", length=255, nullable=true)
     */
    private $formulaMolecular;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaIngreso", type="datetime")
     */
    private $fechaIngreso;

    /**
     * @var string
     *
     * @ORM\Column(name="densidad", type="string", length=255)
     */
    private $densidad;

    /**
     * @var string
     *
     * @ORM\Column(name="accionesEmergencia", type="text")
     */
    private $accionesEmergencia;

    /**
     * @var string
     *
     * @ORM\Column(name="cas", type="string", length=255, nullable=true)
     */
    private $cas;

    /**
     * @var string
     *
     * @ORM\Column(name="smiles", type="string", length=255, nullable=true)
     */
    private $smiles;

    /**
     * @var bool
     *
     * @ORM\Column(name="rec_alm", type="boolean", nullable=true)
     */
    private $recAlm;


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
     * Set desechos
     *
     * @param string $desechos
     *
     * @return Droga
     */
    public function setDesechos($desechos)
    {
        $this->desechos = $desechos;

        return $this;
    }

    /**
     * Get desechos
     *
     * @return string
     */
    public function getDesechos()
    {
        return $this->desechos;
    }

    /**
     * Set fichaSeguridad
     *
     * @param string $fichaSeguridad
     *
     * @return Droga
     */
    public function setFichaSeguridad($fichaSeguridad)
    {
        $this->fichaSeguridad = $fichaSeguridad;

        return $this;
    }

    /**
     * Get fichaSeguridad
     *
     * @return string
     */
    public function getFichaSeguridad()
    {
        return $this->fichaSeguridad;
    }

    /**
     * Set tipoMedida
     *
     * @param string $tipoMedida
     *
     * @return Droga
     */
    public function setTipoMedida($tipoMedida)
    {
        $this->tipoMedida = $tipoMedida;

        return $this;
    }

    /**
     * Get tipoMedida
     *
     * @return string
     */
    public function getTipoMedida()
    {
        return $this->tipoMedida;
    }

    /**
     * Set cid
     *
     * @param integer $cid
     *
     * @return Droga
     */
    public function setCid($cid)
    {
        $this->cid = $cid;

        return $this;
    }

    /**
     * Get cid
     *
     * @return int
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Droga
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
     * Set formulaMolecular
     *
     * @param string $formulaMolecular
     *
     * @return Droga
     */
    public function setFormulaMolecular($formulaMolecular)
    {
        $this->formulaMolecular = $formulaMolecular;

        return $this;
    }

    /**
     * Get formulaMolecular
     *
     * @return string
     */
    public function getFormulaMolecular()
    {
        return $this->formulaMolecular;
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return Droga
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
     * Set densidad
     *
     * @param string $densidad
     *
     * @return Droga
     */
    public function setDensidad($densidad)
    {
        $this->densidad = $densidad;

        return $this;
    }

    /**
     * Get densidad
     *
     * @return string
     */
    public function getDensidad()
    {
        return $this->densidad;
    }

    /**
     * Set accionesEmergencia
     *
     * @param string $accionesEmergencia
     *
     * @return Droga
     */
    public function setAccionesEmergencia($accionesEmergencia)
    {
        $this->accionesEmergencia = $accionesEmergencia;

        return $this;
    }

    /**
     * Get accionesEmergencia
     *
     * @return string
     */
    public function getAccionesEmergencia()
    {
        return $this->accionesEmergencia;
    }

    /**
     * Set cas
     *
     * @param string $cas
     *
     * @return Droga
     */
    public function setCas($cas)
    {
        $this->cas = $cas;

        return $this;
    }

    /**
     * Get cas
     *
     * @return string
     */
    public function getCas()
    {
        return $this->cas;
    }

    /**
     * Set smiles
     *
     * @param string $smiles
     *
     * @return Droga
     */
    public function setSmiles($smiles)
    {
        $this->smiles = $smiles;

        return $this;
    }

    /**
     * Get smiles
     *
     * @return string
     */
    public function getSmiles()
    {
        return $this->smiles;
    }

    /**
     * Set recAlm
     *
     * @param boolean $recAlm
     *
     * @return Droga
     */
    public function setRecAlm($recAlm)
    {
        $this->recAlm = $recAlm;

        return $this;
    }

    /**
     * Get recAlm
     *
     * @return bool
     */
    public function getRecAlm()
    {
        return $this->recAlm;
    }
}

