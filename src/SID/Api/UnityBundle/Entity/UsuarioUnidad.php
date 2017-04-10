<?php

namespace SID\Api\UnityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\UserBundle\Entity\User;

/**
 * UsuarioUnidad
 *
 * @ORM\Table(name="usuario_unidad")
 * @ORM\Entity(repositoryClass="SID\Api\UnityBundle\Repository\UsuarioUnidadRepository")
 */
class UsuarioUnidad
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
     * @ORM\Column(name="hasta", type="datetime", nullable=true)
     */
    private $hasta;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="SID\Api\UserBundle\Entity\User", inversedBy="unidades")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private $usuario;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="UnidadEjecutora", inversedBy="integrantes")
     * @ORM\JoinColumn(name="unidad_id", referencedColumnName="id")
     */
    private $unidad;


}
