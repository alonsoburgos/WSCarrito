<?php

namespace DesarrolloInnovacion\WSCarrito\Controllers;
use Coppel\RAC\Controllers\RESTController;
use Coppel\RAC\Exceptions\HTTPException;
use DesarrolloInnovacion\WSCarrito\Models as Modelos;

class loginController extends RESTController {

    private $logger;
    private $modelo;

    public function onConstruct() {
        $this->logger = \Phalcon\DI::getDefault()->get('logger');
        $this->modelo = new Modelos\loginModel();
    }

    public function fun_login() {
        
        $response = false;
        $account  = $this->request->getJsonRawBody();
        try {
            $account->password = md5($account->password);
            $response = $this->modelo->fun_login($account->email, $account->password);
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