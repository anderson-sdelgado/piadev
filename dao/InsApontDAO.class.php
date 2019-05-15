<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';

/**
 * Description of InsApontamentoMMDAO
 *
 * @author anderson
 */
class InsApontDAO extends Conn {
    //put your code here

    /** @var PDO */
    private $Conn;

    public function salvarDados($dadosCab, $dadosItem) {

        $this->Conn = parent::getConn();

        $retorno = array();

        foreach ($dadosCab as $c) {

            foreach ($dadosItem as $i) {

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

                $cod = 1;

                $select = " SELECT "
                        . " ITIMPFEST_ID AS COD "
                        . " FROM "
                        . " USINAS.ITEM_IMPORT_INFEST "
                        . " WHERE "
                        . " IMPFEST_ID = " . $c->idExtBoletim
                        . " AND "
                        . " NRO_PONTO = " . $i->pontoRespItem
                        . " AND "
                        . " ITAMOSORGA_ID = " . $i->idAmostraRespItem . " ";

                $this->Read = $this->Conn->prepare($select);
                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                $this->Read->execute();
                $result = $this->Read->fetchAll();

                foreach ($result as $item) {
                    $cod = $item['COD'];
                }

                array_push($retorno, array("idRespItem" => $i->idRespItem, "idExtRespItem" => $cod, "idCabecRespItem" => $c->idCabec));
            }
        }

        return $retorno;
    }

}
