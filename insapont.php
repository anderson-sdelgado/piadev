<?php

require('./dao/InsApontDAO.class.php');

$insApontDAO = new InsApontDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$retorno = '';

if (isset($info)):

    $dados = $info['dado'];
    $pos1 = strpos($dados, "_") + 1;
    $c = substr($dados, 0, ($pos1 - 1));
    $a = substr($dados, $pos1);
    
    $jsonObjBoletim = json_decode($c);
    $jsonObjAponta = json_decode($a);
    $dadosBoletim = $jsonObjBoletim->boletim;
    $dadosAponta = $jsonObjAponta->aponta;

    $dados = array("dados"=>$insApontDAO->salvarDados($dadosBoletim, $dadosAponta));
    
    $json_str = json_encode($dados);
    
    echo "APONTA=" . $json_str . "_";
    
endif;


