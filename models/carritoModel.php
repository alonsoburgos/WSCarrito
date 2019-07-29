<?php

namespace DesarrolloInnovacion\WSCarrito\Models;
use Phalcon\Mvc\Model as Modelo;

class CarritoModel extends Modelo {

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

  public function fun_validaexistencia($idu_producto, $num_cantidad) {
    $response = null;
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT * FROM fun_validaexistencia(?,?) AS sn_existe;");
    $statement->bindParam(1, $idu_producto, \PDO::PARAM_INT);
    $statement->bindParam(2, $num_cantidad, \PDO::PARAM_INT);
    $statement->execute();
    $entry = $statement->fetch(\PDO::FETCH_ASSOC);
    $response  = $entry["sn_existe"];
    return $response;
  }

  public function fun_agregaproductoacarrito($idu_usuario, $idu_producto, $num_cantidad) {
    $response = null;
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT FROM fun_agregaproductoacarrito(?,?,?);");
    $statement->bindParam(1,  $idu_usuario, \PDO::PARAM_INT);
    $statement->bindParam(2,  $idu_producto, \PDO::PARAM_INT);
    $statement->bindParam(3,  $num_cantidad, \PDO::PARAM_INT);
    $response = $statement->execute();
  
    return $response; 
  }
  
  public function fun_consultaproductoscarrito($idu_usuario) {
    $response = array();
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT idu_usuario, idu_producto, nom_producto, num_cantidad, imp_precio, imp_totalproducto FROM fun_consultaproductoscarrito(?);");
    $statement->bindParam(1,  $idu_usuario, \PDO::PARAM_INT);
    $statement->execute();
    while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
      $resultSet = new \stdClass();
      $resultSet->idu_usuario    = $entry["idu_usuario"];
      $resultSet->idu_producto   = $entry["idu_producto"];
      $resultSet->nom_producto   = $entry["nom_producto"];
      $resultSet->num_cantidad   = $entry["num_cantidad"];
      $resultSet->imp_precio     = $entry["imp_precio"];
      $resultSet->imp_totalproducto     = $entry["imp_totalproducto"];
      $response[] = $resultSet;
      $resultSet = null;
    }

    return $response;
  }

  public function fun_eliminaproductodelcarrito($idu_usuario, $idu_producto) {
    $response = null;
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT FROM fun_eliminaproductodelcarrito(?,?);");
    $statement->bindParam(1,  $idu_usuario, \PDO::PARAM_INT);
    $statement->bindParam(2,  $idu_producto, \PDO::PARAM_INT);
    $response = $statement->execute();
  
    return $response; 
  }

  public function fun_eliminacarrito($idu_usuario) {
    $response = null;
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT FROM fun_eliminacarrito(?);");
    $statement->bindParam(1,  $idu_usuario, \PDO::PARAM_INT);
    $response = $statement->execute();
  
    return $response; 
  }

  public function fun_guardarventa($iTotalCompra) {
    $response = null;
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT * FROM fun_guardarventa(?) AS idu_venta;");
    $statement->bindParam(1,  $iTotalCompra, \PDO::PARAM_INT);
    $statement->execute();
    $entry = $statement->fetch(\PDO::FETCH_ASSOC);
    $response  = $entry["idu_venta"];
    return $response;
  }

  public function fun_guardarventadetalle($idu_venta, $idu_producto, $num_cantidad, $imp_precio, $imp_totalproducto) {
    $response = null;
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT * FROM fun_guardarventadetalle(?,?,?,?,?);");
    $statement->bindParam(1,  $idu_venta, \PDO::PARAM_INT);
    $statement->bindParam(2,  $idu_producto, \PDO::PARAM_INT);
    $statement->bindParam(3,  $num_cantidad, \PDO::PARAM_INT);
    $statement->bindParam(4,  $imp_precio, \PDO::PARAM_INT);
    $statement->bindParam(5,  $imp_totalproducto, \PDO::PARAM_INT);
    $response = $statement->execute();
  
    return $response; 
  }

  public function fun_actualizainventario($idu_producto, $num_cantidad) {
    $response = null;
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT * FROM fun_actualizainventario(?,?);");
    $statement->bindParam(1,  $idu_producto, \PDO::PARAM_INT);
    $statement->bindParam(2,  $num_cantidad, \PDO::PARAM_INT);
    $response = $statement->execute();
  
    return $response; 
  }

}