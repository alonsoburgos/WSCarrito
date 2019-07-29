<?php

namespace DesarrolloInnovacion\WSCarrito\Models;
use Phalcon\Mvc\Model as Modelo;

class LoginModel extends Modelo {

  public function fun_login($email, $password) {
    $response = array();
    $di = \Phalcon\DI::getDefault();
    $db = $di->get('conexion');
    $statement = $db->prepare("SELECT idu_usuario, nom_usuario FROM fun_login(?,?);");
    $statement->bindParam(1,  $email, \PDO::PARAM_STR);
    $statement->bindParam(2,  $password, \PDO::PARAM_STR);
    $statement->execute();
    $entry = $statement->fetch(\PDO::FETCH_ASSOC); 
    $resultSet = new \stdClass();
    $resultSet->idu_usuario    = $entry["idu_usuario"];
    $resultSet->nom_usuario   = $entry["nom_usuario"];
    $response[] = $resultSet;

    return $response;
  }

}