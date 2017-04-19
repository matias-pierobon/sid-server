<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subdivision
 *
 * @ORM\Table(name="subdivisiones")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\SubdivisionRepository")
 */
class Subdivision extends Division
{
    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;

    /**
     * Many Categories have One Category.
     * @ORM\ManyToOne(targetEntity="Division", inversedBy="subdivisiones")
     * @ORM\JoinColumn(name="padre_id", referencedColumnName="id")
     */
    private $parent;


    public function getDroguero(){
        return $this->parent->getDroguero();
    }



}
