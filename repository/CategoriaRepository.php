<?php
require_once __DIR__ . '/../database/QueryBuilder.php';

class CategoriaRepository extends QueryBuilder
{

    public function __construct(string $table='categorias', string $classEntity='Categoria')
    {
        parent::__construct($table, $classEntity);
    }

    //incrementar el numero de productos en categoria

    /**
     * @param Categoria $categoria
     * @throws QueryException
     */
    public function nuevoProducto(Categoria $categoria)
    {
        $categoria->setNumProductos($categoria->getNumProductos()+1);
        $this->update($categoria);
    }
}