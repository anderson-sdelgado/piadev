<?php

require('./dao/RCaracAmostraDAO.class.php');

$rCaracAmostraDAO = new RCaracAmostraDAO();

//cria o array associativo
$dados = array("dados"=>$rCaracAmostraDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;