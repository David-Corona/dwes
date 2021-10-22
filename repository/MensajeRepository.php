<?php
require_once __DIR__ . '/../database/QueryBuilder.php';

class MensajeRepository extends QueryBuilder
{
    public function __construct(string $table='mensajes', string $classEntity='Mensaje')
    {
        parent::__construct($table, $classEntity);
    }
}