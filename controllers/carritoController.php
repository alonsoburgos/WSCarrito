<?php

namespace DesarrolloInnovacion\WSCarrito\Controllers;
use Coppel\RAC\Controllers\RESTController;
use Coppel\RAC\Exceptions\HTTPException;
use DesarrolloInnovacion\WSCarrito\Models as Modelos;

class carritoController extends RESTController {

    private $logger;
    private $modelo;

    public function onConstruct() {
        $this->logger = \Phalcon\DI::getDefault()->get('logger');
        $this->modelo = new Modelos\carritoModel();
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

    public function fun_agregaproductoacarrito() {
        $response = false;
        $producto  = $this->request->getJsonRawBody();
        try {
            $sn_existe = $this->modelo->fun_validaexistencia($producto->idu_producto, $producto->num_cantidad);
            if($sn_existe){
                $sn_existe = $this->modelo->fun_agregaproductoacarrito($producto->idu_usuario, $producto->idu_producto, $producto->num_cantidad);
                $response = true;
            }
            else{
                $response = false;
            }
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

    public function fun_consultaproductoscarrito($idu_usuario) {
        $response = null;
        $producto  = $this->request->getJsonRawBody();
        try {
            $response = $this->modelo->fun_consultaproductoscarrito($idu_usuario);
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

    public function fun_eliminaproductodelcarrito() {
        $response = false;
        $producto  = $this->request->getJsonRawBody();
        try {
                $response = $this->modelo->fun_eliminaproductodelcarrito($producto->idu_usuario, $producto->idu_producto);
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

    public function fun_eliminacarrito() {
        $response = false;
        $usuario  = $this->request->getJsonRawBody();
        try {
                $response = $this->modelo->fun_eliminacarrito($usuario->idu_usuario);
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

    public function fun_comprar() {
        $response = false;
        $productos  = $this->request->getJsonRawBody();
        $iTotalCompra = 0;
        $productosinexistencia = null;
        try {
            foreach ($productos as $producto){
                $iTotalCompra = $iTotalCompra + $producto->imp_totalproducto;
                $sn_existe = $this->modelo->fun_validaexistencia($producto->idu_producto, $producto->num_cantidad);
                if($sn_existe == 0){
                    $productosinexistencia = $producto;
                    break;
                }
            }
            if($sn_existe){
                $idu_venta = $this->modelo->fun_guardarventa($iTotalCompra);
                foreach ($productos as $producto){
                    $ventaDetalle = $this->modelo->fun_guardarventadetalle($idu_venta, $producto->idu_producto, $producto->num_cantidad, $producto->imp_precio, $producto->imp_totalproducto);
                    $inventario = $this->modelo->fun_actualizainventario($producto->idu_producto, $producto->num_cantidad);
                }
                $eliminacarrito = $this->modelo->fun_eliminacarrito($productos[0]->idu_usuario);
                $response = true;
            }
            else{
                $response = false;
            }
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