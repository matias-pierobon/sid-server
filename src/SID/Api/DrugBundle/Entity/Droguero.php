<?php

namespace SID\Api\DrugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\UnityBundle\Entity\UnidadEjecutora;
use SID\Api\UserBundle\Entity\User;

/**
 * Droguero
 *
 * @ORM\Table(name="drogueros")
 * @ORM\Entity(repositoryClass="SID\Api\DrugBundle\Repository\DrogueroRepository")
 */
class Droguero extends Division
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="datetime")
     */
    private $fechaIngreso;

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
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="DrogueroUnidad", mappedBy="droguero", cascade={"persist"})
     */
    private $unidades;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Responsable", mappedBy="droguero", cascade={"persist"})
     */
    private $responsables;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Acceso", mappedBy="droguero", cascade={"persist"})
     */
    private $accesos;


    public function getDroguero(){
        return $this;
    }

    public function getDrogas()
    {
        return $this->stocks->toArray();
    }

    public function getResponsable(){
        foreach ($this->getResponsables() as $responsable) {
            if($responsable->getHasta() == null){
                return $responsable;
            }
        }
        return null;
    }

    public function hasAccess(User $user){
        if($this->getResponsable()->getId() == $user->getId()){
            return true;
        }

        return $this->accesos->exists(function ($key, $acceso) use ($user){
            return ($acceso->getUser()->getId() == $user->getId() and $acceso->getHasta() == null);
        });
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaIngreso = new \DateTime();
        $this->unidades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->responsables = new \Doctrine\Common\Collections\ArrayCollection();
        $this->accesos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stocks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subdiviciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return Droguero
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set latitud
     *
     * @param float $latitud
     *
     * @return Droguero
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
     * @return Droguero
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
     * Add unidade
     *
     * @param \SID\Api\DrugBundle\Entity\DrogueroUnidad $unidade
     *
     * @return Droguero
     */
    public function addUnidad(UnidadEjecutora $unidad)
    {
        $this->unidades->add(new DrogueroUnidad($this, $unidad));

        return $this;
    }

    /**
     * Remove unidade
     *
     * @param \SID\Api\DrugBundle\Entity\DrogueroUnidad $unidade
     */
    public function removeUnidad(\SID\Api\DrugBundle\Entity\DrogueroUnidad $unidad)
    {
        $this->unidades->removeElement($unidad);
    }

    /**
     * Get unidades
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Add responsable
     *
     * @param \SID\Api\DrugBundle\Entity\Responsable $responsable
     *
     * @return Droguero
     */
    public function addResponsable(\SID\Api\DrugBundle\Entity\Responsable $responsable)
    {
        $this->responsables[] = $responsable;

        return $this;
    }

    /**
     * Remove responsable
     *
     * @param \SID\Api\DrugBundle\Entity\Responsable $responsable
     */
    public function removeResponsable(\SID\Api\DrugBundle\Entity\Responsable $responsable)
    {
        $this->responsables->removeElement($responsable);
    }

    /**
     * Get responsables
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponsables()
    {
        return $this->responsables;
    }

    /**
     * Add acceso
     *
     * @param \SID\Api\UserBundle\Entity\User $user
     *
     * @return Droguero
     */
    public function addAcceso(User $user)
    {
        $this->accesos->add(new Acceso($this, $user));

        return $this;
    }

    /**
     * Remove acceso
     *
     * @param \SID\Api\DrugBundle\Entity\Acceso $acceso
     */
    public function removeAcceso(\SID\Api\DrugBundle\Entity\Acceso $acceso)
    {
        if($this->accesos->contains($acceso)){
            $acceso->setHasta(new \DateTime());
        }
    }

    /**
     * Get accesos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccesos()
    {
        return $this->accesos;
    }
}
