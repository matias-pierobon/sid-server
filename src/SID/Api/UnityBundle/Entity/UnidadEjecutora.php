<?php

namespace SID\Api\UnityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\DrugBundle\Entity\DrogueroUnidad;

/**
 * UnidadEjecutora
 *
 * @ORM\Table(name="unidad_ejecutora")
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
     * @ORM\OneToMany(targetEntity="DrogueroUnidad", mappedBy="unidad")
     */
    private $drogueros;


}

