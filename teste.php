<?php

$linguagens = array();


array_push($linguagens, array("idInterno" => 21, "idExterno" => 20));
array_push($linguagens, array("idInterno" => 50, "idExterno" => 30));
//cria o array associativo
$dados = array("dados"=>$linguagens);

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
