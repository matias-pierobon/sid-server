<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\DrugBundle\Entity\Stock;

/**
 * Droga
 *
 * @ORM\Table(name="drogas")
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
     * @ORM\Column(name="densidad", type="string", length=255, nullable=true)
     */
    private $densidad;

    /**
     * @var string
     *
     * @ORM\Column(name="accionesEmergencia", type="text", nullable=true)
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
     * Many Incompatibilitis have many classes.
     * @ORM\ManyToMany(targetEntity="Clase", inversedBy="drogas")
     * @ORM\JoinTable(name="clase_droga",
     *      joinColumns={@ORM\JoinColumn(name="clase_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="droga_id", referencedColumnName="id")}
     *      )
     */
    private $clases;

    /**
     * Many Incompatibilitis have many classes.
     * @ORM\ManyToMany(targetEntity="GHS", inversedBy="drogas")
     * @ORM\JoinTable(name="ghs_droga",
     *      joinColumns={@ORM\JoinColumn(name="ghs_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="droga_id", referencedColumnName="id")}
     *      )
     */
    private $ghs;

    /**
     * Many Incompatibilitis have many classes.
     * @ORM\ManyToMany(targetEntity="EntidadReguladora", inversedBy="drogas")
     * @ORM\JoinTable(name="entidad_reguladora_droga",
     *      joinColumns={@ORM\JoinColumn(name="entidad_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="droga_id", referencedColumnName="id")}
     *      )
     */
    private $entidades;

    /**
     * Many Incompatibilitis have many classes.
     * @ORM\ManyToMany(targetEntity="Sinonimo", inversedBy="drogas")
     * @ORM\JoinTable(name="sinonimo_droga",
     *      joinColumns={@ORM\JoinColumn(name="sinonimo_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="droga_id", referencedColumnName="id")}
     *      )
     */
    private $sinonimos;

    /**
     * One Movement has Many Users.
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="droga")
     */
    private $stock;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clases = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ghs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->entidades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sinonimos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stock = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return integer
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
     * @return boolean
     */
    public function getRecAlm()
    {
        return $this->recAlm;
    }

    /**
     * Add clase
     *
     * @param \SID\Api\SubstanceBundle\Entity\Clase $clase
     *
     * @return Droga
     */
    public function addClase(\SID\Api\SubstanceBundle\Entity\Clase $clase)
    {
        $this->clases[] = $clase;

        return $this;
    }

    /**
     * Remove clase
     *
     * @param \SID\Api\SubstanceBundle\Entity\Clase $clase
     */
    public function removeClase(\SID\Api\SubstanceBundle\Entity\Clase $clase)
    {
        $this->clases->removeElement($clase);
    }

    /**
     * Get clases
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClases()
    {
        return $this->clases;
    }

    /**
     * Add gh
     *
     * @param \SID\Api\SubstanceBundle\Entity\GHS $gh
     *
     * @return Droga
     */
    public function addGh(\SID\Api\SubstanceBundle\Entity\GHS $gh)
    {
        $this->ghs[] = $gh;

        return $this;
    }

    /**
     * Remove gh
     *
     * @param \SID\Api\SubstanceBundle\Entity\GHS $gh
     */
    public function removeGh(\SID\Api\SubstanceBundle\Entity\GHS $gh)
    {
        $this->ghs->removeElement($gh);
    }

    /**
     * Get ghs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGhs()
    {
        return $this->ghs;
    }

    /**
     * Add entidade
     *
     * @param \SID\Api\SubstanceBundle\Entity\EntidadReguladora $entidade
     *
     * @return Droga
     */
    public function addEntidade(\SID\Api\SubstanceBundle\Entity\EntidadReguladora $entidade)
    {
        $this->entidades[] = $entidade;

        return $this;
    }

    /**
     * Remove entidade
     *
     * @param \SID\Api\SubstanceBundle\Entity\EntidadReguladora $entidade
     */
    public function removeEntidade(\SID\Api\SubstanceBundle\Entity\EntidadReguladora $entidade)
    {
        $this->entidades->removeElement($entidade);
    }

    /**
     * Get entidades
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntidades()
    {
        return $this->entidades;
    }

    /**
     * Add sinonimo
     *
     * @param \SID\Api\SubstanceBundle\Entity\Sinonimo $sinonimo
     *
     * @return Droga
     */
    public function addSinonimo(\SID\Api\SubstanceBundle\Entity\Sinonimo $sinonimo)
    {
        $this->sinonimos[] = $sinonimo;

        return $this;
    }

    /**
     * Remove sinonimo
     *
     * @param \SID\Api\SubstanceBundle\Entity\Sinonimo $sinonimo
     */
    public function removeSinonimo(\SID\Api\SubstanceBundle\Entity\Sinonimo $sinonimo)
    {
        $this->sinonimos->removeElement($sinonimo);
    }

    /**
     * Get sinonimos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSinonimos()
    {
        return $this->sinonimos;
    }

    /**
     * Add stock
     *
     * @param \SID\Api\SubstanceBundle\Entity\Stock $stock
     *
     * @return Droga
     */
    public function addStock(\SID\Api\SubstanceBundle\Entity\Stock $stock)
    {
        $this->stock[] = $stock;

        return $this;
    }

    /**
     * Remove stock
     *
     * @param \SID\Api\SubstanceBundle\Entity\Stock $stock
     */
    public function removeStock(\SID\Api\SubstanceBundle\Entity\Stock $stock)
    {
        $this->stock->removeElement($stock);
    }

    /**
     * Get stock
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStock()
    {
        return $this->stock;
    }
}
