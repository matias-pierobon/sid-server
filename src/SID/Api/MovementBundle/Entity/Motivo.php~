<?php

namespace SID\Api\MovementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Motivo
 *
 * @ORM\Table(name="motivos_movimientos")
 * @ORM\Entity(repositoryClass="SID\Api\MovementBundle\Repository\MotivoRepository")
 */
class Motivo
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
     * @ORM\Column(name="detalle", type="text")
     */
    private $detalle;

    /**
     * One Movement has Many Users.
     * @ORM\OneToMany(targetEntity="Movimiento", mappedBy="motivo")
     */
    private $movimientos;


}
