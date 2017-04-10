<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadReguladora
 *
 * @ORM\Table(name="entidades_reguladoras")
 * @ORM\Entity(repositoryClass="SID\Api\SubstanceBundle\Repository\EntidadReguladoraRepository")
 */
class EntidadReguladora
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * Many Classes have Many Incompatibilities.
     * @ORM\ManyToMany(targetEntity="Droga", mappedBy="entidades")
     */
    private $drogas;


}
