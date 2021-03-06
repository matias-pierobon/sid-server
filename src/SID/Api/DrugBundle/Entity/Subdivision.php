<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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


    public function getDroguero() : Droguero{
        return $this->parent->getDroguero();
    }

    public function isDroguero():bool{
        return false;
    }

    public function getPath(): ArrayCollection
    {
        $path = $this->parent->getPath();
        $path->add($this);
        return $path;
    }

    public function __toString()
    {
        return $this->getAlias();
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stocks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subdiviciones = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set parent
     *
     * @param \SID\Api\DrugBundle\Entity\Division $parent
     *
     * @return Subdivision
     */
    public function setParent(\SID\Api\DrugBundle\Entity\Division $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \SID\Api\DrugBundle\Entity\Division
     */
    public function getParent()
    {
        return $this->parent;
    }
}
