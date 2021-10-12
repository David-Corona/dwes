<?php

class ImagenProducto
{
    const RUTA_IMAGENES = 'images/shop/';
    /**
     * @var string
     */
    private $nombreImagen;
    /**
     * @var string
     */
    private $titulo;
    /**
     * @var string
     */
    private $subtitulo;
    /**
     * @var float
     */
    private $precio;


    /**
     * @param string $nombreImagen
     * @param string $titulo
     * @param string $subtitulo
     * @param float $precio
     */
    public function __construct(string $nombreImagen, string $titulo, string $subtitulo, float $precio)
    {
        $this->nombreImagen = $nombreImagen;
        $this->titulo = $titulo;
        $this->subtitulo = $subtitulo;
        $this->precio = $precio;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getTitulo();
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

    public function getUrlImagen() : string
    {
        return self::RUTA_IMAGENES . $this->getNombreImagen();
    }

}