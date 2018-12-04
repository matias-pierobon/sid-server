<?php

namespace SID\Api\ReportBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use SID\Api\DrugBundle\Entity\Droguero;
use SID\Api\DrugBundle\Entity\Stock;
use SID\Api\MovementBundle\Entity\Motivo;
use SID\Api\MovementBundle\Entity\Movimiento;
use SID\Api\SubstanceBundle\Entity\Droga;
use SID\Api\SubstanceBundle\Model\Cantidad;

class Report
{

    /**
     * @var array
     */
    private $substances;

    /**
     * @var \DateTime
     */
    private $from;

    /**
     * @var \DateTime
     */
    private $to;


    public function __construct($substances, $movements, $from, $to)
    {
        $this->substances = array();
        $this->initializeSubstances($substances, $movements);
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return array
     */
    public function getSubstances()
    {
        return $this->substances;
    }

    /**
     * @return \DateTime
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return \DateTime
     */
    public function getTo()
    {
        return $this->to;
    }

    private function initializeSubstances($substances, $movements)
    {
        foreach ($substances as $substance) {
            $this->substances[$substance->getId()] = array(
              'substance' => $substance,
              'report' => array(
                'initial' => $this->initUnit($substance),
                'movements' => $this->initializeMovements($movements, $substance),
                'final' => $this->initUnit($substance)
              )
            );
        }
    }

    /**
     * @param Droga $substance
     * @return Cantidad
     */
    private function initUnit(Droga $substance)
    {
        return new Cantidad(0, $substance->getUnidadMedida());
    }

    private function initializeMovements(array $movements, Droga $substance)
    {
        $entries = array();
        /** @var Motivo $movement */
        foreach ($movements as $movement) {
            $entries[$movement->getId()] = array(
              'motive' => $movement,
              'amount' => $this->initUnit($substance)
            );
        }
        return $entries;
    }

    public function process(Droguero $droguero)
    {
        /** @var Stock $stock */
        foreach ($droguero->getStocks() as $stock) {
            /** @var Movimiento $movimiento */
            foreach ($stock->getMovimientos() as $movimiento) {
                if (($movimiento->getDesde() <= $this->to) && ($this->exists($movimiento->getDroga()))) {
                    $this->updateMovement($movimiento);
                }
            }
        }
    }

    private function getCantidad(Movimiento $movimiento)
    {
        return new Cantidad(floatval($movimiento->getCantidad()), $movimiento->getUnidadMedida());
    }

    private function updateMovement(Movimiento $movimiento)
    {
        $cantidad = $this->getCantidad($movimiento);
        if ($movimiento->getDesde() < $this->from) {
            $this->getInitial($movimiento->getDroga())->add($cantidad);
        } else {
            $this->getAmount($movimiento->getDroga(), $movimiento->getMotivo())->add($cantidad);
        }

        $this->getFinal($movimiento->getDroga())->add($cantidad);
    }

    /**
     * @param Droga $substance
     * @return Cantidad
     */
    private function getInitial(Droga $substance)
    {
        return $this->substances[$substance->getId()]['report']['initial'];
    }

    /**
     * @param Droga $substance
     * @return Cantidad
     */
    private function getFinal(Droga $substance)
    {
        return $this->substances[$substance->getId()]['report']['final'];
    }

    /**
     * @param Droga $substance
     * @param Motivo $motivo
     * @return Cantidad
     */
    private function getAmount(Droga $substance, Motivo $motivo)
    {
        return $this->substances[$substance->getId()]['report']['movements'][$motivo->getId()]['amount'];
    }

    /**
     * @param Droga $substance
     * @return boolean
     */
    private function exists(Droga $substance)
    {
        return key_exists($substance->getId(), $this->substances);
    }

}

