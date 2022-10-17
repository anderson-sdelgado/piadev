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
     
    private $idCabecArray;
    private $idRespArray;
    
    public function salvarBoletim($info) {

        $dados = $info['dado'];
        $array = explode("_",$dados);

        $jsonObjCabec = json_decode($array[0]);
        $jsonObjResp = json_decode($array[1]);

        $dadosCabec = $jsonObjCabec->cabec;
        $dadosResp = $jsonObjResp->resp;

        return $this->salvarCabec($dadosCabec, $dadosResp);

    }
    
    private function salvarCabec($dadosCabec, $dadosResp) {
        $this->idCabecArray = array();
        $this->idRespArray = array();
        $cabecalhoAmostraDAO = new CabecalhoAmostraDAO();
        foreach ($dadosCabec as $cabec) {
            $v = $cabecalhoAmostraDAO->verifCabec($cabec);
            if ($v == 0) {
                $cabecalhoAmostraDAO->insCabec($cabec);
                $idCabecBD = $cabecalhoAmostraDAO->idCabec($cabec);
            } else {
                $idCabecBD = $cabecalhoAmostraDAO->idCabec($cabec);
            }
            $this->salvarResp($idCabecBD, $cabec->idCabec, $dadosResp);
            $this->idCabecArray[] = array("idCabec" => $cabec->idCabec);
        }
        
        $dadoCabec = array("cabec"=>$this->idCabecArray);
        $retCabec = json_encode($dadoCabec);
        
        $dadoResp = array("resp"=>$this->idRespArray);
        $retResp = json_encode($dadoResp);
        
        return $retCabec . "_" . $retResp;
        
    }

    private function salvarResp($idCabecBD, $idCabecCel, $dadosResp) {
        $this->idRespArray = array();
        $respItemAmostraDAO = new RespItemAmostraDAO();
        foreach ($dadosResp as $resp) {
            if ($idCabecCel == $resp->idCabec) {
                $v = $respItemAmostraDAO->verifResp($idCabecBD, $resp);
                if ($v == 0) {
                    $respItemAmostraDAO->insResp($idCabecBD, $resp);
                }
                $this->idRespArray[] = array("idRespItem" => $resp->idRespItem);
            }
        }
        
    }
    
    
}
