<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../model/CabecalhoAmostraDAO.class.php');
require_once('../model/RespItemAmostraDAO.class.php');
/**
 * Description of InfestacaoCTR
 *
 * @author anderson
 */
class InfestacaoCTR {
     
    public function salvarAmostra($body) {
        $idCabecArray = array();
        $cabecArray = json_decode($body);
        foreach($cabecArray as $cabec){
            $this->salvarCabecAmostra($cabec);
            $idCabecArray[] = array("idCabec" => $cabec->idCabec);
        }
        return json_encode($idCabecArray, JSON_NUMERIC_CHECK);
    }
    
    private function salvarCabecAmostra($cabec) {
        $cabecalhoAmostraDAO = new CabecalhoAmostraDAO();
        $respItemAmostraDAO = new RespItemAmostraDAO();
        
        $localAmostraList = $cabec->localAmostraList;
        $respItemAmostraList = $cabec->respItemAmostraList;
        
        if($cabec->idCaracOrgan !== 34){
            $local = $localAmostraList[0];
            $v = $cabecalhoAmostraDAO->verifCabec($cabec);
            if ($v == 0) {
                $cabecalhoAmostraDAO->insCabec($cabec, $local);
                $idCabecBD = $cabecalhoAmostraDAO->idCabec($cabec);
            } else {
                $idCabecBD = $cabecalhoAmostraDAO->idCabec($cabec);
            }
            foreach ($respItemAmostraList as $resp) {
                $v = $respItemAmostraDAO->verifResp($idCabecBD, $resp);
                if ($v == 0) {
                    $respItemAmostraDAO->insResp($idCabecBD, $resp);
                }
            }
        }
    }
    
}
