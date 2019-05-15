<?php

require('./dao/SecaoDAO.class.php');

$secaoDAO = new SecaoDAO();

//cria o array associativo
$dados = array("dados"=>$secaoDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
