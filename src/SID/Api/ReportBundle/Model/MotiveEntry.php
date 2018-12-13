<?php
/**
 * Created by PhpStorm.
 * User: qwertysoft
 * Date: 2018-12-13
 * Time: 10:04
 */

namespace SID\Api\ReportBundle\Model;


use SID\Api\MovementBundle\Entity\Motivo;
use SID\Api\MovementBundle\Entity\Movimiento;
use SID\Api\SubstanceBundle\Entity\Droga;
use SID\Api\SubstanceBundle\Model\Cantidad;

class MotiveEntry{

    /**
     * @var array
     **/
    private $entries = array();

    public function add(Movimiento $movimiento){
        $motivo = $movimiento->getMotivo();
        if(!$this->has($motivo)){
            $this->init($motivo, $movimiento->getDroga());
        }
        $this->update($movimiento);
        $this->getVouchers($motivo)->add($movimiento->getComprobante());
    }

    /**
     * @return array {
     *      @type Motivo $motivo
     *      @type Cantidad $amount
     *      @type VoucherEntry $voucher
     * }
     */
    public function getEntries()
    {
        return $this->entries;
    }

    public function count(){
        return array_sum(array_map(function ($entry){
            return $entry['vouchers']->count();
        }, $this->getEntries())) ?: 1;
    }

    private function init(Motivo $motivo, Droga $substance){
        $this->entries[$motivo->getId()] = array(
            'motive' => $motivo,
            'amount' => $this->initUnit($substance),
            'vouchers' => new VoucherEntry()
        );
    }

    private function has(Motivo $motivo){
        return isset($this->entries[$motivo->getId()]);
    }

    private function update(Movimiento $movimiento){
        $this->getAmount($movimiento->getMotivo())->add($this->getCantidad($movimiento));
    }

    /**
     * @param Motivo $motivo
     * @return VoucherEntry
     */
    private function getVouchers(Motivo $motivo){
        return $this->entries[$motivo->getId()]['vouchers'];
    }

    /**
     * @param Motivo $motivo
     * @return Cantidad
     */
    private function getAmount(Motivo $motivo)
    {
        return $this->entries[$motivo->getId()]['amount'];
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