<?php

require_once 'GesticoleDB.php';

class Alumno {
  private $dni;
  private $nombre;
  private $idColegio;
  private $edad;
  private $curso;
  private $idActividad;

  
  function __construct($dni, $nombre, $idColegio, $edad, $curso, $idActividad) {
    $this->dni = $dni;
    $this->nombre = $nombre;
    $this->idColegio = $idColegio;
    $this->edad = $edad;
    $this->curso = $curso;
    $this->idActividad = $idActividad;
  }

  function getDni() {
    return $this->dni;
  }

  function getNombre() {
    return $this->nombre;
  }

  function getIdColegio() {
    return $this->idColegio;
  }

  function getEdad() {
    return $this->edad;
  }  

  function getCurso() {
    return $this->curso;
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

  function setIdColegio() {
    return $this->IdColegio;
  }

  function setEdad() {
    return $this->edad;
  }  

  function setCurso() {
    return $this->curso;
  }

  function setIdActividad() {
    return $this->idActividad;
  }
  
  public function insert() {
    $conexion = GesticoleDB::connectDB();
    $insercion = "INSERT INTO alumno (dni, nombre, idColegio, edad, curso, idActividad) VALUES (\"".$this->dni."\", \"".$this->nombre."\", \"".$this->idColegio."\", \"".$this->edad."\", \"".$this->curso."\",\"".$this->idActividad."\")";
    $conexion->exec($insercion);
  }

  public function delete() {
    $conexion = GesticoleDB::connectDB();
    $borrado = "DELETE FROM alumno WHERE dni=\"".$this->dni."\"";
    $conexion->exec($borrado);
  }
  
  public static function getAlumno() {
    $conexion = GesticoleDB::connectDB();
    $seleccion = "SELECT dni, nombre, idColegio, edad, curso, idActividad FROM alumno";
    $consulta = $conexion->query($seleccion);
        
    while ($registro = $consulta->fetchObject()) {
      $alumno[] = new Alumno($registro->dni, $registro->nombre, $registro->idColegio, $registro->edad, $registro->curso, $registro->idActividad);
    }
   
    return $alumno;    
  }
  
  public static function getAlumnoDni($dni) {
    $conexion = GesticoleDB::connectDB();
    $seleccion = "SELECT dni, nombre, idColegio, edad, curso, idActividad FROM alumno WHERE dni=\"".$dni."\"";
    $consulta = $conexion->query($seleccion);
    $registro = $consulta->fetchObject();
    $alumno = new Alumno($registro->dni, $registro->nombre, $registro->idColegio, $registro->edad, $registro->curso, $registro->idActividad);
    return $alumno;    
  }
    
  public function update() {
    
    $conexion = GesticoleDB::connectDB();
    $update = "UPDATE alumno SET nombre=\" $this->nombre\", idColegio =\" $this->idColegio \", edad =\" $this->edad \", curso =\" $this->curso \", idActividad =\" $this->idActividad \" WHERE dni=\"".$this->dni."\"";    
    $conexion->exec($update);
  }
}
