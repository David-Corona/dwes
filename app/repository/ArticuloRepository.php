<?php

namespace cursophp7dc\app\repository;

use cursophp7dc\app\entity\Articulo;
use cursophp7dc\app\entity\Usuario;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\NotFoundException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\core\database\QueryBuilder;

class ArticuloRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     * @throws AppException
     */
    public function __construct(string $table='articulos', string $classEntity=Articulo::class)
    {
        parent::__construct($table, $classEntity);
    }

    /**
     * @param Articulo $articulo
     * @return Usuario
     * @throws NotFoundException
     * @throws QueryException
     */
    public function getUsuario(Articulo $articulo) : Usuario
    {
        $usuarioRepository = new UsuarioRepository();
        return $usuarioRepository->find($articulo->getUsuario());
    }

    /**
     * @param Articulo $articulo
     * @throws QueryException
     */
    public function guarda(Articulo $articulo)
    {
        $fnGuardaArticulo = function () use ($articulo)
        {
            $usuario = $this->getUsuario($articulo);
            $usuarioRepository = new UsuarioRepository();
            $usuarioRepository->nuevoArticulo($usuario);

            $this->save($articulo);
        };
        $this->executeTransaction($fnGuardaArticulo);
    }

}