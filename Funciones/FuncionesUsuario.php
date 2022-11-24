<?php

include "Conectores//ConectorBaseDatos.php";

class FuncionesUsuario extends ConectorBaseDatos {
    
    function verificarNombreUsuario1($nuevoValor) {
        
        $nombreUsuario = $nuevoValor->nombre;  
        $consulta = "select nombre from Usuarios where nombre = '$nombreUsuario'";
        $respuesta = $this->consultarBaseDatos($consulta);

        if (mysqli_num_rows($respuesta) > 0) {
            
            echo "Este nombre ya está registrado.";
            
        } else {

            echo "Este nombre no está registrado.";
        }
    }
    
    function verificarCorreoElectronicoUsuario1($nuevoValor) {
        
        $correoElectronicoUsuario = $nuevoValor->correoElectronico;  
        $consulta = "select correoElectronico from Usuarios where correoElectronico = '$correoElectronicoUsuario'";
        $respuesta = $this->consultarBaseDatos($consulta);

        if (mysqli_num_rows($respuesta) > 0) {
            
            echo "Este correo electrónico ya está registrado.";
            
        } else {

            echo "Este correo electrónico no está registrado.";
        }
    }
    
    function registrarUsuario ($nuevoValor) {
        
        $nombreUsuario = $nuevoValor->nombre;
        $correoElectronicoUsuario = $nuevoValor->correoElectronico;
        $contrasenaUsuario = $nuevoValor->contrasena;
        $consulta = "insert into Usuarios (nombre, correoElectronico, contrasena, estado, idPerfil) values ('$nombreUsuario', '$correoElectronicoUsuario', '$contrasenaUsuario', 'VIGENTE', 2)";        
        $this->consultarBaseDatos($consulta);
        $consulta = "select id from Usuarios where nombre = '$nombreUsuario' and correoElectronico = '$correoElectronicoUsuario' and contrasena = '$contrasenaUsuario'";        
        $respuesta = $this->consultarBaseDatos($consulta); 
        
        foreach ($respuesta as $key => $value) {
            
            $idUsuario = $value["id"];        
        }
        
        $consulta = "insert into PersonajesUsuarios (estado, idPersonaje, idUsuario) values ('ADQUIRIDO Y VIGENTE', 1, $idUsuario)";        
        $this->consultarBaseDatos($consulta);
        $consulta = "insert into PersonajesUsuarios (estado, idPersonaje, idUsuario) values ('ADQUIRIDO Y VIGENTE', 2, $idUsuario)";        
        $this->consultarBaseDatos($consulta);
        $consulta = "insert into PersonajesUsuarios (estado, idPersonaje, idUsuario) values ('ADQUIRIDO Y VIGENTE', 3, $idUsuario)";        
        $this->consultarBaseDatos($consulta);
        $consulta = "insert into PersonajesUsuarios (estado, idPersonaje, idUsuario) values ('ADQUIRIDO Y VIGENTE', 4, $idUsuario)";        
        $this->consultarBaseDatos($consulta);
        echo "El usuario fue registrado de manera exitosa.";
    }  
    
    function iniciarSesion ($nuevoValor) {        
       
        $correoElectronico = $nuevoValor->correoElectronico;
        $contrasena = $nuevoValor->contrasena;
        $consulta = "select id, nombre from Usuarios where correoElectronico = '$correoElectronico' and contrasena = '$contrasena' and estado = 'VIGENTE'";
        $respuesta = $this->consultarBaseDatos($consulta);

        if (mysqli_num_rows($respuesta) > 0) {

            foreach ($respuesta as $key => $value) {

                $id = $value["id"];
                $nombre = $value["nombre"];
            }

            $jsonRespuesta[] = array(
                
                "id" => $id,
                "nombre" => $nombre
            );
            $respuestaUsuario = json_encode($jsonRespuesta);            
            echo $respuestaUsuario;
            
        } else {

            echo "Este usuario no está registrado.";
        }
    } 
    
    function obtenerUsuario($nuevoValor) {

        $idUsuario = $nuevoValor->id;
        $consulta = "select nombre, correoElectronico, contrasena from Usuarios where id = $idUsuario";
        $respuesta = $this->consultarBaseDatos($consulta);

        foreach ($respuesta as $key => $value) {
            
            $nombre = $value["nombre"];
            $correoElectronico = $value["correoElectronico"];
            $contrasena = $value["contrasena"];

            $jsonRespuesta[] = array(
                
                "nombre" => $nombre,
                "correoElectronico" => $correoElectronico,
                "contrasena" => $contrasena
            );
        }

        $respuestaUsuario = json_encode($jsonRespuesta);        
        echo $respuestaUsuario;
    }

    function verificarNombreUsuario2($nuevoValor) {
        
        $idUsuario = $nuevoValor->id;        
        $nombreUsuario = $nuevoValor->nombre;  
        $consulta = "select nombre from Usuarios where nombre = '$nombreUsuario' and id != $idUsuario";
        $respuesta = $this->consultarBaseDatos($consulta);

        if (mysqli_num_rows($respuesta) > 0) {
            
            echo "Este nombre ya está registrado.";
            
        } else {

            echo "Este nombre no está registrado.";
        }
    }
    
    function verificarCorreoElectronicoUsuario2($nuevoValor) {
        
        $idUsuario = $nuevoValor->id;         
        $correoElectronicoUsuario = $nuevoValor->correoElectronico;  
        $consulta = "select correoElectronico from Usuarios where correoElectronico = '$correoElectronicoUsuario' and id != $idUsuario";
        $respuesta = $this->consultarBaseDatos($consulta);

        if (mysqli_num_rows($respuesta) > 0) {
            
            echo "Este correo electrónico ya está registrado.";
            
        } else {

            echo "Este correo electrónico no está registrado.";
        }
    }
    
    function editarNombre ($nuevoValor) {  
        
        $id = $nuevoValor->id;    
        $nombreUsuario = $nuevoValor->nombre;   
        $consulta = "update Usuarios set nombre = '$nombreUsuario' where id = $id";        
        $this->consultarBaseDatos($consulta);        
        echo "El nombre del usuario fue editado de manera exitosa.";
    }
    
    function editarCorreoElectronico ($nuevoValor) {  
        
        $id = $nuevoValor->id;    
        $correoElectronicoUsuario= $nuevoValor->correoElectronico;   
        $consulta = "update Usuarios set correoElectronico = '$correoElectronicoUsuario' where id = $id";        
        $this->consultarBaseDatos($consulta);        
        echo "El correo electrónico del usuario fue editado de manera exitosa.";
    }
    
    function editarContrasena ($nuevoValor) {  
        
        $id = $nuevoValor->id;    
        $contrasenaUsuario = $nuevoValor->contrasena;   
        $consulta = "update Usuarios set contrasena = '$contrasenaUsuario' where id = $id";        
        $this->consultarBaseDatos($consulta);        
        echo "La contraseña del usuario fue editada de manera exitosa.";
    }
    
    function obtenerUsuarios() {
        
        $consulta = "select nombre from Usuarios where estado= 'VIGENTE' and idPerfil = 2";
        $respuesta = $this->consultarBaseDatos($consulta);

        foreach ($respuesta as $key => $value) {
            
            $nombre = $value["nombre"];

            $jsonRespuesta[] = array(
                
                "nombre" => $nombre,
            );
        }

        $respuestaUsuario = json_encode($jsonRespuesta);        
        echo $respuestaUsuario;
    }
}
