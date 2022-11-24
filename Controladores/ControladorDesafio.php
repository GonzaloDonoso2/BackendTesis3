<?php

include "Funciones//FuncionesDesafio.php";

class ControladorDesafio extends FuncionesDesafio {

    function recibirSolicitud($metodo, $parametro) {

        $nuevoParametro = urldecode($parametro[0]);

        if ($metodo === "GET") {
            
            if ($nuevoParametro === "nombreUsuario") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->buscarUsuario($nuevoValor);
                
            }elseif ($nuevoParametro === "desafio") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->obtenerDesafio($nuevoValor);
                
            } elseif ($nuevoParametro === "idDesafio") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->obtenerRespuestaDesafio($nuevoValor);
                
            } elseif ($nuevoParametro === "usuario") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->buscarDesafio($nuevoValor);
            }
            
        } elseif ($metodo === "POST") {

            if ($nuevoParametro === "desafio") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->registrarDesafio($nuevoValor);
            }
            
        } elseif ($metodo === "PUT") {

            if ($nuevoParametro === "desafioAceptado") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->aceptarDesafio($nuevoValor);
            } else if ($nuevoParametro === "desafioRechazado") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->rechazarDesafio($nuevoValor);
            }
        }
    }
}
