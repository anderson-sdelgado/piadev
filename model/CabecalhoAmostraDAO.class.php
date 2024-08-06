<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of CabecalhoDAO
 *
 * @author anderson
 */
class CabecalhoAmostraDAO extends Conn {
    
    public function verifCabec($cabec) {

        $select = " SELECT "
                        . " COUNT(ID) AS QTDE "
                    . " FROM "
                        . " PIA_CABEC "
                    . " WHERE "
                        . " DTHR_CEL = TO_DATE('" . $cabec->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " ORGDANINHO_ID = " . $cabec->idOrgan
                        . " AND "
                        . " FUNC_ID = " . $cabec->idFunc
                        . " AND "
                        . " CEL_ID = " . $cabec->idCabec;

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

    public function idCabec($cabec) {

        $select = " SELECT "
                        . " ID "
                    . " FROM "
                        . " PIA_CABEC "
                    . " WHERE "
                        . " DTHR_CEL = TO_DATE('" . $cabec->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " ORGDANINHO_ID = " . $cabec->idOrgan
                        . " AND "
                        . " FUNC_ID = " . $cabec->idFunc
                        . " AND "
                        . " CEL_ID = " . $cabec->idCabec;
        
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

    public function insCabec($cabec) {

        $sql = "INSERT INTO PIA_CABEC ("
                        . " FUNC_ID "
                        . " , ORGDANINHO_ID "
                        . " , GRCARACORG_ID "
                        . " , AMOSORGAN_ID "
                        . " , DTHR "
                        . " , DTHR_CEL "
                        . " , DTHR_TRANS "
                        . " , STATUS "
                        . " , CEL_ID "
                        . " ) "
                        . " VALUES ("
                        . " " . $cabec->idFunc
                        . " , " . $cabec->idOrgan
                        . " , " . $cabec->idCaracOrgan
                        . " , " . $cabec->idAmostraOrgan
                        . " , TO_DATE('" . $cabec->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " , TO_DATE('" . $cabec->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " , SYSDATE "
                        . " , 2 "
                        . " , " . $cabec->idCabec
                        . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
        
    }
    
}
