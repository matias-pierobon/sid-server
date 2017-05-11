<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\UserBundle\Entity\User;

/**
 * Acceso
 *
 * @ORM\Table(name="acceso")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\AccesoRepository")
 */
class Acceso
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
     * @ORM\ManyToOne(targetEntity="Droguero", inversedBy="accesos")
     * @ORM\JoinColumn(name="droguero_id", referencedColumnName="id")
     */
    private $droguero;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="SID\Api\UserBundle\Entity\User", inversedBy="misDrogueros")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function __construct(Droguero $droguero, User $user)
    {
        $this->desde = new \DateTime();
        $this->droguero = $droguero;
        $this->user = $user;
    }


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
     * Set desde
     *
     * @param \DateTime $desde
     *
     * @return Acceso
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
     * @return Acceso
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
     * Set droguero
     *
     * @param \SID\Api\DrugBundle\Entity\Droguero $droguero
     *
     * @return Responsable
     */
    public function setDroguero(\SID\Api\DrugBundle\Entity\Droguero $droguero = null)
    {
        $this->droguero = $droguero;

        return $this;
    }

    /**
     * Get droguero
     *
     * @return \SID\Api\DrugBundle\Entity\Droguero
     */
    public function getDroguero()
    {
        return $this->droguero;
    }

    /**
     * Set user
     *
     * @param \SID\Api\UserBundle\Entity\User $user
     *
     * @return Responsable
     */
    public function setUser(\SID\Api\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \SID\Api\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}

