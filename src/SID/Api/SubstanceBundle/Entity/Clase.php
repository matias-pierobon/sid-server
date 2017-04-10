<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clase
 *
 * @ORM\Table(name="clases_droga")
 * @ORM\Entity(repositoryClass="SID\Api\SubstanceBundle\Repository\ClaseRepository")
 */
class Clase
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
     * Many Classes have Many Drugs.
     * @ORM\ManyToMany(targetEntity="droga", mappedBy="clases")
     */
    private $drogas;

    /**
     * Many Classes have Many Incompatibilities.
     * @ORM\ManyToMany(targetEntity="Clase", mappedBy="incompatibleCon")
     */
    private $incompatibleConmigo;

    /**
     * Many Incompatibilitis have many classes.
     * @ORM\ManyToMany(targetEntity="Clase", inversedBy="incompatibleConmigo")
     * @ORM\JoinTable(name="incompatibilidades",
     *      joinColumns={@ORM\JoinColumn(name="droga_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="droga_incompatible_id", referencedColumnName="id")}
     *      )
     */
    private $incompatibleCon;


    public function incompatibilidades(){
        return;
    }



}
