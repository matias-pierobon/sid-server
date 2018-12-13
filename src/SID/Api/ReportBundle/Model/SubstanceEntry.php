<?php

namespace SID\Api\ReportBundle\Model;

use SID\Api\MovementBundle\Entity\Movimiento;
use SID\Api\SubstanceBundle\Entity\Droga;
use SID\Api\SubstanceBundle\Model\Cantidad;

class SubstanceEntry
{

    /**
     * @var Cantidad
     **/
    private $initial;

    /**
     * @var Cantidad
     **/
    private $final;

    /**
     * @var MotiveEntry
     **/
    private $movements;

    public function __construct(Droga $substance)
    {
        $this->initial = $this->initUnit($substance);
        $this->movements = new MotiveEntry();
        $this->final = $this->initUnit($substance);
    }

    public function add(Movimiento $movimiento)
    {
        $this->movements->add($movimiento);
    }

    public function init(Movimiento $movimiento)
    {
        $this->initial->add($this->getCantidad($movimiento));
    }

    public function process(Movimiento $movimiento)
    {
        $this->final->add($this->getCantidad($movimiento));
    }

    public function count()
    {
        return $this->movements->count();
    }

    /**
     * @return MotiveEntry
     */
    public function getMovements()
    {
        return $this->movements;
    }

    /**
     * @return Cantidad
     */
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * @return Cantidad
     */
    public function getInitial()
    {
        return $this->initial;
    }

    /**
     * @param Movimiento $movimiento
     * @return Cantidad
     */
    private function getCantidad(Movimiento $movimiento)
    {
        return new Cantidad(floatval($movimiento->getCantidad()), $movimiento->getUnidadMedida());
    }

    /**
     * @param Droga $substance
     * @return Cantidad
     */
    private function initUnit(Droga $substance)
    {
        return new Cantidad(0, $substance->getUnidadMedida());
    }

}