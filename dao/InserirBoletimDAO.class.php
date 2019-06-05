<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
require_once 'AjusteDataHoraDAO.class.php';
/**
 * Description of InserirBoletimDAO
 *
 * @author anderson
 */
class InserirBoletimDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dadosBoletim, $dadosAponta) {

        $this->Conn = parent::getConn();
        
        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        foreach ($dadosBoletim as $c) {

            $select = " SELECT "
                    . " COUNT(*) AS QTDE "
                    . " FROM "
                    . " USINAS.IMPORT_INFEST "
                    . " WHERE "
                    . " DT_CEL = TO_DATE('" . $c->dtCabec . "','DD/MM/YYYY HH24:MI') "
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
                        . " , DT_CEL "
                        . " , STATUS "
                        . " ) "
                        . " VALUES ("
                        . " " . $ajusteDataHoraDAO->dataHoraGMT($c->dtCabec)
                        . " , " . $c->auditorCabec
                        . " , " . $c->secaoCabec
                        . " , " . $c->talhaoCabec
                        . " , " . $c->idOrgCabec
                        . " , " . $c->idCaracOrgCabec
                        . " , SYSDATE "
                        . " , TO_DATE('" . $c->dtCabec . "','DD/MM/YYYY HH24:MI') "
                        . " , 2 "
                        . " )";

                $this->Create = $this->Conn->prepare($sql);
                $this->Create->execute();

                $select = " SELECT "
                        . " IMPFEST_ID AS COD "
                        . " FROM "
                        . " USINAS.IMPORT_INFEST "
                        . " WHERE "
                        . " DT_CEL = TO_DATE('" . $c->dtCabec . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " FUNC_ID = " . $c->auditorCabec . " ";

                $this->Read = $this->Conn->prepare($select);
                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                $this->Read->execute();
                $result = $this->Read->fetchAll();

                foreach ($result as $item) {
                    $id = $item['COD'];
                }

                foreach ($dadosAponta as $i) {

                    if ($c->idCabec == $i->idCabecRespItem) {

                        $select = " SELECT "
                                . " COUNT(*) AS QTDE "
                                . " FROM "
                                . " USINAS.ITEM_IMPORT_INFEST "
                                . " WHERE "
                                . " IMPFEST_ID = " . $id
                                . " AND "
                                . " NRO_PONTO = " . $i->pontoRespItem
                                . " AND "
                                . " ITAMOSORGA_ID = " . $i->idAmostraRespItem . " ";

                        $this->Read = $this->Conn->prepare($select);
                        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                        $this->Read->execute();
                        $result = $this->Read->fetchAll();

                        foreach ($result as $item) {
                            $v = $item['QTDE'];
                        }

                        if ($v == 0) {

                            $sql = " INSERT INTO USINAS.ITEM_IMPORT_INFEST ( "
                                    . " IMPFEST_ID "
                                    . " , NRO_PONTO "
                                    . " , ITAMOSORGA_ID "
                                    . " , VL "
                                    . " ) "
                                    . " VALUES ("
                                    . " " . $id
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
            else{
                
                $select = " SELECT "
                        . " IMPFEST_ID AS COD "
                        . " FROM "
                        . " USINAS.IMPORT_INFEST "
                        . " WHERE "
                        . " DT_CEL = TO_DATE('" . $c->dtCabec . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " FUNC_ID = " . $c->auditorCabec . " ";

                $this->Read = $this->Conn->prepare($select);
                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                $this->Read->execute();
                $result = $this->Read->fetchAll();

                foreach ($result as $item) {
                    $id = $item['COD'];
                }

                foreach ($dadosAponta as $i) {

                    if ($c->idCabec == $i->idCabecRespItem) {

                        $select = " SELECT "
                                . " COUNT(*) AS QTDE "
                                . " FROM "
                                . " USINAS.ITEM_IMPORT_INFEST "
                                . " WHERE "
                                . " IMPFEST_ID = " . $id
                                . " AND "
                                . " NRO_PONTO = " . $i->pontoRespItem
                                . " AND "
                                . " ITAMOSORGA_ID = " . $i->idAmostraRespItem . " ";

                        $this->Read = $this->Conn->prepare($select);
                        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                        $this->Read->execute();
                        $result = $this->Read->fetchAll();

                        foreach ($result as $item) {
                            $v = $item['QTDE'];
                        }

                        if ($v == 0) {

                            $sql = " INSERT INTO USINAS.ITEM_IMPORT_INFEST ( "
                                    . " IMPFEST_ID "
                                    . " , NRO_PONTO "
                                    . " , ITAMOSORGA_ID "
                                    . " , VL "
                                    . " ) "
                                    . " VALUES ("
                                    . " " . $id
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

}
