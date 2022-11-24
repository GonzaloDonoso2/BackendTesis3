<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

if ($_SERVER["REQUEST_METHOD"] === "DELETE" | $_SERVER["REQUEST_METHOD"] === "GET" | $_SERVER["REQUEST_METHOD"] === "POST" | $_SERVER["REQUEST_METHOD"] === "PUT") {

    $ruta = $_SERVER["PATH_INFO"];
    $metodo = $_SERVER["REQUEST_METHOD"];
    $parametro = explode("=", $_SERVER["QUERY_STRING"]);

    if ($ruta === "/usuarios") {
        
        include "Controladores//ControladorUsuario.php";
        $controladorUsuario = new ControladorUsuario();
        $controladorUsuario->recibirSolicitud($metodo, $parametro);
        
    } elseif ($ruta === "/personajes") {

        include "Controladores//ControladorPersonaje.php";
        $controladorPersonaje = new ControladorPersonaje();
        $controladorPersonaje->recibirSolicitud($metodo, $parametro);
        
    } elseif ($ruta === "/desafios") {

        include "Controladores//ControladorDesafio.php";
        $controladorDesafio = new ControladorDesafio();
        $controladorDesafio->recibirSolicitud($metodo, $parametro);
        
    } elseif ($ruta === "/batallas") {

        include "Controladores//ControladorBatalla.php";
        $controladorBatalla = new ControladorBatalla();
        $controladorBatalla->recibirSolicitud($metodo, $parametro);
    }
}