<?php

require('./dao/InsApontDAO.class.php');

$insApontDAO = new InsApontDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$retorno = '';

if (isset($info)):

    $dados = $info['dado'];
    
    $jsonObjAponta = json_decode($dados);
    $dadosAponta = $jsonObjAponta->aponta;

    $ret = $insApontDAO->salvarDados($dadosAponta);
    
    echo "APONTA=" . $ret . "_";
    
endif;


