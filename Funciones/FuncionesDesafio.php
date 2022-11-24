<?php

include "Conectores//ConectorBaseDatos.php";

class FuncionesDesafio extends ConectorBaseDatos {
    
    function buscarUsuario($nuevoValor) {
        
        $nombre = $nuevoValor->nombre;  
        $consulta = "select id, nombre from Usuarios where nombre = '$nombre' and estado = 'VIGENTE' and idPerfil = 2";
        $respuesta = $this->consultarBaseDatos($consulta);

        if (mysqli_num_rows($respuesta) > 0) {
            
            foreach ($respuesta as $key => $value) {
                
                $idUsuario = $value["id"];

                $jsonRespuesta[] = array(
                    "idUsuario" => $idUsuario
                );
            }

            $respuestaUsuario = json_encode($jsonRespuesta);

            echo $respuestaUsuario;
            
        } else {

            echo "Este usuario no está registrado.";
        }
    }
    
    function registrarDesafio($nuevoValor){
        
        $idUsuario2 = $nuevoValor->idUsuario2;        
        $consulta = "select estado from Desafios where idUsuario2 = $idUsuario2 and estado = 'VIGENTE'";        
        $respuesta = $this->consultarBaseDatos($consulta);

        if(mysqli_num_rows($respuesta) > 0){
            
            echo "Este usuario ya tiene un desafío anterior vigente.";
            
        }else{

            $fecha = $nuevoValor->fecha;
            $idUsuario1 = $nuevoValor->idUsuario1;
            $colorUsuario1 = $nuevoValor->colorUsuario1;
            $consulta = "insert into Desafios (estado, fecha, idUsuario1, idUsuario2, colorUsuario1, colorUsuario2) values ('VIGENTE', '$fecha', $idUsuario1, $idUsuario2, '$colorUsuario1', 'SIN COLOR')";
            $this->consultarBaseDatos($consulta);
        }
    }
    
    function obtenerDesafio($nuevoValor){

        $idUsuario1 = $nuevoValor->idUsuario1;
        $idUsuario2 = $nuevoValor->idUsuario2;
        $colorUsuario1 = $nuevoValor->colorUsuario1;
        $fecha = $nuevoValor->fecha;
        $consulta = "select id from Desafios where idUsuario1 = $idUsuario1 and idUsuario2 = $idUsuario2 and colorUsuario1 = '$colorUsuario1' and colorUsuario2 = 'SIN COLOR' and fecha = '$fecha'";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach($respuesta as $key => $value){

            $idDesafio = $value["id"];
        }

        $jsonRespuesta[] = array(
            "idDesafio" => $idDesafio
        );

        $respuestaDesafio = json_encode($jsonRespuesta);

        echo $respuestaDesafio;
    }
    
    function obtenerRespuestaDesafio($nuevoValor) {

        $idDesafio = $nuevoValor->id;
        $consulta = "select estado from Desafios where id = $idDesafio and estado != 'VIGENTE'";
        $respuesta = $this->consultarBaseDatos($consulta);

        if (mysqli_num_rows($respuesta) > 0) {

            foreach ($respuesta as $key => $value) {

                $estadoDesafio = $value["estado"];
            }

            $jsonRespuesta[] = array(
                
                "estadoDesafio" => $estadoDesafio
            );

            $respuestaDesafio = json_encode($jsonRespuesta);
            echo $respuestaDesafio;
            
        } else {

            echo "Sin Respuesta.";
        }
    }

    function rechazarDesafio($nuevoValor){
        
        $idDesafio = $nuevoValor->idDesafio;
        $consulta = "update Desafios set estado = 'RECHAZADO' where id = $idDesafio";
        $this->consultarBaseDatos($consulta);
        echo "Desafío rechazado.";        
    }    

    function aceptarDesafio($nuevoValor){
        
        $idDesafio = $nuevoValor->idDesafio;
        $colorUsuario = $nuevoValor->colorUsuario;
        $consulta = "update Desafios set estado = 'ACEPTADO', colorUsuario2 = '$colorUsuario' where id = $idDesafio";
        $this->consultarBaseDatos($consulta);
        $consulta = "insert into Batallas (estado, idDesafio) values ('VIGENTE', $idDesafio)";
        $this->consultarBaseDatos($consulta);
        $consulta = "select id from Batallas where idDesafio = $idDesafio";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $idBatalla = $value["id"];
        }
        
        $consulta = "select idUsuario1, idUsuario2 from Desafios where id = $idDesafio";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $idUsuario1 = $value["idUsuario1"];
            $idUsuario2 = $value["idUsuario2"];
        }
        
        $consultaExterior1 = "select idPersonaje from PersonajesUsuarios where idUsuario = $idUsuario1 and estado = 'ADQUIRIDO Y VIGENTE'";
        $respuestaExterior1 = $this->consultarBaseDatos($consultaExterior1);

        foreach ($respuestaExterior1 as $key => $valueExterior1) {

            $idPersonaje = $valueExterior1["idPersonaje"];            
            $consultaExterior2 = "select * from Personajes where id = $idPersonaje";
            $respuestaExterior2 = $this->consultarBaseDatos($consultaExterior2);
            
            foreach ($respuestaExterior2 as $key => $valueExterior2) {

                $idPersonaje = $valueExterior2["id"];
                $alcance = $valueExterior2["alcance"];
                $armadura = $valueExterior2["armadura"];
                $ataque = $valueExterior2["ataque"];
                $dano = $valueExterior2["dano"];
                $defensa = $valueExterior2["defensa"];
                $provisoriaIniciativa = $valueExterior2["iniciativa"];
                $iniciativa = random_int(1, $provisoriaIniciativa);
                $movimiento = $valueExterior2["movimiento"];
                $nombre = $valueExterior2["nombre"];
                $salud = $valueExterior2["salud"];

                $provisoriaListaOrdenPersonajes[] = array(
                    "idPersonaje" => $idPersonaje,
                    "alcance" => $alcance,
                    "armadura" => $armadura,
                    "ataque" => $ataque,
                    "dano" => $dano,
                    "defensa" => $defensa,
                    "iniciativa" => $iniciativa,
                    "movimiento" => $movimiento,
                    "nombre" => $nombre,
                    "salud" => $salud,
                    "idUsuario" => $idUsuario1
                );
            }
        }

        $consultaExterior1 = "select idPersonaje from PersonajesUsuarios where idUsuario = $idUsuario1 and estado = 'ADQUIRIDO Y VIGENTE'";
        $respuestaExterior1 = $this->consultarBaseDatos($consultaExterior1);

        foreach ($respuestaExterior1 as $key => $valueExterior1) {

            $idPersonaje = $valueExterior1["idPersonaje"];            
            $consultaExterior2 = "select * from Personajes where id = $idPersonaje";
            $respuestaExterior2 = $this->consultarBaseDatos($consultaExterior2);
            
            foreach ($respuestaExterior2 as $key => $valueExterior2) {

                $idPersonaje = $valueExterior2["id"];
                $alcance = $valueExterior2["alcance"];
                $armadura = $valueExterior2["armadura"];
                $ataque = $valueExterior2["ataque"];
                $dano = $valueExterior2["dano"];
                $defensa = $valueExterior2["defensa"];
                $provisoriaIniciativa = $valueExterior2["iniciativa"];
                $iniciativa = random_int(1, $provisoriaIniciativa);
                $movimiento = $valueExterior2["movimiento"];
                $nombre = $valueExterior2["nombre"];
                $salud = $valueExterior2["salud"];

                $provisoriaListaOrdenPersonajes[] = array(
                    "idPersonaje" => $idPersonaje,
                    "alcance" => $alcance,
                    "armadura" => $armadura,
                    "ataque" => $ataque,
                    "dano" => $dano,
                    "defensa" => $defensa,
                    "iniciativa" => $iniciativa,
                    "movimiento" => $movimiento,
                    "nombre" => $nombre,
                    "salud" => $salud,
                    "idUsuario" => $idUsuario2
                );
            }
        }
        
        $numeroPersonajes = count($provisoriaListaOrdenPersonajes);
        
        for ($i = 0; $i < $numeroPersonajes; $i++) {
            
            for ($j = 0; $j < ($numeroPersonajes - 1); $j++) {
                
                if ($provisoriaListaOrdenPersonajes[$j]["iniciativa"] <= $provisoriaListaOrdenPersonajes[$j + 1]["iniciativa"]) {
                    $x = $provisoriaListaOrdenPersonajes[$j];
                    $provisoriaListaOrdenPersonajes[$j] = $provisoriaListaOrdenPersonajes[$j + 1];
                    $provisoriaListaOrdenPersonajes[$j + 1] = $x;
                }
            }
        }
        
        $provisoriaListaOrdenPersonajesUsuario1 = array();
        $provisoriaListaOrdenPersonajesUsuario2 = array();
        $listaOrdenPersonajes = array();
        
        for ($i = 0; $i < count($provisoriaListaOrdenPersonajes); $i++) {

            if ($provisoriaListaOrdenPersonajes[$i]["idUsuario"] === $idUsuario1) {

                $provisoriaListaOrdenPersonajesUsuario1[] = $provisoriaListaOrdenPersonajes[$i];
            }

            if ($provisoriaListaOrdenPersonajes[$i]["idUsuario"] === $idUsuario2) {

                $provisoriaListaOrdenPersonajesUsuario2[] = $provisoriaListaOrdenPersonajes[$i];
            }
        }
        
        if ($provisoriaListaOrdenPersonajesUsuario1[0]["iniciativa"] >= $provisoriaListaOrdenPersonajesUsuario2[0]["iniciativa"]) {

            $listaOrdenPersonajes[0] = $provisoriaListaOrdenPersonajesUsuario1[0];
            $listaOrdenPersonajes[1] = $provisoriaListaOrdenPersonajesUsuario2[0];
            $listaOrdenPersonajes[2] = $provisoriaListaOrdenPersonajesUsuario1[1];
            $listaOrdenPersonajes[3] = $provisoriaListaOrdenPersonajesUsuario2[1];
            $listaOrdenPersonajes[4] = $provisoriaListaOrdenPersonajesUsuario1[2];
            $listaOrdenPersonajes[5] = $provisoriaListaOrdenPersonajesUsuario2[2];
            $listaOrdenPersonajes[6] = $provisoriaListaOrdenPersonajesUsuario1[3];
            $listaOrdenPersonajes[7] = $provisoriaListaOrdenPersonajesUsuario2[3];
            $listaOrdenPersonajes[0]["posicion"] = "5F";
            $listaOrdenPersonajes[1]["posicion"] = "5K";
            $listaOrdenPersonajes[2]["posicion"] = "7F";
            $listaOrdenPersonajes[3]["posicion"] = "7K";
            $listaOrdenPersonajes[4]["posicion"] = "6H";
            $listaOrdenPersonajes[5]["posicion"] = "6M";
            $listaOrdenPersonajes[6]["posicion"] = "8H";
            $listaOrdenPersonajes[7]["posicion"] = "8M";
            
        } else {
            
            $listaOrdenPersonajes[0] = $provisoriaListaOrdenPersonajesUsuario2[0];
            $listaOrdenPersonajes[1] = $provisoriaListaOrdenPersonajesUsuario1[0];
            $listaOrdenPersonajes[2] = $provisoriaListaOrdenPersonajesUsuario2[1];
            $listaOrdenPersonajes[3] = $provisoriaListaOrdenPersonajesUsuario1[1];
            $listaOrdenPersonajes[4] = $provisoriaListaOrdenPersonajesUsuario2[2];
            $listaOrdenPersonajes[5] = $provisoriaListaOrdenPersonajesUsuario1[2];
            $listaOrdenPersonajes[6] = $provisoriaListaOrdenPersonajesUsuario2[3];
            $listaOrdenPersonajes[7] = $provisoriaListaOrdenPersonajesUsuario1[3];
            $listaOrdenPersonajes[0]["posicion"] = "5F";
            $listaOrdenPersonajes[1]["posicion"] = "5K";
            $listaOrdenPersonajes[2]["posicion"] = "7F";
            $listaOrdenPersonajes[3]["posicion"] = "7K";
            $listaOrdenPersonajes[4]["posicion"] = "6H";
            $listaOrdenPersonajes[5]["posicion"] = "6M";
            $listaOrdenPersonajes[6]["posicion"] = "8H";
            $listaOrdenPersonajes[7]["posicion"] = "8M";            
        }

        for ($i = 0; $i < count($listaOrdenPersonajes); $i++) {
            
            $alcance = $listaOrdenPersonajes[$i]["alcance"];            
            $armadura = $listaOrdenPersonajes[$i]["armadura"];
            $ataque = $listaOrdenPersonajes[$i]["ataque"];
            $dano = $listaOrdenPersonajes[$i]["dano"];
            $defensa = $listaOrdenPersonajes[$i]["defensa"];
            $iniciativa = $listaOrdenPersonajes[$i]["iniciativa"];
            $movimiento = $listaOrdenPersonajes[$i]["movimiento"];
            $nombre = $listaOrdenPersonajes[$i]["nombre"];
            $posicion = $listaOrdenPersonajes[$i]["posicion"];
            $salud = $listaOrdenPersonajes[$i]["salud"];
            $idPersonaje = $listaOrdenPersonajes[$i]["idPersonaje"];
            $idUsuario = $listaOrdenPersonajes[$i]["idUsuario"];
            
            if ($idUsuario === $idUsuario1) {
                
                $orientacion = "Derecha";
                
            } else {
                
                $orientacion = "Izquierda";                
            }
            
            $consultaInterior = "insert into BatallasEstadisticas (alcance, armadura, ataque, dano, defensa, iniciativa, movimiento, nombre, orientacion, posicion, salud, idBatalla, idPersonaje, idUsuario) values ($alcance, $armadura, $ataque, $dano, $defensa, $iniciativa, $movimiento, '$nombre', '$orientacion', '$posicion', $salud, $idBatalla, $idPersonaje, $idUsuario)";
            $this->consultarBaseDatos($consultaInterior);            
        }
        
        $consulta = "select iniciativa, idPersonaje, idUsuario from BatallasEstadisticas where idBatalla = $idBatalla order by iniciativa asc";
        $respuesta = $this->consultarBaseDatos($consulta);

        foreach ($respuesta as $key => $value) {

            $primerPersonaje = $value["idPersonaje"];
            $primerUsuario = $value["idUsuario"];
        };
        
        $consulta = "insert into Turnos (estado, numero, idBatalla, idPersonaje, idUsuario) values ('VIGENTE', 1, $idBatalla, $primerPersonaje[0], $primerUsuario[0])";        
        $this->consultarBaseDatos($consulta); 
        echo "Desafío aceptado.";        
    }
    
    function buscarDesafio($nuevoValor) {

        $idUsuario2 = $nuevoValor->idUsuario;
        $consulta = "select id, idUsuario1, colorUsuario1, fecha from Desafios where idUsuario2 = $idUsuario2 and estado = 'VIGENTE'";
        $respuesta = $this->consultarBaseDatos($consulta);
        $idDesafio = 0;
        $idUsuario1 = 0;
        $nombreUsuario1 = "";
        $colorUsuario1 = "";
        $fecha = "";

        if (mysqli_num_rows($respuesta) > 0) {

            foreach ($respuesta as $key => $value) {

                $idDesafio = $value["id"];
                $idUsuario1 = $value["idUsuario1"];
                $colorUsuario1 = $value["colorUsuario1"];
                $fecha = $value["fecha"];
            }

            $consulta = "select nombre from Usuarios where id = $idUsuario1";
            $respuesta = $this->consultarBaseDatos($consulta);

            foreach ($respuesta as $key => $value) {

                $nombreUsuario1 = $value["nombre"];
            }

            $jsonRespuesta[] = array(
                "idDesafio" => $idDesafio,
                "idUsuario1" => $idUsuario1,
                "nombreUsuario1" => $nombreUsuario1,
                "colorUsuario1" => $colorUsuario1,
                "fecha" => $fecha
            );

            $respuestaDesafio = json_encode($jsonRespuesta);
            echo $respuestaDesafio;
            
        } else {

            echo "Sin desafios vigentes.";
        }
    }
}
