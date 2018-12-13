<?php
/**
 * Created by PhpStorm.
 * User: qwertysoft
 * Date: 2018-12-13
 * Time: 10:05
 */

namespace SID\Api\ReportBundle\Model;


use SID\Api\ProviderBundle\Entity\Comprobante;

class VoucherEntry {
    /**
     * @var array
     **/
    private $entries = array();

    public function add($voucher){
        if($voucher)
            $this->entries[$voucher->getId()] = $voucher;
    }

    public function count(){
        return count($this->entries) ?: 1;
    }

    /**
     * @return array
     */
    public function getEntries(){
        return $this->entries;
    }

}