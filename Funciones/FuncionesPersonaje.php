<?php

include "Conectores//ConectorBaseDatos.php";

class FuncionesPersonaje extends ConectorBaseDatos {  
    
    function obtenerPersonajes2($nuevoValor) {

        $idUsuario = $nuevoValor->idUsuario;
        $consultaExterior1 = "select idPersonaje from PersonajesUsuarios where idUsuario = $idUsuario and estado = 'ADQUIRIDO Y VIGENTE'";
        $respuestaExterior1 = $this->consultarBaseDatos($consultaExterior1);

        foreach ($respuestaExterior1 as $key => $valueExterior1) {

            $idPersonaje = $valueExterior1["idPersonaje"];            
            $consultaExterior2 = "select * from Personajes where id = $idPersonaje";
            $respuestaExterior2 = $this->consultarBaseDatos($consultaExterior2);
            
            foreach ($respuestaExterior2 as $key => $valueExterior2) {

                $idPersonaje = $valueExterior2["id"];
                $nombre = $valueExterior2["nombre"];
                $alcance = $valueExterior2["alcance"];
                $armadura = $valueExterior2["armadura"];
                $ataque = $valueExterior2["ataque"];
                $dano = $valueExterior2["dano"];
                $defensa = $valueExterior2["defensa"];
                $iniciativa = $valueExterior2["iniciativa"];
                $movimiento = $valueExterior2["movimiento"];
                $salud = $valueExterior2["salud"];
                $idCategoria = $valueExterior2["idCategoria"];
                $consultaInterior = "select nombre from Categorias where id = $idCategoria";
                $respuestaInterior = $this->consultarBaseDatos($consultaInterior);

                foreach ($respuestaInterior as $key => $valueInterior) {

                    $categoria = $valueInterior["nombre"];
                };

                $jsonRespuesta[] = array(
                    "id" => $idPersonaje,
                    "nombre" => $nombre,
                    "alcance" => $alcance,
                    "armadura" => $armadura,
                    "ataque" => $ataque,
                    "dano" => $dano,
                    "defensa" => $defensa,
                    "iniciativa" => $iniciativa,
                    "movimiento" => $movimiento,
                    "salud" => $salud,
                    "categoria" => $categoria
                );
            }
        }

        $respuestaPersonajes = json_encode($jsonRespuesta);
        echo $respuestaPersonajes;
    }
    
    function obtenerPersonajes3($nuevoValor) {

        $idUsuario = $nuevoValor->idUsuario;
        $consultaExterior1 = "select idPersonaje from PersonajesUsuarios where idUsuario = $idUsuario and estado = 'ADQUIRIDO'";
        $respuestaExterior1 = $this->consultarBaseDatos($consultaExterior1);
        
        if (mysqli_num_rows($respuestaExterior1) > 0) {

            foreach ($respuestaExterior1 as $key => $valueExterior1) {

                $idPersonaje = $valueExterior1["idPersonaje"];
                $consultaExterior2 = "select * from Personajes where id = $idPersonaje";
                $respuestaExterior2 = $this->consultarBaseDatos($consultaExterior2);

                foreach ($respuestaExterior2 as $key => $valueExterior2) {

                    $idPersonaje = $valueExterior2["id"];
                    $nombre = $valueExterior2["nombre"];
                    $alcance = $valueExterior2["alcance"];
                    $armadura = $valueExterior2["armadura"];
                    $ataque = $valueExterior2["ataque"];
                    $dano = $valueExterior2["dano"];
                    $defensa = $valueExterior2["defensa"];
                    $iniciativa = $valueExterior2["iniciativa"];
                    $movimiento = $valueExterior2["movimiento"];
                    $salud = $valueExterior2["salud"];
                    $idCategoria = $valueExterior2["idCategoria"];
                    $consultaInterior = "select nombre from Categorias where id = $idCategoria";
                    $respuestaInterior = $this->consultarBaseDatos($consultaInterior);

                    foreach ($respuestaInterior as $key => $valueInterior) {

                        $categoria = $valueInterior["nombre"];
                    };

                    $jsonRespuesta[] = array(
                        "id" => $idPersonaje,
                        "nombre" => $nombre,
                        "alcance" => $alcance,
                        "armadura" => $armadura,
                        "ataque" => $ataque,
                        "dano" => $dano,
                        "defensa" => $defensa,
                        "iniciativa" => $iniciativa,
                        "movimiento" => $movimiento,
                        "salud" => $salud,
                        "categoria" => $categoria
                    );
                }
            }
            
            $respuestaPersonajes = json_encode($jsonRespuesta);
            echo $respuestaPersonajes;
            
        } else {
            
            $respuestaPersonajes = "Sin personajes registrados.";
            echo $respuestaPersonajes;            
        }       
    }
    
    function cambiarPersonaje ($nuevoValor) {

        $idUsuario = $nuevoValor->idUsuario;
        $idPersonaje1 = $nuevoValor->idPersonaje1;
        $idPersonaje2 = $nuevoValor->idPersonaje2;
        $consulta = "update PersonajesUsuarios set estado = 'ADQUIRIDO' where idPersonaje = $idPersonaje1 and idUsuario = $idUsuario";
        $this->consultarBaseDatos($consulta);
        $consulta = "update PersonajesUsuarios set estado = 'ADQUIRIDO Y VIGENTE' where idPersonaje = $idPersonaje2 and idUsuario = $idUsuario";
        $this->consultarBaseDatos($consulta);
        $respuestaPersonajes = "Cambio de personajes registrado.";
        echo $respuestaPersonajes;
    }
}
