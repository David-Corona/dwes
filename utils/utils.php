<?php
function opcionMenuActiva(string $opcionMenu) : bool {
    if (strpos($_SERVER['REQUEST_URI'], $opcionMenu) !== false){
        return true;
    } else {
        return false;
    }
}

function opcionMenuActivaEnArray(array $opcionesMenu) : bool {
    foreach ($opcionesMenu as $opcionMenu) {
        if (opcionMenuActiva($opcionMenu) === true){
            return true;
        }
    }
    return false;
}