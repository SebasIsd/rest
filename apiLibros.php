<?php
if ($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $datos_externos);
    $_POST = $datos_externos;
}

include_once 'crudLibros.php';

$opc = $_SERVER['REQUEST_METHOD'];
switch($opc){
    case 'GET':
        if (isset($_GET['titulo']) && $_GET['titulo'] != '') {
            crudLibros::listarTitulo();
        }else{
            crudLibros::listar();
        }
        break;
    case 'POST':
        crudLibros::insertarLibros();
        break;
    case 'PUT':
        crudLibros::ActualizarLibros();
        break;
    case 'DELETE':
        crudLibros::borrarLibros();
        break;
}
?>