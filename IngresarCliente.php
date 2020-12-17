<?php
require_once 'DataBase.php';
session_start();
if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
    unset($_SESSION['user']);
    $sql = "SELECT * FROM gendy.usuario WHERE CORREO_ELECTRONICO=:correo and CONTRASENA=:contrasena ";
    $datos = $DB->prepare($sql);
    $datos->execute(array(
        ':correo' => $_POST['correo'], 
        ':contrasena' => $_POST['contrasena']));

    $data= $datos->fetch(PDO::FETCH_ASSOC);
    $numero = $datos->rowCount();
    if ($numero == 1) {
        $_SESSION['user'] = $data['ID_USUARIO'];
        $_SESSION["success"] = "Logged in.";
        header('Location: Gendy-Cliente/MenuCliente.php');
        return;
    } else {
        $_SESSION["error"] = "Datos Incorrectos";
    }
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Gendy | Ingresar Cliente</title>
        <link rel="stylesheet" href="css/ingresar.css">
    </head>
    <body>
        





        <form action="index.php">
            <input class="ret" type="image" src="css/Imagenes/retorno.png" name='ret' onclick="" />
        </form>

        <div class="ingresar_Panel">

            <img class="Logo" src="css/Imagenes/-_Gendy azul.png" />
            <br><br>
            <!-- Titulo de la caja -->
            <h1>Ingreso de cliente</h1>
            <?php
            if (isset($_SESSION["error"])) {
                echo('<label style="color:red">' . $_SESSION["error"] . "</label>\n");
                unset($_SESSION["error"]);
            }
            ?>
            <!-- recoge los datos para procesar -->
            <form method="post">
                <!-- Datos correo -->
                <label for="correo">Correo Electrónico:</label>                    
                <input type="email" name="correo" value="">

                <!-- Datos Contraseña -->
                <label for="contrasena">Contraseña:</label>  
                <input type="password" name="contrasena" value="">

                <!-- boton Ingresar -->
                <input type="submit" value="Ingresar" />


                <a href="RegistrarUsuarioCliente.php">Registro inicial</a><br>
            </form>


        </div>
    </body>
</html> 
