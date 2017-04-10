<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subdivision
 *
 * @ORM\Table(name="subdivision")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\SubdivisionRepository")
 */
class Subdivision
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
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;


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
     * Set alias
     *
     * @param string $alias
     *
     * @return Subdivision
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }
}

