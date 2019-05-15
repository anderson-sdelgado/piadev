<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';

/**
 * Description of AltApontDAO
 *
 * @author anderson
 */
class EditApontDAO extends Conn {
    //put your code here

    /** @var PDO */
    private $Conn;

    public function salvarDados($dadosCab, $dadosItem) {

        $this->Conn = parent::getConn();

        $retorno = array();

        foreach ($dadosCab as $c) {

            foreach ($dadosItem as $i) {

                if ($i->tipoAltExc == 1) {

                    $sql = " UPDATE USINAS.ITEM_IMPORT_INFEST SET "
                            . " VL = " . $i->valorRespItem
                            . " WHERE "
                            . " IMPFEST_ID = " . $c->idExtBoletim
                            . " AND NRO_PONTO = " . $i->pontoRespItem
                            . " AND ITAMOSORGA_ID =  " . $i->idAmostraRespItem;

                    $this->Create = $this->Conn->prepare($sql);
                    $this->Create->execute();
                    
                } else if ($i->tipoAltExc == 2) {

                    $sql = " DELETE FROM USINAS.ITEM_IMPORT_INFEST "
                            . " WHERE "
                            . " IMPFEST_ID = " . $c->idExtBoletim
                            . " AND NRO_PONTO = " . $i->pontoRespItem
                            . " AND ITAMOSORGA_ID =  " . $i->idAmostraRespItem;

                    $this->Create = $this->Conn->prepare($sql);
                    $this->Create->execute();
                }
            }
        }
    }

}
