<?php

 header('Content-Type: application/json');

 

$json = json_encode(listarEnderecos($tipo), JSON_UNESCAPED_UNICODE);
echo $json;




if (!is_null($funcao)){
    echo "funcionou";
}
echo '<pre>';
print_r($listar);
echo '</pre';