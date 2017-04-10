<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Division
 *
 * @ORM\Table(name="divisiones")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\DivisionRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"subdivision" = "Subdivision", "droguero" = "Droguero"})
 */
class Division
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", nullable=true)
     */
    protected $detalle;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", nullable=true)
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="image_mime", type="string", length=255, nullable=true)
     */
    protected $imageMime;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    protected $nombre;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="division")
     */
    protected $stocks;

    /**
     * One Category has Many Categories.
     * @ORM\OneToMany(targetEntity="Subdivision", mappedBy="padre")
     */
    protected $subdiviciones;


}
