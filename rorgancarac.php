<?php

require('./dao/ROrganCaracDAO.class.php');

$rOrganCaracDAO = new ROrganCaracDAO();

//cria o array associativo
$dados = array("dados"=>$rOrganCaracDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
