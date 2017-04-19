<?php

namespace SID\Api\UnityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\DrugBundle\Entity\DrogueroUnidad;

/**
 * UnidadEjecutora
 *
 * @ORM\Table(name="unidades_ejecutoras")
 * @ORM\Entity(repositoryClass="SID\Api\UnityBundle\Repository\UnidadEjecutoraRepository")
 */
class UnidadEjecutora
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
     * @ORM\Column(name="cufe", type="string", length=255)
     */
    private $cufe;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text")
     */
    private $detalle;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="SID\Api\DrugBundle\Entity\DrogueroUnidad", mappedBy="unidad")
     */
    private $drogueros;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Tipo", inversedBy="unidades")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
     */
    private $tipo;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="UsuarioUnidad", mappedBy="unidad")
     */
    private $integrantes;


}
