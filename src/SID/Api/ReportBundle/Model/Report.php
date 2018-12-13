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


    public function __construct($substances, $from, $to)
    {
        $this->substances = array();
        $this->initializeSubstances($substances);
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

    private function initializeSubstances($substances)
    {
        foreach ($substances as $substance) {
            $this->substances[$substance->getId()] = array(
              'substance' => $substance,
              'report' => new SubstanceEntry($substance)
            );
        }
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

    private function updateMovement(Movimiento $movimiento)
    {
        $report = $this->getReport($movimiento->getDroga());
        if ($movimiento->getDesde() < $this->from) {
            $report->init($movimiento);
        } else {
            $report->add($movimiento);
        }

        $report->process($movimiento);
    }

    /**
     * @param Droga $substance
     * @return SubstanceEntry
     */
    private function getReport(Droga $substance){
        return $this->substances[$substance->getId()]['report'];
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

