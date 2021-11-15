<?php
namespace cursophp7dc\app\entity;

use cursophp7dc\core\database\IEntity;

class Categoria implements IEntity
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nombre;
    /**
     * @var int
     */
    private $numProductos;

    public function __construct(string $nombre='', int $numProductos=0)
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->numProductos = $numProductos;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Categoria
     */
    public function setNombre(string $nombre): Categoria
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumProductos(): int
    {
        return $this->numProductos;
    }

    /**
     * @param int $numProductos
     * @return Categoria
     */
    public function setNumProductos(int $numProductos): Categoria
    {
        $this->numProductos = $numProductos;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' =>  $this->getNombre(),
            'numProductos' => $this->getNumProductos()
        ];
    }
}