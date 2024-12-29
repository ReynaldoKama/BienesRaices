<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'root', 'bd_bienesraices');

    if(!$db) {
        echo "No se pudo conectar";
        exit;
    }

    return $db;
}