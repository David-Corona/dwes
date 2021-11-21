<?php
namespace cursophp7dc\app\repository;

use cursophp7dc\app\entity\Categoria;
use cursophp7dc\app\entity\Producto;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\NotFoundException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\core\database\QueryBuilder;

class ProductoRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     * @throws AppException
     */
    public function __construct(string $table='productos', string $classEntity=Producto::class)
    {
        parent::__construct($table, $classEntity);
    }

    /**
     * @param Producto $producto
     * @return Categoria
     * @throws NotFoundException
     * @throws QueryException
     */
    public function getCategoria(Producto $producto) : Categoria
    {
        $categoriaRepository = new CategoriaRepository();
        return $categoriaRepository->find($producto->getCategoria());
    }

    //incrementar número de producto en categoría y guardar producto
    /**
     * @param Producto $producto
     * @throws QueryException
     */
    public function guarda(Producto $producto)
    {
        $fnGuardaProducto = function () use ($producto)
        {
            $categoria = $this->getCategoria($producto);
            $categoriaRepository = new CategoriaRepository();
            $categoriaRepository->nuevoProducto($categoria);

            $this->save($producto);
        };
        $this->executeTransaction($fnGuardaProducto);
    }

}