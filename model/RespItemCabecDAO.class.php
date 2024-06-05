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
    
    
    public function verifResp($idCabec, $resp) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " ITEM_CABEC_IMPORT_INFEST "
                    . " WHERE "
                        . " IMPFEST_ID = " . $idCabec
                        . " AND "
                        . " ITEMCABEC_ID = " . $resp->idItemCabec
                        . " AND "
                        . " OPCAO = " . $resp->flag;

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

        $sql = " INSERT INTO ITEM_CABEC_IMPORT_INFEST ( "
                                    . " IMPFEST_ID "
                                    . " , ITEMCABEC_ID "
                                    . " , OPCAO "
                                    . " ) "
                                    . " VALUES ("
                                    . " " . $idCabec
                                    . " , " . $resp->idItemCabec
                                    . " , " . $resp->flag
                                    . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
        
    }
    
    
}
