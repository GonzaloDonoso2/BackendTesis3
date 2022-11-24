<?php

include "Funciones//FuncionesUsuario.php";

class ControladorUsuario extends FuncionesUsuario {
    
    function recibirSolicitud ($metodo, $parametro) {
        
        $nuevoParametro = urldecode($parametro[0]);
        
        if ($metodo === "DELETE") {
            
            /*No es correcto borrar 
            registros de una base de
            datos en un ambiente 
            productivo.*/
            
        } elseif ($metodo === "GET") {
            
            if ($nuevoParametro === "inicioSesion") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->iniciarSesion($nuevoValor);
                
            } elseif ($nuevoParametro === "nombreUsuario1") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->verificarNombreUsuario1($nuevoValor);
                
            }  elseif ($nuevoParametro === "correoElectronicoUsuario1") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->verificarCorreoElectronicoUsuario1($nuevoValor); 
                
            } elseif ($nuevoParametro === "nombreUsuario2") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->verificarNombreUsuario2($nuevoValor);
                
            } elseif ($nuevoParametro === "correoElectronicoUsuario2") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->verificarCorreoElectronicoUsuario2($nuevoValor);
                
            } elseif ($nuevoParametro === "id") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->obtenerUsuario($nuevoValor);
                
            } elseif ($nuevoParametro === "usuarios") {
                
                $this->obtenerUsuarios();               
            }
            
        } elseif ($metodo === "POST") {
            
            if ($nuevoParametro === "usuario") {
                
                $valor = urldecode($parametro[1]);
                $usuario = json_decode($valor);
                $this->registrarUsuario($usuario);                
            }
            
        } elseif ($metodo === "PUT") {
            
            if ($nuevoParametro === "nombreUsuario") {

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->editarNombre($nuevoValor);
                
            } elseif ($nuevoParametro === "correoElectronicoUsuario") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->editarCorreoElectronico($nuevoValor);
                
            } elseif ($nuevoParametro === "contrasenaUsuario") {
                
                $valor = urldecode($parametro[1]);                
                $nuevoValor = json_decode($valor);
                $this->editarContrasena($nuevoValor);
            }
        }
    }
}
