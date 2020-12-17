<?php
session_start();
require_once 'DataBase.php';
try {
    if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contrasena']) &&
            isset($_POST['apodo']) && isset($_POST['telefono']) && !empty($_POST['nombre']) && !empty($_POST['correo']) && 
            !empty($_POST['contrasena']) && !empty($_POST['apodo']) && !empty($_POST['telefono'])  ){

        $sql2="SELECT `ID_USUARIO` FROM gendy.usuario";        

        $num=$DB->prepare($sql2); 
        $num->execute();
        $numero=$num->rowCount();
        $numero=$numero+1;        

        $sql1 = "INSERT INTO gendy.usuario(`ID_USUARIO`,`NOMBRE_USUARIO`, `APODO_USUARIO`, `CONTRASENA`, `CORREO_ELECTRONICO`, 
        `TELEFONO`,`PUNTAJE_USUARIO`) VALUES (:id,:nombre,:apodo,:contrasena,:correo,:telefono,:puntaje)";

        $datos = $DB->prepare($sql1);

        $datos->execute(array(
            
            ':id'=> $numero, 
            ':nombre' => $_POST['nombre'], 
            ':apodo' => $_POST['apodo'],
            ':contrasena' => $_POST['contrasena'],
            ':correo' => $_POST['correo'], 
            ':puntaje' => 5,
            ':telefono' => $_POST['telefono']));

        header('Location: IngresarCliente.php');
    }



} catch (Exception $ex) {
    echo $e->getMessage();
}
?>


<html>
    <head>
        <meta charset="utf-8">
        <title>Gendy | Registro Cliente</title>
        <link rel="stylesheet" href="css/ajustesRegistro.css">
    </head>
    <body>

    <form action="index.php">
            <input class="ret1" type="image" src="css/Imagenes/retorno.png" name='ret' onclick="" />
    </form>

    <div class="botones">
        <img class="Logo" src="css/Imagenes/-_Gendy azul.png" />
            <br><br>
            <h1>Registrar Cliente</h1>
            <form method="post">
                <label>Nombre Completo:</label>
                <input type="text" name="nombre">  
                <label>Apodo:</label>
                <input type="text" name="apodo">
                <label>Correo Electronico:</label>
                <input type="email" name="correo">
                <label>Contraseña:</label>
                <input type="password" name="contrasena">
                <label>Telefono:</label>
                <input type="text" name="telefono">
                <div class="BMod">
                    <input type="submit" value="Registrar" />
                </div>
            </form>

        </div>
    </body>
</html> 