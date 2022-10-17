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
    
    public function verifResp($idCabec, $resp) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " USINAS.ITEM_IMPORT_INFEST "
                    . " WHERE "
                        . " IMPFEST_ID = " . $idCabec
                        . " AND "
                        . " NRO_PONTO = " . $resp->pontoRespItem
                        . " AND "
                        . " ITAMOSORGA_ID = " . $resp->idAmostraRespItem;

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

    public function insResp($idCabec, $resp) {

        $sql = " INSERT INTO USINAS.ITEM_IMPORT_INFEST ( "
                                    . " IMPFEST_ID "
                                    . " , NRO_PONTO "
                                    . " , ITAMOSORGA_ID "
                                    . " , VL "
                                    . " ) "
                                    . " VALUES ("
                                    . " " . $idCabec
                                    . " , " . $resp->pontoRespItem
                                    . " , " . $resp->idAmostraRespItem
                                    . " , " . $resp->valorRespItem
                                    . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
        
    }
    
}
