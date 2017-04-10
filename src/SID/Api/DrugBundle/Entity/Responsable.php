<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\UserBundle\Entity\User;

/**
 * Responsable
 *
 * @ORM\Table(name="droguero_responsables")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\ResponsableRepository")
 */
class Responsable
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
     * @ORM\Column(name="fecha_desde", type="datetime")
     */
    private $desde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hasta", type="datetime", nullable=true)
     */
    private $hasta;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Droguero", inversedBy="unidades")
     * @ORM\JoinColumn(name="droguero_id", referencedColumnName="id")
     */
    private $droguero;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="droguerosResponsables")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


}