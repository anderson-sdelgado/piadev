<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of LocalAmostraDAO
 *
 * @author anderson
 */
class LocalAmostraDAO extends Conn {
    
    public function verifLocal($local, $idCabecBD) {

        $select = " SELECT "
                        . " COUNT(ID) AS QTDE "
                    . " FROM "
                        . " PIA_LOCAL "
                    . " WHERE "
                        . " DTHR_CEL = TO_DATE('" . $local->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " PROPRAGR_ID = " . $local->idSecao
                        . " AND "
                        . " TALHAO_ID = " . $local->idTalhao
                        . " AND "
                        . " CABEC_ID = " . $idCabecBD
                        . " AND "
                        . " CEL_ID = " . $local->idLocal;

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

    public function idLocal($local, $idCabecBD) {

        $select = " SELECT "
                        . " ID "
                    . " FROM "
                        . " PIA_LOCAL "
                    . " WHERE "
                        . " DTHR_CEL = TO_DATE('" . $local->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " PROPRAGR_ID = " . $local->idSecao
                        . " AND "
                        . " TALHAO_ID = " . $local->idTalhao
                        . " AND "
                        . " CABEC_ID = " . $idCabecBD
                        . " AND "
                        . " CEL_ID = " . $local->idLocal;
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
        
    }

    public function insLocal($local, $idCabecBD) {

        $sql = "INSERT INTO PIA_LOCAL ("
                        . " CABEC_ID "
                        . " , NRO_OS "
                        . " , PROPRAGR_ID "
                        . " , TALHAO_ID "
                        . " , LATITUDE "
                        . " , LONGITUDE "
                        . " , OBS "
                        . " , DTHR "
                        . " , DTHR_CEL "
                        . " , CEL_ID "
                        . " ) "
                        . " VALUES ("
                        . " " . $idCabecBD
                        . " , " . $local->nroOS
                        . " , " . $local->idSecao
                        . " , " . $local->idTalhao
                        . " , " . $local->latitude
                        . " , " . $local->longitude
                        . " , '" . $local->obs . "'"
                        . " , TO_DATE('" . $local->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " , TO_DATE('" . $local->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " , " . $local->idLocal
                        . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
        
    }
    
}
