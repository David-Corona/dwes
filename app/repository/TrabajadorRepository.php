<?php

namespace cursophp7dc\app\repository;

use cursophp7dc\app\entity\Trabajador;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\core\database\QueryBuilder;

class TrabajadorRepository extends QueryBuilder
{

    /**
     * @param string $table
     * @param string $classEntity
     * @throws AppException
     */
    public function __construct(string $table='trabajadores', string $classEntity=Trabajador::class)
    {
        parent::__construct($table, $classEntity);
    }

}