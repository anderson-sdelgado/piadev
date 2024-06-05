<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../model/CabecalhoAmostraDAO.class.php');
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
        $cabecalhoAmostraDAO = new CabecalhoAmostraDAO();
        $respItemAmostraDAO = new RespItemAmostraDAO();
        $respItemCabecDAO = new RespItemCabecDAO();
        
        $localAmostraList = $cabec->localAmostraList;
        $respItemAmostraList = $cabec->respItemAmostraList;
        $respItemCabecList = $cabec->respItemCabecList;
        
        if($cabec->idAmostraOrgan == 51){
            foreach ($localAmostraList as $local) {
                $v = $cabecalhoAmostraDAO->verifCabec($cabec, $local->idLocal);
                if ($v == 0) {
                    $cabecalhoAmostraDAO->insCabec($cabec, $local);
                    $idCabecBD = $cabecalhoAmostraDAO->idCabec($cabec, $local->idLocal);
                } else {
                    $idCabecBD = $cabecalhoAmostraDAO->idCabec($cabec, $local->idLocal);
                }
                foreach ($respItemAmostraList as $respItemAmostra) {
                    if($local->idLocal == $respItemAmostra->idLocal){
                        $v = $respItemAmostraDAO->verifResp($idCabecBD, $respItemAmostra);
                        if ($v == 0) {
                            $respItemAmostraDAO->insResp($idCabecBD, $respItemAmostra);
                        }
                    }
                }
            }
        } else {
            $local = $localAmostraList[0];
            $v = $cabecalhoAmostraDAO->verifCabec($cabec, $cabec->idCabec);
            if ($v == 0) {
                $cabecalhoAmostraDAO->insCabec($cabec, $local);
                $idCabecBD = $cabecalhoAmostraDAO->idCabec($cabec, $cabec->idCabec);
            } else {
                $idCabecBD = $cabecalhoAmostraDAO->idCabec($cabec, $cabec->idCabec);
            }
            foreach ($respItemCabecList as $respItemCabec) {
                $v = $respItemCabecDAO->verifResp($idCabecBD, $respItemCabec);
                if ($v == 0) {
                    $respItemCabecDAO->insResp($idCabecBD, $respItemCabec);
                }
            }
            foreach ($respItemAmostraList as $respItemAmostra) {
                $v = $respItemAmostraDAO->verifResp($idCabecBD, $respItemAmostra);
                if ($v == 0) {
                    $respItemAmostraDAO->insResp($idCabecBD, $respItemAmostra);
                }
            }
        }
    }
    
}
