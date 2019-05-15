<?php

require('./dao/ApontaAnaliseDAO.class.php');

$apontaAnaliseDAO = new ApontaAnaliseDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //$dados = '{"cabec":[{"auditorCabec":33694,"dtCabec":"04/01/2015 22:52","idCabec":1,"idCaracOrgCabec":1,"idOrgCabec":19,"secaoCabec":1100,"statusAmostra":2,"talhaoCabec":12502,"ultPonto":1}]}_{"item":[{"idAmostraRespItem":14,"idCabecRespItem":1,"idRespItem":1,"pontoRespItem":1,"valorRespItem":1},{"idAmostraRespItem":15,"idCabecRespItem":1,"idRespItem":2,"pontoRespItem":1,"valorRespItem":1},{"idAmostraRespItem":16,"idCabecRespItem":1,"idRespItem":3,"pontoRespItem":1,"valorRespItem":1},{"idAmostraRespItem":17,"idCabecRespItem":1,"idRespItem":4,"pontoRespItem":1,"valorRespItem":1}]}';
    
    $dados = $info['dado'];
    $posicao = strpos($dados, "_") + 1;
    $cabec = substr($dados, 0, ($posicao - 1));
    $item = substr($dados, $posicao);

    $jsonObjCabec = json_decode($cabec);
    $jsonObjItem = json_decode($item);
    $dadosCab = $jsonObjCabec->cabec;
    $dadosItem = $jsonObjItem->item;
    
    $apontaAnaliseDAO->salvarDados($dadosCab, $dadosItem);

endif;

echo 'GRAVOU-ANALISE';