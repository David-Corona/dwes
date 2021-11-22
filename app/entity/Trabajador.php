<?php
namespace cursophp7dc\app\entity;

use cursophp7dc\core\database\IEntity;

class Trabajador implements IEntity
{
    const RUTA_FOTOS_TRABAJADORES = 'images/trabajadores/';

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nombre;
    /**
     * @var string
     */
    private $apellidos;
    /**
     * @var string
     */
    private $foto;


    /**
     * @param string $nombre
     * @param string $apellidos
     * @param string $foto
     */
    public function __construct(string $nombre='', string $apellidos='', string $foto='')
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->foto = $foto;
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
     * @return Trabajador
     */
    public function setNombre(string $nombre): Trabajador
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     * @return Trabajador
     */
    public function setApellidos(string $apellidos): Trabajador
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    /**
     * @return string
     */
    public function getFoto(): string
    {
        return $this->foto;
    }

    /**
     * @param string $foto
     * @return Trabajador
     */
    public function setFoto(string $foto): Trabajador
    {
        $this->foto = $foto;
        return $this;
    }

    public function getUrlFoto() : string
    {
        return self::RUTA_FOTOS_TRABAJADORES . $this->getFoto();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'apellidos' => $this->getApellidos(),
            'foto' => $this->getFoto()
        ];
    }
}