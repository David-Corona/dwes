<?php
namespace cursophp7dc\app\entity;

use cursophp7dc\core\database\IEntity;
use DateTime;

class Mensaje implements IEntity
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
     * @var string
     */
    private $apellidos;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $asunto;
    /**
     * @var string
     */
    private $texto;
    /**
     * @var datetime
     */
    private $fecha;

    /**
     * @param string $nombre
     * @param string $apellidos
     * @param string $email
     * @param string $asunto
     * @param string $texto
     */
    public function __construct(string $nombre='', string $apellidos='', string $asunto='', string $email='', string $texto='')
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->asunto = $asunto;
        $this->texto = $texto;
        $this->fecha = null;
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
     * @return Mensaje
     */
    public function setNombre(string $nombre): Mensaje
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
     * @return Mensaje
     */
    public function setApellidos(string $apellidos): Mensaje
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Mensaje
     */
    public function setEmail(string $email): Mensaje
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getAsunto(): string
    {
        return $this->asunto;
    }

    /**
     * @param string $asunto
     * @return Mensaje
     */
    public function setAsunto(string $asunto): Mensaje
    {
        $this->asunto = $asunto;
        return $this;
    }

    /**
     * @return string
     */
    public function getTexto(): string
    {
        return $this->texto;
    }

    /**
     * @param string $texto
     * @return Mensaje
     */
    public function setTexto(string $texto): Mensaje
    {
        $this->texto = $texto;
        return $this;
    }

    /**
     * @return datetime
     */
    public function getFecha(): ?datetime
    {
        return $this->fecha;
    }

    /**
     * @param datetime $fecha
     * @return Mensaje
     */
    public function setFecha(?datetime $fecha): Mensaje
    {
        $this->fecha = $fecha;
        return $this;
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' =>  $this->id,
            'nombre' =>  $this->nombre,
            'apellidos' =>  $this->apellidos,
            'asunto' =>  $this->asunto,
            'email' =>  $this->email,
            'texto' =>  $this->texto
        ];
    }
}