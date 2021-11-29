<?php

namespace cursophp7dc\app\repository;

use cursophp7dc\app\entity\Usuario;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\core\database\QueryBuilder;

class UsuarioRepository extends QueryBuilder
{
    public function __construct(string $table='usuarios', string $classEntity=Usuario::class)
    {
        parent::__construct($table, $classEntity);
    }

    /**
     * @param Usuario $usuario
     * @throws QueryException
     */
    public function nuevoArticulo(Usuario $usuario)
    {
        $usuario->setNumArticulos($usuario->getNumArticulos()+1);
        $this->update($usuario);
    }

}