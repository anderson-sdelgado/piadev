<?php

require('./dao/CaracOrganDAO.class.php');

$caracOrganDAO = new CaracOrganDAO();

//cria o array associativo
$dados = array("dados"=>$caracOrganDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
