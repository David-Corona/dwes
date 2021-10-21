<?php
require_once __DIR__ . '/../database/IEntity.php';

class ImagenProducto implements IEntity
{
    const RUTA_IMAGENES_SHOP = 'images/shop/';
    const RUTA_IMAGENES_PRODUCTO = 'images/producto/';

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $titulo;
    /**
     * @var string
     */
    private $subtitulo;
    /**
     * @var string
     */
    private $descripcion;
    /**
     * @var float
     */
    private $precio;
    /**
     * @var string
     */
    private $nombreImagen;


    /**
     * @param string $titulo
     * @param string $subtitulo
     * @param string $descripcion
     * @param float|int $precio
     * @param string $nombreImagen.
     */
    public function __construct(string $titulo='', string $subtitulo='', string $descripcion='', float $precio=0, string $nombreImagen='default.png')
    {
        $this->id = null;
        $this->titulo = $titulo;
        $this->subtitulo = $subtitulo;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->nombreImagen = $nombreImagen;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getTitulo();
    }


    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ImagenProducto
     */
    public function setId(int $id): ImagenProducto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     * @return ImagenProducto
     */
    public function setTitulo(string $titulo): ImagenProducto
    {
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubtitulo(): string
    {
        return $this->subtitulo;
    }

    /**
     * @param string $subtitulo
     * @return ImagenProducto
     */
    public function setSubtitulo(string $subtitulo): ImagenProducto
    {
        $this->subtitulo = $subtitulo;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     * @return ImagenProducto
     */
    public function setDescripcion(string $descripcion): ImagenProducto
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrecio(): float
    {
        return $this->precio;
    }

    /**
     * @param float $precio
     * @return ImagenProducto
     */
    public function setPrecio(float $precio): ImagenProducto
    {
        $this->precio = $precio;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombreImagen(): string
    {
        return $this->nombreImagen;
    }

    /**
     * @param string $nombreImagen
     * @return ImagenProducto
     */
    public function setNombreImagen(string $nombreImagen): ImagenProducto
    {
        $this->nombreImagen = $nombreImagen;
        return $this;
    }


    public function getUrlImagen() : string
    {
        return self::RUTA_IMAGENES_SHOP . $this->getNombreImagen();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'titulo' => $this->getTitulo(),
            'subtitulo' => $this->getSubtitulo(),
            'descripcion' => $this->getDescripcion(),
            'precio' => $this->getPrecio(),
            'nombreImagen' => $this->getUrlImagen()
        ];
    }
}