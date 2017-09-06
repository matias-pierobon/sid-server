<?php

namespace SID\Api\ProviderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proveedor
 *
 * @ORM\Table(name="proveedor")
 * @ORM\Entity(repositoryClass="SID\Api\ProviderBundle\Repository\ProveedorRepository")
 */
class Proveedor
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
     * @ORM\Column(name="cuit", type="string", length=255, unique=true)
     */
    private $cuit;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="cufe", type="string", length=255, nullable=true)
     */
    private $cufe;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="text", nullable=true)
     */
    private $contacto;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * One Movement has Many Users.
     * @ORM\OneToMany(targetEntity="Comprobante", mappedBy="proveedor")
     */
    private $comprobantes;

    public function __toString()
    {
        return $this->nombre . " (" . $this->cuit . ")";
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comprobantes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cuit
     *
     * @param string $cuit
     *
     * @return Proveedor
     */
    public function setCuit($cuit)
    {
        $this->cuit = $cuit;

        return $this;
    }

    /**
     * Get cuit
     *
     * @return string
     */
    public function getCuit()
    {
        return $this->cuit;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Proveedor
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Proveedor
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set cufe
     *
     * @param string $cufe
     *
     * @return Proveedor
     */
    public function setCufe($cufe)
    {
        $this->cufe = $cufe;

        return $this;
    }

    /**
     * Get cufe
     *
     * @return string
     */
    public function getCufe()
    {
        return $this->cufe;
    }

    /**
     * Set contacto
     *
     * @param string $contacto
     *
     * @return Proveedor
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return string
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return Proveedor
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get detalle
     *
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Proveedor
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Add comprobante
     *
     * @param \SID\Api\ProviderBundle\Entity\Comprobante $comprobante
     *
     * @return Proveedor
     */
    public function addComprobante(\SID\Api\ProviderBundle\Entity\Comprobante $comprobante)
    {
        $this->comprobantes[] = $comprobante;

        return $this;
    }

    /**
     * Remove comprobante
     *
     * @param \SID\Api\ProviderBundle\Entity\Comprobante $comprobante
     */
    public function removeComprobante(\SID\Api\ProviderBundle\Entity\Comprobante $comprobante)
    {
        $this->comprobantes->removeElement($comprobante);
    }

    /**
     * Get comprobantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComprobantes()
    {
        return $this->comprobantes;
    }
}
