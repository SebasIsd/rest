<?php
include_once 'crud.php';
if ($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $datos_externos);
    $_POST = $datos_externos;
}

$opc = $_SERVER['REQUEST_METHOD'];
switch($opc){
    case 'GET':
        if (isset($_GET['apellido']) && $_GET['apellido'] != '') {
            crud::listarNombre();
        }else{
            crud::listar();
        }
        break;
    case 'POST':
        crud::insertarAutores();
        break;
    case 'PUT':
        crud::ActualizarAutores();
        break;
    case 'DELETE':
        crud::borrarAutores();
        break;
}