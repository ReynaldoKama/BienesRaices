<?php

namespace App;

class ActiveRecord {
    //Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Errores o validación
    protected static $errores = [];
    

    //Definir la conexión a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }

    public function guardar() {
        if(!is_null($this->id)) {
            $this->actualizar();
        } else {
            $this->crear();
        }
    }

    public function crear() {
        //sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $string = join(', ', array_keys($atributos));

        //Insertar en la base de datos
        $query = "INSERT INTO ". static::$tabla ." (". join(', ', array_keys($atributos)). ") VALUES ('" . join("', '", array_values($atributos)) . "')";

        $resultado = self::$db->query($query);
        if($resultado) {
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar() {
        //sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE ". static::$tabla ." SET " . join(', ', $valores) . " WHERE id = " . self::$db->escape_string($this->id). " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado) {
            header('Location: /admin?resultado=2');
        }
    }

    public function eliminar() {
        $query = "DELETE FROM ". static::$tabla ." WHERE id = ".self::$db->escape_string($this->id). " LIMIT 1";

        $resultado = self::$db->query($query);
        if($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }

    }

    //Identificar y unir los atributos de la base de datos
    public function atributos() {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Validación
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];

        return static::$errores;
    }

    public function setImagen($imagen) {
        //Elimina la imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        //ASigna la imagen al atributo de la clase
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //Lista todas las propiedades
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Obtiene determinado número de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca un registro por su ID
    public static function find($id) {
        $query = "SELECT * FROM ". static::$tabla ." WHERE id = $id";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado); //Retorna el primer elemento del arreglo
    }

    public static function consultarSQL($query) {
        //Consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //Liberar la memoria

        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach ($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}