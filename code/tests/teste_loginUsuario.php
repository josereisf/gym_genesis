<?php

require_once __DIR__ . '/../funcao.php';;

$email = 'acabate@gmail.com';
$senha = '$2y$10$G5VlwS/rmR57/w37BN93GuSUjJqABSOGALBB7/c2Mtx/u2lSMq0U6';

if (!is_null($resul = loginUsuario($email, $senha))) {
    echo $resul;
}
