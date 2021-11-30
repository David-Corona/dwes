<?php

namespace cursophp7dc\app\entity;

use cursophp7dc\core\database\IEntity;
use DateTime;

class Compra implements IEntity
{
    /**
     * @var int
     */
    private $id_usuario;
    /**
     * @var int
     */
    private $id_producto;
    /**
     * @var string
     */
    private $fecha;

    /**
     * @param int $id_usuario
     * @param int $id_producto
     */
    public function __construct(int $id_usuario=0, int $id_producto=0)
    {
        $this->id_usuario = $id_usuario;
        $this->id_producto = $id_producto;
        $this->fecha = null;
    }

    /**
     * @return int
     */
    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    /**
     * @return int
     */
    public function getIdProducto(): int
    {
        return $this->id_producto;
    }

    /**
     * @return string
     */
    public function getFecha(): string
    {
        return $this->fecha;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id_usuario' =>  $this->id_usuario,
            'id_producto' =>  $this->id_producto
        ];
    }
}