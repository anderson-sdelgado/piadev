<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';

/**
 * Description of InsBolFechadoMMDAO
 *
 * @author anderson
 */
class InsBolFechadoDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dadosBoletim, $dadosAponta) {

        $this->Conn = parent::getConn();

        foreach ($dadosBoletim as $c) {

            $select = " SELECT "
                    . " COUNT(*) AS QTDE "
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
                $v = $item['QTDE'];
            }

            if ($v == 0) {

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
                        . " , 2 "
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
                    $idBoletim = $item['ID'];
                }

                foreach ($dadosAponta as $i) {

                    if ($bol->idBoletim == $apont->idBolAponta) {

                        $sql = " INSERT INTO USINAS.ITEM_IMPORT_INFEST ( "
                                . " IMPFEST_ID "
                                . " , NRO_PONTO "
                                . " , ITAMOSORGA_ID "
                                . " , VL "
                                . " ) "
                                . " VALUES ("
                                . " " . $c->idExtBoletim
                                . " , " . $i->pontoRespItem
                                . " , " . $i->idAmostraRespItem
                                . " , " . $i->valorRespItem
                                . " )";

                        $this->Create = $this->Conn->prepare($sql);
                        $this->Create->execute();
                        
                    }
                    
                }
                
            } else {

                $sql = "UPDATE USINAS.IMPORT_INFEST "
                        . " SET "
                        . "  STATUS = 2 "
                        . " WHERE "
                        . " IMPFEST_ID = " . $c->idExtBoletim;

                $this->Create = $this->Conn->prepare($sql);
                $this->Create->execute();

                foreach ($dadosAponta as $i) {

                    if ($c->idCabec == $i->idCabecRespItem) {

                        $sql = " INSERT INTO USINAS.ITEM_IMPORT_INFEST ( "
                                . " IMPFEST_ID "
                                . " , NRO_PONTO "
                                . " , ITAMOSORGA_ID "
                                . " , VL "
                                . " ) "
                                . " VALUES ("
                                . " " . $c->idExtBoletim
                                . " , " . $i->pontoRespItem
                                . " , " . $i->idAmostraRespItem
                                . " , " . $i->valorRespItem
                                . " )";

                        $this->Create = $this->Conn->prepare($sql);
                        $this->Create->execute();
                    }
                }
            }
        }
    }

}
