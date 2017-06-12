<?php

require_once 'GesticoleDB.php';
 

class Teacher {
  private $dni;
  private $nombre;
  private $direccion;
  private $telefono;
  private $actividad;

  
  function __construct($dni, $nombre, $direccion, $telefono, $idActividad) {
    $this->dni = $dni;
    $this->nombre = $nombre;
    $this->direccion = $direccion;
    $this->telefono = $telefono;
    $this->idActividad = $idActividad;
  }

  function getDni() {
    return $this->dni;
  }

  function getNombre() {
    return $this->nombre;
  }

  function getDireccion() {
    return $this->direccion;
  }

  function getTelefono() {
    return $this->telefono;
  }  

  function getidActividad() {
    return $this->idActividad;
  }

  function setDni() {
    return $this->dni;
  }

  function setNombre() {
    return $this->nombre;
  }

  function setDireccion() {
    return $this->direccion;
  }

  function setTelefono() {
    return $this->telefono;
  }  

  function setIdActividad() {
    return $this->idActividad;
  }
  
  public function insert() {
    $conexion = GesticoleDB::connectDB();
    $insercion = "INSERT INTO profesor (dni, nombre, direccion, telefono, idActividad) VALUES (\"".$this->dni."\", \"".$this->nombre."\", \"".$this->direccion."\", \"".$this->telefono."\", \"".$this->idActividad."\")";
    //$insercion = "INSERT INTO profesor (dni, nombre, direccion, telefono, actividad) VALUES (1, 2, 3, 4, 'zumba')";
    $conexion->exec($insercion);
  }

  public function delete() {
    $conexion = GesticoleDB::connectDB();
    $borrado = "DELETE FROM profesor WHERE dni=\"".$this->dni."\"";
    $conexion->exec($borrado);
  }
  
  public static function getTeacher() {
    $conexion = GesticoleDB::connectDB();
    $seleccion = "SELECT dni, nombre, direccion, telefono, idActividad FROM profesor";
    $consulta = $conexion->query($seleccion);
        
    while ($registro = $consulta->fetchObject()) {
      $profesor[] = new Teacher($registro->dni, $registro->nombre, $registro->direccion, $registro->telefono, $registro->idActividad);
    }
   
    return $profesor;    
  }
  
  public static function getTeacherId($dni) {
    $conexion = GesticoleDB::connectDB();
    $seleccion = "SELECT dni, nombre, direccion, telefono, idActividad FROM profesor WHERE dni=\"".$dni."\"";
    $consulta = $conexion->query($seleccion);
    $registro = $consulta->fetchObject();
    $profesor = new Teacher($registro->dni, $registro->nombre, $registro->direccion, $registro->telefono, $registro->idActividad);
    return $profesor;    
  }
    
  public function update() {
    
    $conexion = GesticoleDB::connectDB();
    $update = "UPDATE profesor SET dni=\" $this->dni\", nombre=\" $this->nombre\", direccion =\" $this->direccion \", telefono =\" $this->telefono \", idActividad =\" $this->idActividad \" WHERE dni=\"".$this->dni."\"";    
    $conexion->exec($update);
  }
}
