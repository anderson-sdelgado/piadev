<?php

require('./dao/TalhaoDAO.class.php');

$talhaoDAO = new TalhaoDAO();

//cria o array associativo
$dados = array("dados"=>$talhaoDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
