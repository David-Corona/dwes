<?php
namespace cursophp7dc\app\repository;

use cursophp7dc\app\entity\Mensaje;
use cursophp7dc\core\database\QueryBuilder;

class MensajeRepository extends QueryBuilder
{
    public function __construct(string $table='mensajes', string $classEntity=Mensaje::class)
    {
        parent::__construct($table, $classEntity);
    }
}