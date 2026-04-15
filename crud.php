<?php
include 'conexion.php';
class crud{
    public static function listar(){
        $objCon = new conexion;
        $conexion = $objCon->conectar();
        if($conexion){
            $sql = "SELECT * FROM AUTOR";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data);
        }else{
            echo json_encode ([]);
        }
    }

    public static function listarNombre(){
        $objCon = new conexion;
        $conn = $objCon->conectar();
        $apellido = $_GET['apellido'] ?? ''; 
        if($conn){
            $sql = "SELECT * FROM AUTOR WHERE APELLIDO LIKE ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(["%$apellido%"]);
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
    }

    public static function insertarAutores(){
        $objCon = new conexion;
        $conn = $objCon->conectar();
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        if($conn){
            $sql = "INSERT INTO AUTOR VALUES ('$id', '$nombre', '$apellido', '$correo')";
            $result = $conn->prepare($sql);
            $result->execute();
            echo json_encode(['message' => 'Correcto']);
        }else{
            echo json_encode([]);
        }
    }

    public static function borrarAutores(){
        $objCon = new conexion;
        $conn = $objCon->conectar();
        $id = $_POST['id'] ?? null;
        if($conn){
            $sql = "DELETE FROM AUTOR WHERE ID='$id'";
            $result = $conn->prepare($sql);
            $result->execute();
            echo json_encode(['message' => 'Correcto']);
        }else{
            echo json_encode([]);
        }
    }

    public static function ActualizarAutores() {
        $objCon = new conexion;
        $conn = $objCon->conectar();
        
        $id = $_POST['id'] ?? null;
        $nombre = $_POST['nombre'] ?? null;
        $apellido = $_POST['apellido'] ?? null;
        $correo = $_POST['correo'] ?? null;

        if($conn && $id){
            $sql = "UPDATE AUTOR SET NOMBRE=?, APELLIDO=?, CORREO=? WHERE ID=?";
            $result = $conn->prepare($sql);
            $result->execute([$nombre, $apellido, $correo, $id]);
            echo json_encode(['message' => 'Correcto']);
        } else {
            echo json_encode(['message' => 'Error: Datos incompletos']);
        }
    }
}