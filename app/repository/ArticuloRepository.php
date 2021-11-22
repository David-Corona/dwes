<?php

namespace cursophp7dc\app\repository;

use cursophp7dc\app\entity\Articulo;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\core\database\QueryBuilder;

class ArticuloRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     * @throws AppException
     */
    public function __construct(string $table='articulos', string $classEntity=Articulo::class)
    {
        parent::__construct($table, $classEntity);
    }


    //getUsuario() y guarda() para incrementar artículos del usuario cada vez que cree un articulo

}