<?php

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require_once('../control/InfestacaoCTR.class.php');

if (isset($info)):

    $infestacaoCTR = new InfestacaoCTR();
    echo 'GRAVOU-DADOS_' . $infestacaoCTR->salvarBoletim($info);
    
endif;
