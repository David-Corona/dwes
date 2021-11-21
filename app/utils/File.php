<?php
namespace cursophp7dc\app\utils;

use cursophp7dc\app\exceptions\FileException;

class File
{

    private $file;
    private $fileName;

    /**
     * @param string $fileName
     * @param array $arrTypes
     * @throws FileException
     */

    public function __construct(string $fileName, array $arrTypes) //los tipos de archivo que aceptan la clase
    {
        $this->file = $_FILES[$fileName];
        $this->fileName = '';

        //verifica que el fichero se ha cargado.
        if (!isset($this->file))
        {
            throw new FileException('Debes seleccionar un fichero.');
        }

        //verifica si ha habido algun error con la subida del fichero
        if ($this->file['error'] !== UPLOAD_ERR_OK)
        {
            switch ($this->file['error'])
            {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new FileException('El tamaño del fichero es demasiado grande.');
                case UPLOAD_ERR_PARTIAL: //no se ha podido finalizar la carga del archivo
                    throw new FileException('No se ha podido subir el fichero completo.');
                default:
                    throw new FileException('No se ha podido subir el fichero.');
            }

        }
        //comprobar si es de un tipo de fichero soportado
        if (in_array($this->file['type'], $arrTypes) === false) {
            throw new FileException('Tipo de fichero no soportado.');
        }
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    //moverá el fichero subido a la ruta de destino
    /**
     * @throws FileException
     */
    public function saveUploadFile(string $rutaDestino)
    {
        //se comprueba que el file se ha subido por el form para evitar ataque
        if (is_uploaded_file($this->file['tmp_name']) === false)
        {
            throw new FileException('Peligro, el archivo no se ha subido mediante formulario.');
        }
        //cargar el nombre original del fichero
        $this->fileName = $this->file['name'];
        $ruta = $rutaDestino . $this->fileName;

        //comprobar si existe un fichero en esa ruta
        if (is_file($ruta) === true)
        {
            $idUnico = time(); //se genera un nombre aleatorio para no sobreescribir
            $this->fileName = $idUnico . '_' . $this->fileName;
            $ruta = $rutaDestino . $this->fileName;
        }

        //mover el fichero del directorio temporal (donde se ha subido)
        if (move_uploaded_file($this->file['tmp_name'], $ruta) === false)
        {
            throw new FileException('No se puede mover el fichero a su destino.');
        }
    }

    /**
     * @param string $rutaOrigen
     * @param string $rutaDestino
     * @throws FileException
     */
    public function copyFile(string $rutaOrigen, string $rutaDestino)
    {
        $origen = $rutaOrigen . $this->fileName;
        $destino = $rutaDestino . $this->fileName;

        if (is_file($origen) === false)
        {
            throw new FileException("No existe el fichero $origen que estás intentando copiar");
        }

        if (is_file($destino) === true)
        {
            throw new FileException("El fichero $destino ya existe y no se puede sobrescribir");
        }

        if (copy($origen, $destino) === false)
        {
            throw new FileException("No se ha podido copiar el fichero $origen a $destino");
        }
    }

    /**
     * @param string $rutaOrigen
     * @param string $rutaDestino
     * @throws FileException
     */
    public function resizeFile(string $rutaOrigen, string $rutaDestino)
    {
        $origen = $rutaOrigen . $this->fileName;
        $destino = $rutaDestino . $this->fileName;

        //si no existe un fichero de origen, obviamente no se puede copiar
        if (is_file($origen) === false)
        {
            throw new FileException("No existe el fichero $origen que estás intentando copiar");
        }

        if (is_file($destino) === true)
        {
            throw new FileException("El fichero $destino ya existe y no se puede sobrescribir");
        }


        if (mime_content_type($origen) == 'image/png'){
            $img_original = imagecreatefrompng($origen);
        } elseif (mime_content_type($origen) == 'image/gif'){
            $img_original = imagecreatefromgif($origen);
        } elseif (mime_content_type($origen) == 'image/jpeg'){
            $img_original = imagecreatefromjpeg($origen);
        } else {
            throw new FileException("El formato del fichero no está soportado.");
        }

        //$img_original = imagecreatefrompng($origen);
        $ancho_original = imagesx($img_original);
        $alto_original = imagesy($img_original);

        if ($ancho_original >= $alto_original){
            $ancho_destino = 100;
            $alto_destino = (100 * $alto_original) / $ancho_original;
        } else {
            $ancho_destino = (100 * $ancho_original) / $alto_original;
            $alto_destino = 100;
        }

        $img_destino = imagecreatetruecolor($ancho_destino, $alto_destino);

        imagecopyresampled(
            $img_destino, $img_original, 0, 0, 0, 0,
            $ancho_destino, $alto_destino,
            $ancho_original, $alto_original);

        //header("Content-type: image/png");
        imagepng($img_destino, $destino);
        imagedestroy($img_original);
        imagedestroy($img_destino);
    }

}