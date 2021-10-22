<?php
require_once __DIR__ . '/../database/QueryBuilder.php';

class ProductoRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     * @throws AppException
     */
    public function __construct(string $table='productos', string $classEntity='Producto')
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