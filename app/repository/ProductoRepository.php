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
     * @param Producto $imagenProducto
     * @return Categoria
     * @throws NotFoundException
     * @throws QueryException
     */
    public function getCategoria(Producto $imagenProducto) : Categoria
    {
        $categoriaRepository = new CategoriaRepository();
        return $categoriaRepository->find($imagenProducto->getCategoria());
    }

    //incrementar número de producto en categoría y guardar producto
    /**
     * @param Producto $imagenProducto
     * @throws QueryException
     */
    public function guarda(Producto $imagenProducto)
    {
        $fnGuardaProducto = function () use ($imagenProducto)
        {
            $categoria = $this->getCategoria($imagenProducto);
            $categoriaRepository = new CategoriaRepository();
            $categoriaRepository->nuevoProducto($categoria);

            $this->save($imagenProducto);
        };
        $this->executeTransaction($fnGuardaProducto);
    }

}