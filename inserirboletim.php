<?php

require('./dao/InserirBoletimDAO.class.php');
require('./dao/InserirDadosDAO.class.php');

$inserirBoletimDAO = new InserirBoletimDAO();
$inserirDadosDAO = new InserirDadosDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //$dados = '{"boletim":[{"auditorCabec":32131,"dtCabec":"28/06/2018 13:34","idCabec":1,"idCaracOrgCabec":1,"idExtBoletim":16,"idOrgCabec":19,"secaoCabec":4892,"statusAmostra":2,"talhaoCabec":19966,"ultPonto":1}]}_{"aponta":[{"idAmostraRespItem":17,"idCabecExtRespItem":16,"idCabecRespItem":1,"idRespItem":2,"pontoRespItem":1,"valorRespItem":11}]}';
    
    $dados = $info['dado'];
    $inserirDadosDAO->salvarDados($dados, "inserirboletim");
    $pos1 = strpos($dados, "_") + 1;
    $c = substr($dados, 0, ($pos1 - 1));
    $a = substr($dados, $pos1);
    
    $jsonObjBoletim = json_decode($c);
    $jsonObjAponta = json_decode($a);
    $dadosBoletim = $jsonObjBoletim->boletim;
    $dadosAponta = $jsonObjAponta->aponta;

    $inserirBoletimDAO->salvarDados($dadosBoletim, $dadosAponta);

endif;

echo 'GRAVOU-DADOS';