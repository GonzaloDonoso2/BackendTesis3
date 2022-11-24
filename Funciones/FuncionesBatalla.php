<?php

include "Conectores//ConectorBaseDatos.php";

class FuncionesBatalla extends ConectorBaseDatos {
    
    function iniciarBatalla ($nuevoValor) {
        
        $idDesafio = $nuevoValor->id;
        $jsonRespuesta = array();
        $consulta = "select id from Batallas where idDesafio = $idDesafio";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $idBatalla = $value["id"];
        }
        
        $jsonRespuesta[] = array(
            
            "idBatalla" => $idBatalla
        );
        
        $consulta = "select colorUsuario1, colorUsuario2, idUsuario1, idUsuario2 from Desafios where id = $idDesafio";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {

            $colorUsuario1 = $value["colorUsuario1"];
            $colorUsuario2 = $value["colorUsuario2"];
            $idUsuario1 = $value["idUsuario1"];
            $idUsuario2 = $value["idUsuario2"];
        }

        $consulta = "select nombre from Usuarios where id = $idUsuario1";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $nombreUsuario1 = $value["nombre"];
        }
        
        $consulta = "select nombre from Usuarios where id = $idUsuario2";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $nombreUsuario2 = $value["nombre"];
        }
        
        $jsonRespuesta[] = array(
            
            "usuario1" => [        
                "colorUsuario1" => $colorUsuario1,
                "idUsuario1" => $idUsuario1,
                "nombreUsuario1" => $nombreUsuario1
            ]
        );
        
        $jsonRespuesta[] = array(
            
            "usuario2" => [
                "colorUsuario2" => $colorUsuario2,
                "idUsuario2" => $idUsuario2,
                "nombreUsuario2" => $nombreUsuario2
            ]
        ); 
        
        $consultaExterior = "select * from BatallasEstadisticas where idBatalla = $idBatalla and idUsuario = $idUsuario1";
        $respuestaExterior = $this->consultarBaseDatos($consultaExterior);
        
        foreach ($respuestaExterior as $key => $valueExterior) {
            
            $idPersonaje = $valueExterior["idPersonaje"];            
            $alcance = $valueExterior["alcance"];
            $armadura = $valueExterior["armadura"];     
            $ataque = $valueExterior["ataque"];           
            $dano = $valueExterior["dano"];
            $defensa = $valueExterior["defensa"];
            $iniciativa = $valueExterior["iniciativa"];
            $movimiento = $valueExterior["movimiento"];
            $nombre = $valueExterior["nombre"];
            $orientacion = $valueExterior["orientacion"];
            $posicion = $valueExterior["posicion"];
            $salud = $valueExterior["salud"];
            $consultaInterior = "select idCategoria from Personajes where id = $idPersonaje";
            $respuestaInterior = $this->consultarBaseDatos($consultaInterior);
            
            foreach ($respuestaInterior as $key => $valueInterior) {
                
                $idCategoria = $valueInterior["idCategoria"];                
            };  
            
            $consultaInterior = "select nombre from Categorias where id = $idCategoria";
            $respuestaInterior = $this->consultarBaseDatos($consultaInterior);
            
            foreach ($respuestaInterior as $key => $valueInterior) {
                
                $categoria = $valueInterior["nombre"];                
            };
            
            $consultaInterior = "select alcance, descripcion, nombre from Habilidades where idCategoria = $idCategoria";
            $respuestaInterior = $this->consultarBaseDatos($consultaInterior);
            
            foreach ($respuestaInterior as $key => $valueInterior) {

                $alcanceHabilida = $valueInterior["alcance"];
                $descripcionHabilida = $valueInterior["descripcion"];
                $nombreHabilidad = $valueInterior["nombre"];
            };

            $jsonRespuesta[] = array(
                
                "personaje" => [                     
                    "idPersonaje" => $idPersonaje,                    
                    "alcance" => $alcance,
                    "alcanceHabilidad" => $alcanceHabilida,   
                    "armadura" => $armadura,
                    "ataque" => $ataque,
                    "categoria" => $categoria,
                    "dano" => $dano,
                    "defensa" => $defensa,
                    "descripcionHabilidad" => $descripcionHabilida,
                    "iniciativa" => $iniciativa,
                    "movimiento" => $movimiento,
                    "nombre" => $nombre,
                    "nombreHabilidad" => $nombreHabilidad,
                    "orientacion" => $orientacion,
                    "posicion" => $posicion,
                    "salud" => $salud,
                    "idUsuario" => $idUsuario1
                ]                
            );
        }
        
        $consultaExterior = "select * from BatallasEstadisticas where idBatalla = $idBatalla and idUsuario = $idUsuario2";
        $respuestaExterior = $this->consultarBaseDatos($consultaExterior);
        
        foreach ($respuestaExterior as $key => $valueExterior) {
            
            $idPersonaje = $valueExterior["idPersonaje"];            
            $alcance = $valueExterior["alcance"];
            $armadura = $valueExterior["armadura"];     
            $ataque = $valueExterior["ataque"];           
            $dano = $valueExterior["dano"];
            $defensa = $valueExterior["defensa"];
            $iniciativa = $valueExterior["iniciativa"];
            $movimiento = $valueExterior["movimiento"];
            $nombre = $valueExterior["nombre"];
            $orientacion = $valueExterior["orientacion"];
            $posicion = $valueExterior["posicion"];
            $salud = $valueExterior["salud"];
            $consultaInterior = "select idCategoria from Personajes where id = $idPersonaje";
            $respuestaInterior = $this->consultarBaseDatos($consultaInterior);
            
            foreach ($respuestaInterior as $key => $valueInterior) {
                
                $idCategoria = $valueInterior["idCategoria"];                
            };  
            
            $consultaInterior = "select nombre from Categorias where id = $idCategoria";
            $respuestaInterior = $this->consultarBaseDatos($consultaInterior);
            
            foreach ($respuestaInterior as $key => $valueInterior) {
                
                $categoria = $valueInterior["nombre"];                
            };
            
            $consultaInterior = "select alcance, descripcion, nombre from Habilidades where idCategoria = $idCategoria";
            $respuestaInterior = $this->consultarBaseDatos($consultaInterior);
            
            foreach ($respuestaInterior as $key => $valueInterior) {

                $alcanceHabilida = $valueInterior["alcance"];
                $descripcionHabilida = $valueInterior["descripcion"];
                $nombreHabilidad = $valueInterior["nombre"];
            };

            $jsonRespuesta[] = array(
                
                "personaje" => [
                    "idPersonaje" => $idPersonaje,                    
                    "alcance" => $alcance,
                    "alcanceHabilidad" => $alcanceHabilida,   
                    "armadura" => $armadura,
                    "ataque" => $ataque,
                    "categoria" => $categoria,
                    "dano" => $dano,
                    "defensa" => $defensa,
                    "descripcionHabilidad" => $descripcionHabilida,
                    "iniciativa" => $iniciativa,
                    "movimiento" => $movimiento,
                    "nombre" => $nombre,
                    "nombreHabilidad" => $nombreHabilidad,
                    "orientacion" => $orientacion,
                    "posicion" => $posicion,
                    "salud" => $salud,
                    "idUsuario" => $idUsuario2
                ]                
            );
        }

        $respuestaBatalla = json_encode($jsonRespuesta);        
        echo $respuestaBatalla;   
    }
    
    function buscarTurno($nuevoValor) {

        $idBatalla = $nuevoValor->id;
        $jsonRespuesta = array();
        $consultaExterior = "select estado from Batallas where id = $idBatalla and estado = 'VIGENTE'";
        $respuestaExterior = $this->consultarBaseDatos($consultaExterior);
                
        if (mysqli_num_rows($respuestaExterior) > 0) {

            $consultaInterior = "select id, numero, idPersonaje, idUsuario from Turnos where idBatalla = $idBatalla and estado = 'VIGENTE'";
            $respuestaInterior = $this->consultarBaseDatos($consultaInterior);

            foreach ($respuestaInterior as $key => $value) {

                $idTurno = $value["id"];
                $numeroTurno = $value["numero"];
                $idPersonaje = $value["idPersonaje"];
                $idUsuario = $value["idUsuario"];
            }
            
            $consultaInterior = "select id from Ataques where idTurno = $idTurno and estado = 'VIGENTE'";
            $respuestaInterior = $this->consultarBaseDatos($consultaInterior);
            
            if (mysqli_num_rows($respuestaInterior) > 0) { 
                
                $idAtaque = $value["id"];  
                
            } else {
                
                $idAtaque = "SIN ATAQUES";                 
            }      
            
            $consultaInterior = "select id from Movimientos where idTurno = $idTurno and estado = 'VIGENTE'";
            $respuestaInterior = $this->consultarBaseDatos($consultaInterior);
            
            if (mysqli_num_rows($respuestaInterior) > 0) { 
                
                $idMovimiento = $value["id"];  
                
            } else {
                
                $idMovimiento = "SIN MOVIMIENTO";                 
            }      

            $jsonRespuesta[] = array(
                
                "idTurno" => $idTurno,
                "numeroTurno" => $numeroTurno,                
                "idAtaque" => $idAtaque,
                "idMovimiento" => $idMovimiento,
                "idPersonaje" => $idPersonaje,
                "idUsuario" => $idUsuario
            );

            $respuestaBatalla = json_encode($jsonRespuesta);
            
        } else {
            
            $respuestaBatalla = "La batalla ha terminado.";            
        }
        
        echo $respuestaBatalla;
    }
    
    function registrarAtaque($nuevoValor) {
        
        $posicion = $nuevoValor->posicion;        
        $idBatalla = $nuevoValor->idBatalla;
        $idPersonaje1 = $nuevoValor->idPersonaje1;
        $idPersonaje2 = $nuevoValor->idPersonaje2;
        $idUsuario1 = $nuevoValor->idUsuario1;
        $idUsuario2 = $nuevoValor->idUsuario2;
        $idTurno = $nuevoValor->idTurno;
        $consulta = "select ataque, dano from BatallasEstadisticas where idBatalla = $idBatalla and idPersonaje = $idPersonaje1 and idUsuario = $idUsuario1";
        $respuesta = $this->consultarBaseDatos($consulta);

        foreach ($respuesta as $key => $value) {

            $provisorioAtaque = $value["ataque"];
            $provisorioDano = $value["dano"];
        }

       $ataque = random_int(1, $provisorioAtaque);

        $consulta = "select armadura, defensa, salud from BatallasEstadisticas where idBatalla = $idBatalla and idPersonaje = $idPersonaje2 and idUsuario = $idUsuario2";
        $respuesta = $this->consultarBaseDatos($consulta);

        foreach ($respuesta as $key => $value) {
            
            $armadura = $value["armadura"];
            $provisoriaDefensa = $value["defensa"];            
            $salud = $value["salud"];
        }

        $defensa = random_int(1, $provisoriaDefensa);     

        if ($ataque > $defensa) {
            
            $dano = random_int(1, $provisorioDano);

            if ($armadura > 0) {

                if (($dano / 2) === 0) {

                    $danoArmadura = ($dano / 2);
                    $danoPersonaje = ($dano / 2);
                    
                } else {

                    if ($dano === 1) {

                        $danoArmadura = 1;
                        $danoPersonaje = 0;
                        
                    } else {

                        $provisorioDano = ($dano - 1);
                        $danoArmadura = (($provisorioDano / 2) + 1);
                        $danoPersonaje = ($provisorioDano / 2);
                    }
                }

                $nuevaArmadura = ($armadura - $danoArmadura);

                if ($nuevaArmadura < 1) {

                    $nuevaArmadura = 0;
                }
                
                $nuevaSalud = ($salud - $danoPersonaje);

                if ($salud < 1) {
                    
                    $nuevaSalud = 0;                    
                }
                
                $consulta = "update BatallasEstadisticas set armadura = $nuevaArmadura, salud = $nuevaSalud where idBatalla = $idBatalla and idPersonaje = $idPersonaje2 and idUsuario = $idUsuario2";
                $this->consultarBaseDatos($consulta);
                $consulta = "insert into Ataques (ataque, defensa, danoArmadura, danoPersonaje, estado, posicion, resultado, idPersonaje1, idPersonaje2, idTurno, idUsuario1, idUsuario2) values ($ataque, $defensa, $danoArmadura, $danoPersonaje, 'VIGENTE', '$posicion', 'ATAQUE EXISTOSO.', $idPersonaje1, $idPersonaje2, $idTurno, $idUsuario1, $idUsuario2)";
                $this->consultarBaseDatos($consulta);
                
            } else {     

                $nuevaSalud = ($salud - $dano);

                if ($nuevaSalud < 1) {
                    
                    $nuevaSalud = 0;                    
                }
                
                $consulta = "update BatallasEstadisticas set salud = $nuevaSalud where idBatalla = $idBatalla and idPersonaje = $idPersonaje2 and idUsuario = $idUsuario2";
                $this->consultarBaseDatos($consulta);
                $consulta = "insert into Ataques (ataque, defensa, danoArmadura, danoPersonaje, estado, posicion, resultado, idPersonaje1, idPersonaje2, idTurno, idUsuario1, idUsuario2) values ($ataque, $defensa, 0, $dano, 'VIGENTE', '$posicion', 'ATAQUE EXISTOSO.', $idPersonaje1, $idPersonaje2, $idTurno, $idUsuario1, $idUsuario2)";
                $this->consultarBaseDatos($consulta);
            }
            
        } else {
            
            $consulta = "insert into Ataques (ataque, defensa, danoArmadura, danoPersonaje, estado, posicion, resultado, idPersonaje1, idPersonaje2, idTurno, idUsuario1, idUsuario2) values ($ataque, $defensa, 0, 0, 'VIGENTE', '$posicion', 'ATAQUE BLOQUEADO O ESQUIVADO POR EL DEFENSOR.', $idPersonaje1, $idPersonaje2, $idTurno, $idUsuario1, $idUsuario2)";
            $this->consultarBaseDatos($consulta);
        }
        
        $respuestaBatalla = "Ataque registrado.";
        echo $respuestaBatalla;
    }
    
    function obtenerAtaque($nuevoValor) {
        
        $idTurno = $nuevoValor->idTurno;  
        $jsonRespuesta = array();
        $consulta = "select id, ataque, danoArmadura, danoPersonaje, defensa, posicion, resultado, idPersonaje1, idPersonaje2, idUsuario1, idUsuario2 from Ataques where estado = 'VIGENTE' and idTurno = $idTurno";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $idAtaque = $value["id"];            
            $ataque = $value["ataque"];
            $danoArmadura = $value["danoArmadura"];
            $danoPersonaje = $value["danoPersonaje"];
            $defensa = $value["defensa"];
            $posicion = $value["posicion"];
            $resultado = $value["resultado"];
            $idPersonaje1 = $value["idPersonaje1"];
            $idPersonaje2 = $value["idPersonaje2"];
            $idUsuario1 = $value["idUsuario1"];
            $idUsuario2 = $value["idUsuario2"];
        }

        $jsonRespuesta[] = array(
            
            "idAtaque" => $idAtaque,
            "ataque" => $ataque,
            "danoArmadura" => $danoArmadura,
            "danoPersonaje" => $danoPersonaje,
            "defensa" => $defensa,
            "posicion" => $posicion,
            "resultado" => $resultado,
            "idPersonaje1" => $idPersonaje1,
            "idPersonaje2" => $idPersonaje2,
            "idUsuario1" => $idUsuario1,
            "idUsuario2" => $idUsuario2
        );

        $respuestaBatalla = json_encode($jsonRespuesta);
        echo $respuestaBatalla;
    }
    
    function terminarAtaque($nuevoValor) {
        
        $idAtaque = $nuevoValor->idAtaque;
        $consulta = "update Ataques set estado = 'TERMINADO' where id = $idAtaque";
        $this->consultarBaseDatos($consulta);
        $respuestaBatalla = "Ataque terminado.";
        echo $respuestaBatalla;
    }
    
    function registrarMovimiento($nuevoValor) {
        
        $orientacion = $nuevoValor->orientacion;            
        $posicion = $nuevoValor->posicion;          
        $idPersonaje = $nuevoValor->idPersonaje;
        $idBatalla = $nuevoValor->idBatalla;
        $idTurno = $nuevoValor->idTurno;
        $idUsuario = $nuevoValor->idUsuario;     
        $consulta = "insert into Movimientos (estado, orientacion, posicion, idPersonaje, idTurno, idUsuario) values ('VIGENTE', '$orientacion', '$posicion', $idPersonaje, $idTurno, $idUsuario)";
        $this->consultarBaseDatos($consulta);
        $consulta = "update BatallasEstadisticas set orientacion = '$orientacion', posicion = '$posicion' where idBatalla = $idBatalla and idPersonaje = $idPersonaje and idUsuario = $idUsuario";
        $this->consultarBaseDatos($consulta);
        $respuestaBatalla = "Movimiento registrado.";
        echo $respuestaBatalla;
    }
    
    function obtenerMovimiento($nuevoValor) {
        
        $idTurno = $nuevoValor->idTurno;
        $jsonRespuesta = array();
        $consulta = "select id, orientacion, posicion, orientacion, idPersonaje, idTurno, idUsuario from Movimientos where estado = 'VIGENTE' and idTurno = $idTurno";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $idMovimiento = $value["id"];
            $orientacion = $value["orientacion"];
            $posicion = $value["posicion"];
            $idPersonaje = $value["idPersonaje"];
            $idTurno = $value["idTurno"];
            $idUsuario = $value["idUsuario"];
        }

        $jsonRespuesta[] = array(
            
            "idMovimiento" => $idMovimiento,
            "orientacion" => $orientacion,    
            "posicion" => $posicion,
            "idPersonaje" => $idPersonaje,
            "idTurno" => $idTurno,
            "idUsuario" => $idUsuario
        );

        $respuestaBatalla = json_encode($jsonRespuesta);
        echo $respuestaBatalla;
    }
    
    function terminarMovimiento($nuevoValor) {
        
        $idMovimiento = $nuevoValor->idMovimiento;
        $consulta = "update Movimientos set estado = 'TERMINADO' where id = $idMovimiento";
        $this->consultarBaseDatos($consulta);
        $respuestaBatalla = "Movimiento terminado.";
        echo $respuestaBatalla;
    }
    
    function terminarTurno($nuevoValor) {   
        
        $numeroTurno = $nuevoValor->numeroTurno;            
        $idBatalla = $nuevoValor->idBatalla;
        $idDesafio = $nuevoValor->idDesafio;   
        $idPersonaje = $nuevoValor->idPersonaje;
        $idUsuario = $nuevoValor->idUsuario;
        $idTurno = $nuevoValor->idTurno;        
        $consulta = "select idUsuario1, idUsuario2 from Desafios where id = $idDesafio";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $idUsuario1 = $value["idUsuario1"];
            $idUsuario2 = $value["idUsuario2"];
        }
        
        $batallaContinua1 = false;
        $batallaContinua2 = false;        
        $consultaExterior = "select idPersonaje from BatallasEstadisticas where idBatalla = $idBatalla and idUsuario = $idUsuario1 and salud > 0";
        $respuestaExterior = $this->consultarBaseDatos($consultaExterior);
        
        if (mysqli_num_rows($respuestaExterior) === 0) {
            
            $consultaInterior = "update Batallas set estado = 'TERMINADA' where id = $idBatalla";
            $this->consultarBaseDatos($consultaInterior);
            $consultaInterior = "update Turnos set estado = 'TERMINADO' where idBatalla = $idBatalla";
            $this->consultarBaseDatos($consultaInterior);
            $consultaInterior = "insert into BatallasResultados (resultado, idBatalla, idUsuario) values ('DERROTA', $idBatalla, $idUsuario1)";
            $this->consultarBaseDatos($consultaInterior);
            $consultaInterior = "insert into BatallasResultados (resultado, idBatalla, idUsuario) values ('VICTORIA', $idBatalla, $idUsuario2)";
            $this->consultarBaseDatos($consultaInterior);
            
        } else {
            
            $batallaContinua1 = true;            
        }
        
        $consultaExterior = "select idPersonaje from BatallasEstadisticas where idBatalla = $idBatalla and idUsuario = $idUsuario2 and salud > 0";
        $respuesta = $this->consultarBaseDatos($consultaExterior);
        
        if (mysqli_num_rows($respuesta) === 0) {
            
            $consultaInterior = "update Batallas set estado = 'TERMINADA' where id = $idBatalla";
            $this->consultarBaseDatos($consultaInterior);
            $consultaInterior = "update Turnos set estado = 'TERMINADO' where idBatalla = $idBatalla";
            $this->consultarBaseDatos($consultaInterior);
            $consultaInterior = "insert into BatallasResultados (resultado, idBatalla, idUsuario) values ('DERROTA', $idBatalla, $idUsuario2)";
            $this->consultarBaseDatos($consultaInterior);
            $consultaInterior = "insert into BatallasResultados (resultado, idBatalla, idUsuario) values ('VICTORIA', $idBatalla, $idUsuario1)";
            $this->consultarBaseDatos($consultaInterior);
            
        } else {
            
            $batallaContinua2 = true;
        }              
        
        if ($batallaContinua1 === true && $batallaContinua2 === true) {

            $consulta = "update Turnos set estado = 'TERMINADO' where id = $idTurno";
            $this->consultarBaseDatos($consulta);
            $consulta = "select idPersonaje, idUsuario from BatallasEstadisticas where idBatalla = $idBatalla and salud > 0";
            $respuesta = $this->consultarBaseDatos($consulta);

            $listaOrdenPersonajes = array();
            
            foreach ($respuesta as $key => $value) {
                
                $provisoriaIdPersonaje = $value["idPersonaje"];
                $provisoriaIdUsuario = $value["idUsuario"];                
                $listaOrdenPersonajes[] = array( 
                    "idPersonaje" => $provisoriaIdPersonaje,
                    "idUsuario" => $provisoriaIdUsuario
                );
            }

            $idSiguintePersonaje = 0;
            $idSiguinteUsuario = 0;
            $numeroPersonajes = (count($listaOrdenPersonajes) - 1);

            for ($i = 0; $i < count($listaOrdenPersonajes); $i++) {

                if ($listaOrdenPersonajes[$i]["idPersonaje"] === $idPersonaje & $listaOrdenPersonajes[$i]["idUsuario"] === $idUsuario) {

                    if ($i === $numeroPersonajes) {

                        $idSiguintePersonaje = $listaOrdenPersonajes[0]["idPersonaje"];
                        $idSiguinteUsuario = $listaOrdenPersonajes[0]["idUsuario"];
                        
                    } else {

                        $idSiguintePersonaje = $listaOrdenPersonajes[($i + 1)]["idPersonaje"];
                        $idSiguinteUsuario = $listaOrdenPersonajes[($i + 1)]["idUsuario"];
                    }
                }
            }

            $siguienteNumeroTurno = ($numeroTurno + 1);
            $consulta = "insert into Turnos (numero, estado, idBatalla, idPersonaje, idUsuario) values ($siguienteNumeroTurno, 'VIGENTE', $idBatalla, $idSiguintePersonaje, $idSiguinteUsuario)";
            $this->consultarBaseDatos($consulta);
            $respuestaBatalla = "Turno terminado.";
            echo $respuestaBatalla;
        }
    }

    function terminarBatalla($nuevoValor) {

        $idBatalla = $nuevoValor->idBatalla;
        $idUsuario = $nuevoValor->idUsuario;        
        $consulta = "select idDesafio from Batallas where id = $idBatalla";
        $respuesta = $this->consultarBaseDatos($consulta);

        foreach ($respuesta as $key => $value) {

            $idDesafio = $value["idDesafio"];
        }
        
        $consulta = "select idUsuario1, idUsuario2 from Desafios where id = $idDesafio";
        $respuesta = $this->consultarBaseDatos($consulta);

        foreach ($respuesta as $key => $value) {

            $idUsuario1 = $value["idUsuario1"];
            $idUsuario2 = $value["idUsuario2"];
        }
        
        $consulta = "update Batallas set estado = 'TERMINADA' where id = $idBatalla";
        $this->consultarBaseDatos($consulta);
        
        $consulta = "update Turnos set estado = 'TERMINADO' where idBatalla = $idBatalla";
        $this->consultarBaseDatos($consulta);
        
        if ($idUsuario === $idUsuario1) {

            $consulta = "insert into BatallasResultados (resultado, idBatalla, idUsuario) values ('DERROTA', $idBatalla, $idUsuario1)";
            $this->consultarBaseDatos($consulta);
            $consulta = "insert into BatallasResultados (resultado, idBatalla, idUsuario) values ('VICTORIA', $idBatalla, $idUsuario2)";
            $this->consultarBaseDatos($consulta);
            
        } else if ($idUsuario === $idUsuario2) {
            
            $consulta = "insert into BatallasResultados (resultado, idBatalla, idUsuario) values ('DERROTA', $idBatalla, $idUsuario2)";
            $this->consultarBaseDatos($consulta);
            $consulta = "insert into BatallasResultados (resultado, idBatalla, idUsuario) values ('VICTORIA', $idBatalla, $idUsuario1)";
            $this->consultarBaseDatos($consulta);          
        }
        
        $respuestaBatalla = "La batalla ha terminado.";
        echo $respuestaBatalla;
    }
    
    function obtenerResultadoBatalla($nuevoValor) {

        $idBatalla = $nuevoValor->idBatalla;
        $idUsuario = $nuevoValor->idUsuario;   
        $jsonRespuesta = array();
        $consulta = "select resultado from BatallasResultados where idBatalla = $idBatalla and idUsuario = $idUsuario";
        $respuesta = $this->consultarBaseDatos($consulta);

        foreach ($respuesta as $key => $value) {

            $resultadoBatalla = $value["resultado"];        
        }
        
        $jsonRespuesta[] = array(
            
            "resultadoBatalla" => $resultadoBatalla
        );
        
        $respuestaBatalla = json_encode($jsonRespuesta);        
        echo $respuestaBatalla;
    }
    
    function obtenerResultadosBatallas($nuevoValor) {
        
        $idUsuario = $nuevoValor->idUsuario;   
        $jsonRespuesta = array();
        $consulta = "select resultado from BatallasResultados where idUsuario = $idUsuario";
        $respuesta = $this->consultarBaseDatos($consulta);

        foreach ($respuesta as $key => $value) {

            $resultadoBatalla = $value["resultado"];
            
            $jsonRespuesta[] = array(
            
                "resultadoBatalla" => $resultadoBatalla
            );
        } 
        
        $respuestaBatalla = json_encode($jsonRespuesta);        
        echo $respuestaBatalla;
    }
}
