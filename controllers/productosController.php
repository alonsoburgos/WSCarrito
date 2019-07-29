<?php

namespace DesarrolloInnovacion\WSCarrito\Controllers;
use Coppel\RAC\Controllers\RESTController;
use Coppel\RAC\Exceptions\HTTPException;
use DesarrolloInnovacion\WSCarrito\Models as Modelos;

class productosController extends RESTController {

    private $logger;
    private $modelo;

    public function onConstruct() {
        $this->logger = \Phalcon\DI::getDefault()->get('logger');
        $this->modelo = new Modelos\productosModel();
    }

    public function fun_consultaproductos() {
        $response = null;
        try {
            $response = $this->modelo->fun_consultaproductos();
        } catch(\Exception $ex) {
            $mensaje = utf8_encode($ex->getMessage());
            $this->logger->error("[".__METHOD__ ."]"."Se lanzó la excepción ".$mensaje);
            throw new \Coppel\RAC\Exceptions\HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500,
                array(
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                )
            );
        }
        return $this->respond(["response" => $response]);
    }

    public function fun_agregaproducto() {
        $response = false;
        $producto  = $this->request->getJsonRawBody();
        try {
            $response = $this->modelo->fun_agregaproducto($producto->nom_producto, $producto->imp_precio, $producto->num_existencia);
        } catch(\Exception $ex) {
            $mensaje = utf8_encode($ex->getMessage());
            $this->logger->error("[".__METHOD__ ."]"."Se lanzó la excepción ".$mensaje);
            throw new \Coppel\RAC\Exceptions\HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500,
                array(
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                )
            );
        }
        return $this->respond(["response" => $response]);
    }

    public function fun_editarproducto() {
        $response = false;
        $producto  = $this->request->getJsonRawBody();
        try {
            $response = $this->modelo->fun_editarproducto($producto->idu_producto, $producto->nom_producto, $producto->imp_precio, $producto->num_existencia);
        } catch(\Exception $ex) {
            $mensaje = utf8_encode($ex->getMessage());
            $this->logger->error("[".__METHOD__ ."]"."Se lanzó la excepción ".$mensaje);
            throw new \Coppel\RAC\Exceptions\HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500,
                array(
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                )
            );
        }
        return $this->respond(["response" => $response]);
    }
  
}