<?php
namespace modelos\Auxiliar;
class FuncionesAyuda
{

	public static function imprimir_arreglo($arreglo) {
        echo '<pre>',print_r($arreglo,1),'</pre>';
    }
    public static function estado_pedido($valor)
    {
    	switch ($valor) {
    		case 0:
    			return "Solicitado";
    		break;
    		case 1:
    			return "En Proceso";
    		break;
    		case 2:
    			return "Enviado";
    		break;
    		case 3:
    			return "Finalizado";
    		break;
    		
    	}
    }

    public static function estado_pedido_numerico($valor)
    {
    	switch ($valor) {
    		case 'Solicitado':
    			return 0;
    		break;
    		case 'En Proceso':
    			return 1;
    		break;
    		case 'Enviado':
    			return 2;
    		break;
    		case 'Finalizado':
    			return 3;
    		break;
    		
    	}
    }

 
} 
