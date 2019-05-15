<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
/**
 * Description of ROrganismoCaracDAO
 *
 * @author anderson
 */
class ROrganCaracDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " ORGDANAMOS_ID AS \"idROrganismoCarac\" "
                    . " , ORGDANINHO_ID AS \"idOrganismo\" "
                    . " , GRCARACORG_ID AS \"idCaracOrganismo\" "
                . " FROM "
                    . " USINAS.V_INFEST_CARAC ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
