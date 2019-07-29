<?php

namespace DesarrolloInnovacion\WSCarrito\Models;
use Phalcon\Mvc\Model as Modelo;

class ProductosModel extends Modelo {

  public function fun_consultaproductos() {
    $response = array();
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT idu_producto, nom_producto, imp_precio, num_existencia FROM fun_consultaproductos();");
    $statement->execute();
    while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
      $resultSet = new \stdClass();
      $resultSet->idu_producto   = $entry["idu_producto"];
      $resultSet->nom_producto   = $entry["nom_producto"];
      $resultSet->imp_precio     = $entry["imp_precio"];
      $resultSet->num_existencia = $entry["num_existencia"];
      $response[] = $resultSet;
      $resultSet = null;
    }

    return $response;
  }

  public function fun_agregaproducto($nom_producto, $imp_precio, $num_existencia) {
    $response = null;
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT FROM fun_agregaproducto(?,?,?);");
    $statement->bindParam(1,  $nom_producto, \PDO::PARAM_STR);
    $statement->bindParam(2,  $imp_precio, \PDO::PARAM_INT);
    $statement->bindParam(3,  $num_existencia, \PDO::PARAM_INT);
    $response = $statement->execute();
  
    return $response; 
  }

  public function fun_editarproducto($idu_producto, $nom_producto, $imp_precio, $num_existencia) {
    $response = null;
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT FROM fun_editarproducto(?,?,?,?);");
    $statement->bindParam(1,  $idu_producto, \PDO::PARAM_INT);
    $statement->bindParam(2,  $nom_producto, \PDO::PARAM_STR);
    $statement->bindParam(3,  $imp_precio, \PDO::PARAM_INT);
    $statement->bindParam(4,  $num_existencia, \PDO::PARAM_INT);
    $response = $statement->execute();
  
    return $response; 
  }

}