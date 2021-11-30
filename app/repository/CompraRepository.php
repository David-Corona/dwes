<?php

namespace cursophp7dc\app\repository;

use cursophp7dc\app\entity\Compra;
use cursophp7dc\app\entity\Producto;
use cursophp7dc\app\entity\Usuario;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\NotFoundException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\core\database\QueryBuilder;

class CompraRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     * @throws AppException
     */
    public function __construct(string $table='compras', string $classEntity=Compra::class)
    {
        parent::__construct($table, $classEntity);
    }

    /**
     * @param Compra $compra
     * @return Producto
     * @throws NotFoundException
     * @throws QueryException
     */
    public function getProducto(Compra $compra) : Producto
    {
        $productoRepository = new ProductoRepository();
        return $productoRepository->find($compra->getIdProducto());
    }

    /**
     * @param Compra $compra
     * @return Usuario
     * @throws NotFoundException
     * @throws QueryException
     */
    public function getUsuario(Compra $compra) : Usuario
    {
        $usuarioRepository = new UsuarioRepository();
        return $usuarioRepository->find($compra->getIdUsuario());
    }


}