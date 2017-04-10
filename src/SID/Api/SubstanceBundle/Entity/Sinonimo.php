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

}

