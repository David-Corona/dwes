<?php
require_once __DIR__ . '/../database/QueryBuilder.php';

class ProductoRepository extends QueryBuilder
{

    public function __construct(string $table='productos', string $classEntity='ImagenProducto')
    {
        parent::__construct($table, $classEntity);
    }
}