<?php

namespace SID\Api\SubstanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Conversion
 *
 * @ORM\Table(name="conversion")
 * @ORM\Entity(repositoryClass="SID\Api\SubstanceBundle\Repository\ConversionRepository")
 */
class Conversion implements  \Ds\Hashable
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
     * @ORM\Column(name="formula", type="string", length=255)
     */
    private $formula;

    /**
     * Many Categories have One Category.
     * @ORM\ManyToOne(targetEntity="UnidadMedida", inversedBy="conversionesOut")
     * @ORM\JoinColumn(name="from_id", referencedColumnName="id")
     */
    private $de;

    /**
     * Many Categories have One Category.
     * @ORM\ManyToOne(targetEntity="UnidadMedida", inversedBy="conversionesIn")
     * @ORM\JoinColumn(name="to_id", referencedColumnName="id")
     */
    private $a;


    public function equals($obj) : bool {
        return ($obj instanceof self) && ($this->getId() === $obj->getId());
    }

    public function hash(){
        return $this->id;
    }

    function __toString()
    {
        return $this->getDe()->getSigla() . " -> " . $this->getA()->getSigla();
    }

    /**
     * @return bool
     */
    public function reqDensidad(){
        return strpos($this->formula,"d") !== false;
    }

    /**
     * @param null $value
     * @param null $densidad
     * @return float
     */
    public function evaluate($value = null, $densidad = null){
        $language = new ExpressionLanguage();
        return floatval($language->evaluate(
            $this->formula,
            array('x' => $value, 'd' => $densidad)
        ));
    }


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
     * Set formula
     *
     * @param string $formula
     *
     * @return Conversion
     */
    public function setFormula($formula)
    {
        $this->formula = $formula;

        return $this;
    }

    /**
     * Get formula
     *
     * @return string
     */
    public function getFormula()
    {
        return $this->formula;
    }

    /**
     * Set de
     *
     * @param \SID\Api\SubstanceBundle\Entity\UnidadMedida $de
     *
     * @return Conversion
     */
    public function setDe(\SID\Api\SubstanceBundle\Entity\UnidadMedida $de = null)
    {
        $this->de = $de;

        return $this;
    }

    /**
     * Get de
     *
     * @return \SID\Api\SubstanceBundle\Entity\UnidadMedida
     */
    public function getDe()
    {
        return $this->de;
    }

    /**
     * Set a
     *
     * @param \SID\Api\SubstanceBundle\Entity\UnidadMedida $a
     *
     * @return Conversion
     */
    public function setA(\SID\Api\SubstanceBundle\Entity\UnidadMedida $a = null)
    {
        $this->a = $a;

        return $this;
    }

    /**
     * Get a
     *
     * @return \SID\Api\SubstanceBundle\Entity\UnidadMedida
     */
    public function getA()
    {
        return $this->a;
    }
}
