<?php

namespace SID\Api\ProviderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comprobante
 *
 * @ORM\Table(name="comprobante")
 * @ORM\Entity(repositoryClass="SID\Api\ProviderBundle\Repository\ComprobanteRepository")
 */
class Comprobante
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
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Proveedor", inversedBy="comprobantes")
     * @ORM\JoinColumn(name="proveedor_id", referencedColumnName="id")
     */
    private $proveedor;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Tipo", inversedBy="comprobantes")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
     */
    private $tipo;


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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Comprobante
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Comprobante
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set proveedor
     *
     * @param \SID\Api\ProviderBundle\Entity\Proveedor $proveedor
     *
     * @return Comprobante
     */
    public function setProveedor(\SID\Api\ProviderBundle\Entity\Proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \SID\Api\ProviderBundle\Entity\Proveedor
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set tipo
     *
     * @param \SID\Api\ProviderBundle\Entity\Tipo $tipo
     *
     * @return Comprobante
     */
    public function setTipo(\SID\Api\ProviderBundle\Entity\Tipo $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \SID\Api\ProviderBundle\Entity\Tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
