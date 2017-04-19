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
     * @ORM\OneToMany(targetEntity="SID\Api\DrugBundle\Entity\Stock", mappedBy="droga")
     */
    private $stock;


}
