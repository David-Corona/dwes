<?php

namespace cursophp7dc\app\entity;

use cursophp7dc\core\database\IEntity;
use DateTime;

class Articulo implements IEntity
{

    const RUTA_FOTOS_ARTICULOS = 'images/articulos/';

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nombre;
    /**
     * @var float
     */
    private $precio;
    /**
     * @var string
     */
    private $fecha_caducidad;
    /**
     * @var string
     */
    private $imagen;
    /**
     * @var int
     */
    private $usuario;

    /**
     * @param string $nombre
     * @param float|int $precio
     * @param string $fecha_caducidad
     * @param string $imagen
     * @param int $usuario
     */
    public function __construct(string $nombre='', float $precio=0, string $fecha_caducidad='', string $imagen='', int $usuario=0)
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->fecha_caducidad = $fecha_caducidad;
        $this->imagen = $imagen;
        $this->usuario = $usuario;
    }

    /**
     * @return int
     */
    public function getId(): ?int
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
     * @return Articulo
     */
    public function setNombre(string $nombre): Articulo
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrecio(): float|int
    {
        return $this->precio;
    }

    /**
     * @param float $precio
     * @return Articulo
     */
    public function setPrecio(float|int $precio): Articulo
    {
        $this->precio = $precio;
        return $this;
    }

    /**
     * @return string
     */
    public function getFechaCaducidad(): string
    {
        return $this->fecha_caducidad;
    }

    /**
     * @param string $fecha_caducidad
     * @return Articulo
     */
    public function setFechaCaducidad(string $fecha_caducidad): Articulo
    {
        $this->fecha_caducidad = $fecha_caducidad;
        return $this;
    }

    /**
     * @return string
     */
    public function getImagen(): string
    {
        return $this->imagen;
    }

    /**
     * @param string $imagen
     * @return Articulo
     */
    public function setImagen(string $imagen): Articulo
    {
        $this->imagen = $imagen;
        return $this;
    }

    /**
     * @return int
     */
    public function getUsuario(): int
    {
        return $this->usuario;
    }

    /**
     * @param int $usuario
     * @return Articulo
     */
    public function setUsuario(int $usuario): Articulo
    {
        $this->usuario = $usuario;
        return $this;
    }


    /**
     * @return string
     */
    public function getUrlImagen() : string
    {
        return self::RUTA_FOTOS_ARTICULOS . $this->getImagen();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'precio' => $this->getPrecio(),
            'fecha_caducidad' => $this->getFechaCaducidad(),
            'imagen' => $this->getImagen(),
            'usuario' => $this->getUsuario()
        ];
    }
}