<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of RespItemCabecDAO
 *
 * @author anderson
 */
class RespItemCabecDAO extends Conn {
    
    public function verifResp($resp, $idCabec) {

        $select = " SELECT "
                        . " COUNT(ID) AS QTDE "
                    . " FROM "
                        . " PIA_RESP_ITEM_CABEC "
                    . " WHERE "
                        . " CABEC_ID = " . $idCabec
                        . " AND "
                        . " ITEM_ID = " . $resp->idItemCabec
                        . " AND "
                        . " CEL_ID = " . $resp->idRespItemCabec;

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

    public function insResp($resp, $idCabec) {

        $sql = " INSERT INTO PIA_RESP_ITEM_CABEC ( "
                                    . " CABEC_ID "
                                    . " , ITEM_ID "
                                    . " , FLAG "
                                    . " , CEL_ID "
                                    . " ) "
                                    . " VALUES ("
                                    . " " . $idCabec
                                    . " , " . $resp->idItemCabec
                                    . " , " . $resp->flag
                                    . " , " . $resp->idRespItemCabec
                                    . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
        
    }
    
    
}
