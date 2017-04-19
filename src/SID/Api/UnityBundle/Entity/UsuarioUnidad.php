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
     * Set desde
     *
     * @param \DateTime $desde
     *
     * @return UsuarioUnidad
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
     * Set hasta
     *
     * @param \DateTime $hasta
     *
     * @return UsuarioUnidad
     */
    public function setHasta($hasta)
    {
        $this->hasta = $hasta;

        return $this;
    }

    /**
     * Get hasta
     *
     * @return \DateTime
     */
    public function getHasta()
    {
        return $this->hasta;
    }

    /**
     * Set usuario
     *
     * @param \SID\Api\UserBundle\Entity\User $usuario
     *
     * @return UsuarioUnidad
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
     * Set unidad
     *
     * @param \SID\Api\UnityBundle\Entity\UnidadEjecutora $unidad
     *
     * @return UsuarioUnidad
     */
    public function setUnidad(\SID\Api\UnityBundle\Entity\UnidadEjecutora $unidad = null)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return \SID\Api\UnityBundle\Entity\UnidadEjecutora
     */
    public function getUnidad()
    {
        return $this->unidad;
    }
}
