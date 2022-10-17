<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../model/AmostraDAO.class.php');
require_once('../model/AuditorDAO.class.php');
require_once('../model/CaracOrganDAO.class.php');
require_once('../model/OSDAO.class.php');
require_once('../model/OrganDAO.class.php');
require_once('../model/RCaracAmostraDAO.class.php');
require_once('../model/ROrganCaracDAO.class.php');
require_once('../model/SecaoDAO.class.php');
require_once('../model/TalhaoDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    //put your code here
    
    public function dadosAmostra() {

        $amostraDAO = new AmostraDAO();

        $dados = array("dados" => $amostraDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
    
    public function dadosAuditor() {

        $auditorDAO = new AuditorDAO();

        $dados = array("dados" => $auditorDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
    
    public function dadosCaracOrgan() {

        $caracOrganDAO = new CaracOrganDAO();

        $dados = array("dados" => $caracOrganDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
                
    public function dadosOS() {

        $osDAO = new OSDAO();

        $dados = array("dados" => $osDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
    
    public function dadosOrgan() {

        $organDAO = new OrganDAO();

        $dados = array("dados" => $organDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
        
    public function dadosRCaracAmostra() {

        $rCaracAmostraDAO = new RCaracAmostraDAO();

        $dados = array("dados" => $rCaracAmostraDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
        
    public function dadosROrganCaracDAO() {

        $rOrganCaracDAO = new ROrganCaracDAO();

        $dados = array("dados" => $rOrganCaracDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
        
    public function dadosSecao() {

        $secaoDAO = new SecaoDAO();

        $dados = array("dados" => $secaoDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
        
    public function dadosTalhao() {

        $talhaoDAO = new TalhaoDAO();

        $dados = array("dados" => $talhaoDAO->dados());
        $retJson = json_encode($dados);

        return $retJson;

    }
        
}
