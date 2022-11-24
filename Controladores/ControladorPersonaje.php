<?php

include "Funciones//FuncionesPersonaje.php";

class ControladorPersonaje extends FuncionesPersonaje {
    
    function recibirSolicitud ($metodo, $parametro) {
        
        $nuevoParametro = urldecode($parametro[0]);
        
        if ($metodo === "DELETE") {
            
            /*No es correcto borrar 
            registros de una base de
            datos en un ambiente 
            productivo.*/
            
        } elseif ($metodo === "GET") {
            
            if ($nuevoParametro === "obtenerPersonajes1") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->obtenerPersonajes($nuevoValor);
            
            } elseif ($nuevoParametro === "obtenerPersonajes2") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->obtenerPersonajes2($nuevoValor);
                
            } elseif ($nuevoParametro === "obtenerPersonajes3") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->obtenerPersonajes3($nuevoValor);   
            }
            
        } elseif ($metodo === "POST") {   
            
        } elseif ($metodo === "PUT") {
            
            if ($nuevoParametro === "cambioPersonajes") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->cambiarPersonaje($nuevoValor);                
            }
        }
    }
}
