<?php
include_once 'conexion.php';
class crudLibros{
    public static function listar(){
        $objCon = new conexion;
        $conn = $objCon->conectar();
        if($conn){
            $sql = "SELECT * FROM LIBRO";
            $result = $conn->prepare($sql);
            $result->execute();
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data);
        }else{
            echo json_encode([]);
        }
    }

    public static function listarTitulo(){
        $objCon = new conexion;
        $conn = $objCon->conectar();
        $titulo = $_GET['titulo'] ?? '';
        if($conn){
            $sql = "SELECT * FROM LIBRO WHERE TITULO LIKE ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(["%$titulo%"]);
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
    }

    public static function insertarLibros(){
        $objCon = new conexion;
        $conn = $objCon->conectar();
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $anio = $_POST['anio'];
        $autor = $_POST['autor_id'];
        if($conn){
            $sql = "INSERT INTO LIBRO VALUES ('$id', '$titulo', '$anio', '$autor')";
            $result = $conn->prepare($sql);
            $result->execute();
            echo json_encode(['message' => 'Correcto']);
        }else{
            echo json_encode([]);
        }
    }

    public static function borrarLibros(){
        $objCon = new conexion;
        $conn = $objCon->conectar();
        $id = $_POST['id'] ?? null;
        if($conn){
            $sql = "DELETE FROM LIBRO WHERE ID='$id'";
            $result = $conn->prepare($sql);
            $result->execute();
            echo json_encode(['message' => 'Correcto']);
        }else{
            echo json_encode([]);
        }
    }

    public static function ActualizarLibros(){
        $objCon = new conexion;
        $conn = $objCon->conectar();
        $id = $_POST['id'] ?? null;
        $titulo = $_POST['titulo'] ?? null;
        $anio = $_POST['anio'] ?? null;
        $autor = $_POST['autor_id'] ?? null;
        if($conn){
            $sql = "UPDATE LIBRO SET  TITULO='$titulo', ANIO='$anio', AUTOR_ID='$autor' WHERE ID='$id'";
            $result = $conn->prepare($sql);
            $result->execute();
            echo json_encode(['message' => 'Correcto']);
        }else{
            echo json_encode([]);
        }
    }
}