<?php

include "Funciones//FuncionesBatalla.php";

class ControladorBatalla extends FuncionesBatalla {

    function recibirSolicitud($metodo, $parametro) {

        $nuevoParametro = urldecode($parametro[0]);

        if ($metodo === "DELETE") {

            if ($nuevoParametro === "usuario") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->borrarRegistro($nuevoValor);
            }
            
        } else if ($metodo === "GET") {

            if ($nuevoParametro === "desafio") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->iniciarBatalla($nuevoValor);
                
            } else if ($nuevoParametro === "batalla") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->buscarTurno($nuevoValor);
                
            } else if ($nuevoParametro === "obtenerAtaque") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->obtenerAtaque($nuevoValor);
            
            } else if ($nuevoParametro === "obtenerMovimiento") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->obtenerMovimiento($nuevoValor);
                
            } else if ($nuevoParametro === "resultadoBatalla") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->obtenerResultadoBatalla($nuevoValor);
                
            } else if ($nuevoParametro === "resultadosBatallas") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->obtenerResultadosBatallas($nuevoValor);
            }
            
        } else if ($metodo === "POST") {
            
            if ($nuevoParametro === "ataque") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->registrarAtaque($nuevoValor);
                
            } else if ($nuevoParametro === "movimiento") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->registrarMovimiento($nuevoValor);
            }
            
        } else if ($metodo === "PUT") {
            
            if ($nuevoParametro === "terminarAtaque") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->terminarAtaque($nuevoValor);
                
            } else if ($nuevoParametro === "terminarMovimiento") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->terminarMovimiento($nuevoValor);
                
            } else if ($nuevoParametro === "terminarTurno") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->terminarTurno($nuevoValor);
                
            } else if ($nuevoParametro === "terminarBatalla") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->terminarBatalla($nuevoValor);
            }
        }
    }

}
