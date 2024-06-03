<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../model/AtualAplicDAO.class.php');
/**
 * Description of AtualAplicCTR
 *
 * @author anderson
 */
class AtualAplicCTR {
    
    public function inserirDados($info){
        
        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $nroAparelho = $d->nroAparelho;
            $versao = $d->versao;
        }
        
        return $this->inserirAtualVersao($nroAparelho, $versao);
        
    }
    
    public function inserirAtualVersao($nroAparelho, $versao) {
        $atualAplicDAO = new AtualAplicDAO();
        $v = $atualAplicDAO->verAtual($nroAparelho);
        if ($v == 0) {
            $atualAplicDAO->insAtual($nroAparelho, $versao);
        } else {
            $atualAplicDAO->updAtual($nroAparelho, $versao);
        }
        $dado = array("nroAparelho" => $nroAparelho);
        return json_encode(array("dados" =>array($dado)));
    }

    public function verifToken($info){
        
        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $token = $d->token;
        }
        
        $atualAplicDAO = new AtualAplicDAO();
        $v = $atualAplicDAO->verToken($token);
        
        if ($v > 0) {
            return true;
        } else {
            return false;
        }
        
    }
    
    public function verToken($token){

        $token = trim(substr($token, 6));
        $atualAplicDAO = new AtualAplicDAO();
        $v = $atualAplicDAO->verToken($token);
        
        if ($v > 0) {
            return true;
        } else {
            return false;
        }
        
    }
}
