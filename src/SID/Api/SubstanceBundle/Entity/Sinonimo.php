<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sinonimo
 *
 * @ORM\Table(name="sinonimo")
 * @ORM\Entity(repositoryClass="SID\Api\SubstanceBundle\Repository\SinonimoRepository")
 */
class Sinonimo
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
     * @var \stdClass
     *
     * @ORM\Column(name="droga", type="object")
     */
    private $droga;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Sinonimo
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
     * Set droga
     *
     * @param \stdClass $droga
     *
     * @return Sinonimo
     */
    public function setDroga($droga)
    {
        $this->droga = $droga;

        return $this;
    }

    /**
     * Get droga
     *
     * @return \stdClass
     */
    public function getDroga()
    {
        return $this->droga;
    }
}

