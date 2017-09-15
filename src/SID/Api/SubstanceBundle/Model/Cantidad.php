<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 9/15/17
 * Time: 11:16 AM
 */

namespace SID\Api\SubstanceBundle\Model;


use SID\Api\SubstanceBundle\Entity\Conversion;
use SID\Api\SubstanceBundle\Entity\UnidadMedida;

class Cantidad
{
    private $valor;
    private $densidad;
    private $unidad;

    public function __construct(float $valor, UnidadMedida $unidad, $densidad)
    {
        $this->unidad = $unidad;
        $this->densidad = $densidad;
        $this->valor = $valor;
    }

    function __toString()
    {
        return $this->valor . " " . $this->unidad->getSigla();
    }

    public function add(Cantidad $cantidad)
    {
        $this->valor += $cantidad->convertirA($this->unidad)->valor;
    }

    public function convertirA(UnidadMedida $unidadMedida){
        return $this->applyPath($this->unidad->conversionPathTo($unidadMedida));
    }

    public function applyConversion(Conversion $conversion)
    {
        return new Cantidad($conversion->evaluate($this->valor, $this->densidad), $conversion->getA(), $this->densidad);
    }

    public function applyPath($path)
    {
        if($path->isEmpty()){
            return $this;
        }

        return $this->applyConversion($path->shift())->applyPath($path);
    }

    /**
     * @return mixed
     */
    public function getDensidad()
    {
        return $this->densidad;
    }

    /**
     * @param mixed $densidad
     */
    public function setDensidad($densidad)
    {
        $this->densidad = $densidad;
    }

    /**
     * @return mixed
     */
    public function getUnidad() : UnidadMedida
    {
        return $this->unidad;
    }

    /**
     * @param mixed $unidad
     */
    public function setUnidad(UnidadMedida $unidad)
    {
        $this->unidad = $unidad;
    }

    /**
     * @return mixed
     */
    public function getValor() : float
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setValor(float $valor)
    {
        $this->valor = $valor;
    }
}