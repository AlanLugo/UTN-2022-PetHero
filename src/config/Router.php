<?php namespace config;

    class Router {
        
        public static function direccionar(Request $request) {
            $controlador = $request->getControlador() . 'Controlador';
            $metodo = $request->getMetodo();
            $parametros = $request->getParametros();  




            $ruta = ROOT . 'controladoras/' . $controlador . '.php';
            

            //require_once $ruta;
            $mostrar = "controladoras\\". $controlador;
            $controlador = new $mostrar;
            if(!isset($parametros)) {
                call_user_func(array($controlador, $metodo));
            } else {
                call_user_func_array(array($controlador, $metodo), $parametros);
            }
        }
    }

?>