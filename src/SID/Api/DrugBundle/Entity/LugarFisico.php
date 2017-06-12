<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * LugarFisico
 *
 * @ORM\Table(name="lugar_fisico")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\LugarFisicoRepository")
 */
class LugarFisico
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
     * @ORM\Column(name="sysDate", type="datetimetz")
     */
    private $sysDate;

    /**
     * @var float
     *
     * @ORM\Column(name="latitud", type="float", nullable=true)
     */
    private $latitud;

    /**
     * @var float
     *
     * @ORM\Column(name="longitud", type="float", nullable=true)
     */
    private $longitud;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="imageMime", type="string", length=64, nullable=true)
     */
    private $imageMime;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Droguero", mappedBy="lugar", cascade={"persist"})
     */
    private $drogueros;


    public function __construct()
    {
        $this->sysDate = new \DateTime();
        $this->drogueros = new ArrayCollection();
    }

    /**
     * @param UploadedFile $file
     * @return $this
     */
    public function setImageBlob($file)
    {
        if (!$file){
            $this->setImage(null);
            $this->setImageMime(null);
            return $this;
        }
        if(!$file->isValid()){
            throw new FileException("Invalid File");
        }
        $imageFile    = fopen($file->getRealPath(), 'r');
        $imageContent = fread($imageFile, $file->getClientSize());
        fclose($imageFile);
        $this->setImage($imageContent);
        $this->setImageMime($file->getMimeType());
        return $this;
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
     * Set sysDate
     *
     * @param \DateTime $sysDate
     *
     * @return LugarFisico
     */
    public function setSysDate($sysDate)
    {
        $this->sysDate = $sysDate;

        return $this;
    }

    /**
     * Get sysDate
     *
     * @return \DateTime
     */
    public function getSysDate()
    {
        return $this->sysDate;
    }

    /**
     * Set latitud
     *
     * @param float $latitud
     *
     * @return LugarFisico
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get latitud
     *
     * @return float
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param float $longitud
     *
     * @return LugarFisico
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return float
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return LugarFisico
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
     * Set detalle
     *
     * @param string $detalle
     *
     * @return LugarFisico
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
     * Set image
     *
     * @param string $image
     *
     * @return LugarFisico
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set imageMime
     *
     * @param string $imageMime
     *
     * @return LugarFisico
     */
    public function setImageMime($imageMime)
    {
        $this->imageMime = $imageMime;

        return $this;
    }

    /**
     * Get imageMime
     *
     * @return string
     */
    public function getImageMime()
    {
        return $this->imageMime;
    }

    /**
     * Add droguero
     *
     * @param \SID\Api\DrugBundle\Entity\Droguero $droguero
     *
     * @return LugarFisico
     */
    public function addDroguero(Droguero $droguero)
    {
        $this->drogueros->add($droguero);

        return $this;
    }

    /**
     * Remove droguero
     *
     * @param \SID\Api\DrugBundle\Entity\Droguero $droguero
     */
    public function removeDroguero(Droguero $droguero)
    {
        $this->drogueros->removeElement($droguero);
    }

    /**
     * Get drogueros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDrogueros()
    {
        return $this->drogueros;
    }
}
