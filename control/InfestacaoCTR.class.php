<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../model/CabecalhoAmostraDAO.class.php');
require_once('../model/LocalAmostraDAO.class.php');
require_once('../model/RespItemAmostraDAO.class.php');
require_once('../model/RespItemCabecDAO.class.php');
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
        
        $localAmostraList = $cabec->localAmostraList;
        $respItemCabecList = $cabec->respItemCabecList;
        
        $cabecalhoAmostraDAO = new CabecalhoAmostraDAO();
        
        $v = $cabecalhoAmostraDAO->verifCabec($cabec);
        if ($v == 0) {
            $cabecalhoAmostraDAO->insCabec($cabec);
            $idCabecBD = $cabecalhoAmostraDAO->idCabec($cabec);
            foreach ($localAmostraList as $local) {
                $this->salvarLocalAmostra($local, $idCabecBD);
            }
            foreach ($respItemCabecList as $respItemCabec) {
                $this->salvarRespCabec($respItemCabec, $idCabecBD);
            }
        }
        
    }
    
    private function salvarLocalAmostra($local, $idCabecBD) {
        
        $respItemAmostraList = $local->respItemAmostraList;
        
        $localAmostraDAO = new LocalAmostraDAO();
        $v = $localAmostraDAO->verifLocal($local, $idCabecBD);
        if ($v == 0) {
            $localAmostraDAO->insLocal($local, $idCabecBD);
            $idLocalBD = $localAmostraDAO->idLocal($local, $idCabecBD);
            foreach ($respItemAmostraList as $respItemAmostra) {
                $this->salvarRespItemAmostra($respItemAmostra, $idLocalBD);
            }
        }
    }
    
    private function salvarRespCabec($resp, $idCabecBD) {
        $respItemCabecDAO = new RespItemCabecDAO();
        $v = $respItemCabecDAO->verifResp($resp, $idCabecBD);
        if ($v == 0) {
            $respItemCabecDAO->insResp($resp, $idCabecBD);
        }
    }
    
    private function salvarRespItemAmostra($resp, $idLocalBD) {
        $respItemAmostraDAO = new RespItemAmostraDAO();
        $v = $respItemAmostraDAO->verifResp($resp, $idLocalBD);
        if ($v == 0) {
            $respItemAmostraDAO->insResp($resp, $idLocalBD);
        }
    }
}
