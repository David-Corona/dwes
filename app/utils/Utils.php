<?php
namespace cursophp7dc\app\utils;

class Utils {
    public static function opcionMenuActiva(string $opcionMenu) : bool {
        if (strpos($_SERVER['REQUEST_URI'], $opcionMenu) !== false){
            return true;
        } else {
            return false;
        }
    }

    public static function opcionMenuActivaEnArray(array $opcionesMenu) : bool {
        foreach ($opcionesMenu as $opcionMenu) {
            if (self::opcionMenuActiva($opcionMenu) === true){
                return true;
            }
        }
        return false;
    }

}
