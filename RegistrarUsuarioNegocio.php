<?php
session_start();
require_once 'DataBase.php';
try {
    if (isset($_POST['razon']) && isset($_POST['correo']) && isset($_POST['contrasena']) &&
            isset($_POST['direccion']) && isset($_POST['telefono']) && isset($_POST['localidad']) &&
            isset($_POST['apertura']) && isset($_POST['cierre']) && isset($_POST['dia_apertura']) && isset($_POST['dia_cierre']) && isset($_POST['aforo']) &&
            !empty($_POST['razon']) && !empty($_POST['correo']) && !empty($_POST['contrasena']) &&
            !empty($_POST['direccion']) && !empty($_POST['telefono']) && !empty($_POST['localidad'])&& !empty($_POST['apertura']) && !empty($_POST['cierre'])
            && !empty($_POST['dia_apertura']) && !empty($_POST['dia_cierre'])&& !empty($_POST['aforo'])) {
         
            $sql2="SELECT `ID_NEGOCIO` FROM gendy.negocio";        
            $num=$DB->prepare($sql2); 
            $num->execute();
            $numero=$num->rowCount();
            $numero=$numero+1;                

                
            $sql = "INSERT INTO gendy.negocio(`ID_NEGOCIO`, `RAZON_SOCIAL`, `CONTRASENA_NEGOCIO`, `CORREO_ELECTRONICO_NEGOCIO`, `TELEFONO_NEGOCIA`, `DIRECCION_NEGOCIO`, `LOCALIDAD`, `PUNTAJE_NEGOCIO`, `HORA_APERTURA`, `HORA_CIERRE`, `DIA_APERTURA`, `DIA_CIERRE`,`AFORO`) 
            VALUES (:id,:razon,:contrasena, :correo,:telefono,:direccion,:localidad,:puntaje,:apertura,:cierre,:dia_apertura,:dia_cierre,:aforo)";
            $datos = $DB->prepare($sql);
            $datos->execute(array(

            ':id' => $numero,
            ':razon' => $_POST['razon'],
            ':contrasena' => $_POST['contrasena'],
            ':correo' => $_POST['correo'],
            ':telefono' => $_POST['telefono'],
            ':direccion' => $_POST['direccion'],
            ':puntaje' => 5,
            ':apertura' => $_POST['apertura'],
            ':cierre' => $_POST['cierre'],
            ':localidad' => $_POST['localidad'],
            ':dia_apertura'=> $_POST['dia_apertura'],
            ':dia_cierre'=> $_POST['dia_cierre'],
            ':aforo'=> $_POST['aforo']
        
        
            ));

        header('Location: IngresarNegocio.php');
    }
} catch (Exception $ex) {
    echo $e->getMessage();
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Gendy | Registro Negocio</title>
        <link rel="stylesheet" href="css/ajustesRegistro.css">
    </head>
    <body>
        
        <form action="index.php">
            <input class="ret1" type="image" src="css/Imagenes/retorno.png" name='ret' onclick="" />
        </form>

            <div class="botones">
            <img class="Logo" src="css/Imagenes/-_Gendy azul.png" />
            <br><br>
                <h1>Registrar Negocio</h1>

                

                    <form method="post">
                        <label>Razon Social:</label>
                        <input type="text" name="razon">  
                        <label>Correo Electronico:</label>
                        <input type="email" name="correo">
                        <label>Contraseña:</label>
                        <input type="password" name="contrasena">
                        <label>Telefono:</label>
                        <input type="text" name="telefono">
                        <label>Direccion:</label>
                        <input type="text" name="direccion">
                        <label>Localidad:</label>
                        <input type="text" name="localidad">
                        <br>
                        <label>Hora de apertura: (Formato 24h)</label>
                        <input type="text" name="apertura">
                        <br>
                        <label>Hora de cierre: (Formato 24h)</label>
                        <input type="text" name="cierre">
                        <br>
                        <label>Día de apertura: (Ingrese el día de la semana)</label>
                        <input type="text" name="dia_apertura">
                        <br>
                        <label>Día de cierre: (Ingrese el día de la semana)</label>
                        <input type="text" name="dia_cierre">
                        <label>Aforo permitido</label>
                        <input type="text" name="aforo">

                        <div class="BMod">
                        <input type="submit" value="Registrar" />
                        </div>
                    </form>


                </div>

            </div>
    </body>
</html> 