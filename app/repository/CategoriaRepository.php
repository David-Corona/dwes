<?php
namespace cursophp7dc\app\repository;

use cursophp7dc\app\entity\Categoria;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\core\database\QueryBuilder;

class CategoriaRepository extends QueryBuilder
{

    public function __construct(string $table='categorias', string $classEntity=Categoria::class)
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