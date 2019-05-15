<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';

/**
 * Description of InsBolAbertoMMDAO
 *
 * @author anderson
 */
class InsBolAbertoDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dadosCab) {

        $this->Conn = parent::getConn();

        $cod = 1;
        
        foreach ($dadosCab as $c) {

            $sql = "INSERT INTO USINAS.IMPORT_INFEST ("
                    . " DT "
                    . " , FUNC_ID "
                    . " , PROPRAGR_ID "
                    . " , TALHAO_ID "
                    . " , ORGDANINHO_ID "
                    . " , GRCARACORG_ID "
                    . " , DT_HR_GERA "
                    . " , STATUS "
                    . " ) "
                    . " VALUES ("
                    . " TO_DATE('" . $c->dtCabec . "','DD/MM/YYYY HH24:MI') "
                    . " , " . $c->auditorCabec
                    . " , " . $c->secaoCabec
                    . " , " . $c->talhaoCabec
                    . " , " . $c->idOrgCabec
                    . " , " . $c->idCaracOrgCabec
                    . " , SYSDATE "
                    . " , 1 "
                    . " )";

            $this->Create = $this->Conn->prepare($sql);
            $this->Create->execute();

            $select = " SELECT "
                    . " IMPFEST_ID AS COD "
                    . " FROM "
                    . " USINAS.IMPORT_INFEST "
                    . " WHERE "
                    . " DT = TO_DATE('" . $c->dtCabec . "','DD/MM/YYYY HH24:MI') "
                    . " AND "
                    . " FUNC_ID = " . $c->auditorCabec . " ";

            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();

            foreach ($result as $item) {
                $cod = $item['COD'];
            }
            
        }

        return "CABEC+id=" . $cod . "_";
        
    }

}
