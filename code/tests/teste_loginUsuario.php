<?php
$hash = '$2y$10$1/kRRFXN22l1o00xG2XXXesutjiHX/gmAvDqTzeKgqwOGxBRc58qG';

if (password_hash('123456', PASSWORD_DEFAULT)) {
    echo 'Senha correta!';
} else {
    echo 'Senha incorreta!';
}
