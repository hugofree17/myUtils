<?php

set_time_limit(0);
ini_set('display_errors', true);
error_reporting(E_ALL);

## START SCRIPT ##

$dataInicioScript = date('Y-m-d H:i:s');
echo 'In�cio Script: ' . $dataInicioScript . '<br/><br/>';

# Encodings
$possible_encodings = 'UTF-8, ISO-8859-1, ISO-8859-15, ASCII'; #Encoding poss�vel dos ficheiros originais
$encoding_final = 'ISO-8859-15'; #Encoding pretendido

# Caminho dos ficheiros
$caminhos = array('teste.php'); #Ficheiro que pretendem converter

foreach ($caminhos as $file) {
    if(file_exists($file)){
        # Get Encoding
        $contents = file_get_contents($file);
        $encoding_inicial = mb_detect_encoding($contents, $possible_encodings);

        # Converte encoding
        $final = mb_convert_encoding($contents, $encoding_final, $possible_encodings);
        
        echo 'Ficheiro: ' . $file . '<br/>';
        
        if($encoding_final != $encoding_inicial){
            # Create backup file
            file_put_contents($file.'_bkp', $contents);
            
            # Replace do conteudo
            file_put_contents($file, $final);
          
            echo 'Encoding original:' . $encoding_inicial . '<br/>'
                . 'Encoding final:' . mb_detect_encoding($final, $encoding_final) . '<br/>'; 
        } else{
          echo 'Ficheiro j� est� no encoding pretendido.<br/>';
        }
    } else{
        echo $file . ' n�o encontrado.<br/>';
    }
    echo '<br/>';
}

$dataFimScript = date("Y-m-d H:i:s");
echo 'Fim Script: ' . $dataFimScript . '<br/>';

## END SCRIPT ##