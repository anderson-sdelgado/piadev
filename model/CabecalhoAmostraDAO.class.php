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
    //put your code here
    
    public function verifCabec($cabec) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " USINAS.IMPORT_INFEST "
                    . " WHERE "
                        . " DT_CEL = TO_DATE('" . $cabec->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " FUNC_ID = " . $cabec->matricAuditor;

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
                        . " IMPFEST_ID AS COD "
                    . " FROM "
                        . " USINAS.IMPORT_INFEST "
                    . " WHERE "
                        . " DT_CEL = TO_DATE('" . $cabec->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " FUNC_ID = " . $cabec->matricAuditor;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['COD'];
        }

        return $id;
        
    }

    public function insCabec($cabec, $local) {

        $sql = "INSERT INTO USINAS.IMPORT_INFEST ("
                        . " DT "
                        . " , FUNC_ID "
                        . " , NRO_OS "
                        . " , PROPRAGR_ID "
                        . " , TALHAO_ID "
                        . " , ORGDANINHO_ID "
                        . " , GRCARACORG_ID "
                        . " , DT_HR_GERA "
                        . " , DT_CEL "
                        . " , STATUS "
                        . " ) "
                        . " VALUES ("
                        . " TO_DATE('" . $cabec->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " , " . $cabec->matricAuditor
                        . " , " . $local->nroOS
                        . " , " . $local->idSecao
                        . " , " . $local->idTalhao
                        . " , " . $cabec->idOrgan
                        . " , " . $cabec->idCaracOrgan
                        . " , SYSDATE "
                        . " , TO_DATE('" . $cabec->dthr . "','DD/MM/YYYY HH24:MI') "
                        . " , 2 "
                        . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
        
    }
    
}
