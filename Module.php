<?php

use Coppel\RAC\Modules\IModule;
use Phalcon\Mvc\Micro\Collection;
use Katzgrau\KLogger\Logger;

class Module implements IModule {

  public function __construct() {

  }

  public function registerLoader($loader) {
  	$loader->registerNamespaces(array('DesarrolloInnovacion\WSCarrito\Controllers' => __DIR__.'/controllers/',
      'DesarrolloInnovacion\WSCarrito\Models' => __DIR__.'/models/'
      ), true);
  }

  public function getCollections() {
    $login      = new Collection();
    $carrito    = new Collection();
    $productos  = new Collection();

    $login->setPrefix('/api')->setHandler('\DesarrolloInnovacion\WSCarrito\Controllers\loginController')->setLazy(true);        
    $carrito->setPrefix('/api')->setHandler('\DesarrolloInnovacion\WSCarrito\Controllers\carritoController')->setLazy(true);
    $productos->setPrefix('/api')->setHandler('\DesarrolloInnovacion\WSCarrito\Controllers\productosController')->setLazy(true);

    //LOGIN
    $login->post('/fun_login',                                      'fun_login');

    //CARRITO
    $carrito->get('/fun_consultaproductos',                         'fun_consultaproductos');
    $carrito->get('/fun_consultaproductoscarrito/{idu_usuario}',    'fun_consultaproductoscarrito');
    $carrito->post('/fun_agregaproductoacarrito',                   'fun_agregaproductoacarrito');
    $carrito->delete('/fun_eliminaproductodelcarrito',              'fun_eliminaproductodelcarrito');
    $carrito->delete('/fun_eliminacarrito',                         'fun_eliminacarrito');
    $carrito->post('/fun_comprar',                                  'fun_comprar');

    //PRODUCTOS
    $productos->get('/fun_consultaproductosabc',                    'fun_consultaproductos');
    $productos->post('/fun_agregaproducto',                         'fun_agregaproducto');
    $productos->post('/fun_editarproducto',                         'fun_editarproducto');

    return  [   
                $login,
                $carrito,
                $productos
            ];
  }

  public function registerServices() {
  	
        $di = Phalcon\DI::getDefault();

        $di->set('logger', function() use ($di) {
          return new Logger('logs');
        });

// --------------------------------------------------------------------------------------------------------------
// ----------------------------------------------INSTANCIAS DE BASE DE DATOS-------------------------------------
// --------------------------------------------------------------------------------------------------------------
        $di->set('conexion', function() use ($di) { 
            $config = $di->get('config')->dbCarrito;
        
            $host   = $config->host;
            $port   = $config->port;
            $dbname = $config->dbname;
            $user   = $config->username;
            $pass   = $config->password;

            return new \PDO("pgsql:host=$host;dbname=$dbname", $user, $pass,
                array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
            );
        });
  }
}