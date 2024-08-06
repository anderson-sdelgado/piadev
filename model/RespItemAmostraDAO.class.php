<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of RespItemAmostraDAO
 *
 * @author anderson
 */
class RespItemAmostraDAO extends Conn {
    //put your code here
    
    public function verifResp($resp, $idLocalBD) {

        $select = " SELECT "
                        . " COUNT(ID) AS QTDE "
                    . " FROM "
                        . " PIA_RESP_ITEM_AMOSTRA "
                    . " WHERE "
                        . " LOCAL_ID = " . $idLocalBD
                        . " AND "
                        . " NRO_PONTO = " . $resp->ponto
                        . " AND "
                        . " ITAMOSORGA_ID = " . $resp->idAmostra
                        . " AND "
                        . " CEL_ID = " . $resp->idRespItemAmostra;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function insResp($resp, $idLocalBD) {

        $sql = " INSERT INTO PIA_RESP_ITEM_AMOSTRA ( "
                                    . " LOCAL_ID "
                                    . " , NRO_PONTO "
                                    . " , ITAMOSORGA_ID "
                                    . " , VL "
                                    . " , OBS "
                                    . " , CEL_ID "
                                    . " ) "
                                    . " VALUES ("
                                    . " " . $idLocalBD
                                    . " , " . $resp->ponto
                                    . " , " . $resp->idAmostra
                                    . " , " . $resp->valor
                                    . " , '" . $resp->obs . "'"
                                    . " , " . $resp->idRespItemAmostra
                                    . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
        
    }
    
}
