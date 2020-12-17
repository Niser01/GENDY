<?php
header('Content-Type:application/json');
require_once '../DataBase.php';
session_start();



$c=$_SESSION['user'];

    $accion=(isset($_GET['accion']))?$_GET['accion']:"leer";

    switch($accion){
        case "agregar":

            $dia = $_POST["dia"];
            $dia_Semana = explode(" ", $dia);


            $sql2="SELECT `id` FROM `cita`";        
            $num=$DB->prepare($sql2); 
            $num->execute();
            $numero=$num->rowCount();
            $numero=$numero+1;  
            

            $sqlIDNEGOCIO='SELECT `ID_NEGOCIO` FROM `negocio` WHERE `RAZON_SOCIAL`= :nombreN';
            $nombre_neg=$DB->prepare($sqlIDNEGOCIO);
            $nombre_neg->setFetchMode(PDO::FETCH_ASSOC);
            $nombre_neg->execute(array(
                ":nombreN" => $_POST["nombre"]
            ));

            if ($nom = $nombre_neg->fetch()){
                $a = $nom["ID_NEGOCIO"];
            }   

            
            $sqlServiID="SELECT `ID_SERVICIOS` FROM `servicios` WHERE `NOMBRE_SERVICIOS`= :nommbreS";
            $id_serv=$DB->prepare($sqlServiID);
            $id_serv->setFetchMode(PDO::FETCH_ASSOC);
            $id_serv->execute(array(
                ":nommbreS" => $_POST["servicio"]
            ));

            if ($nom1 = $id_serv->fetch()){
                $b = $nom1["ID_SERVICIOS"];
            } 

            
            $sql1 = "INSERT INTO `cita` (`id`, `ID_USUARIO`, `ID_NEGOCIO`, `ID_SERVICIO`, `start`, `end`, `DIA_CITA`) 
            VALUES (:id, :usuario, :id_negocio, :id_servicio, :sta, :fin, :DIA_CITA)";
    
            $datos = $DB->prepare($sql1);
            $datos->execute(array(                
                ":id"=> $numero, 
                ":usuario" => $c,
                ":id_negocio" =>  $a,
                ":id_servicio" =>  $b,
                ":sta" => $_POST["start"],
                ":fin" => $_POST["end"],
                ":DIA_CITA" => $dia_Semana[0]
            ));


            echo json_encode(true);
        break;

        case "eliminar":

            if(isset($_POST["id_Cita"])){            
                
                $sql1 = "UPDATE `cita_final` SET `id_usuario` = NULL, `id_negocio` = NULL, `nombre_usuario` = NULL, `telefono_usuario` = NULL, `nombre_servicio` = NULL, `descripcion_servicio` = NULL, `precio_servicio` = NULL, `start` = NULL, `end` = NULL, `nombre_negocio` = NULL, `telefono_negocio` = NULL, `direccion_negocio` = NULL WHERE `cita_final`.`id_cita` = :valor";
                $we=$DB->prepare($sql1);
                $we->execute(array(':valor' => $_POST["id_Cita"]));

                $sql2 = "UPDATE `cita` SET `ID_USUARIO` = NULL, `ID_NEGOCIO` = NULL, `ID_SERVICIO` = NULL, `start` = NULL, `end` = NULL, `DIA_CITA` = NULL WHERE `cita`.`id` =  :valor";
                $we2=$DB->prepare($sql2);
                $we2->execute(array(":valor" => $_POST["id_Cita"]));   

            }

            echo json_encode(true);

        break;

        case "modificar":

            $a=$_POST["id_Cita"];

            $sql1 = "UPDATE `cita` SET `start` = :inicio, `end` = :fin WHERE `cita`.`id` = $a";
            $we=$DB->prepare($sql1);
            $we->execute(array(
                ":inicio" => $_POST["start"],
                ":fin" => $_POST["end"],
            )); 
            
            $sql2 = "UPDATE `cita_final` SET `start` = :inicio, `end` = :fin WHERE `cita_final`.`id_cita` = $a";
            $we2=$DB->prepare($sql2);
            $we2->execute(array(
                ":inicio" => $_POST["start"],
                ":fin" => $_POST["end"],
            )); 

            echo json_encode(true);

        break;
        
        default:
            $sql1 = "SELECT`id_cita`,`nombre_negocio`,`telefono_negocio`,`direccion_negocio`,`nombre_servicio`,`descripcion_servicio`,`precio_servicio`,`start`,`end` FROM `cita_final` WHERE `id_usuario`=$c";
            $we=$DB->prepare($sql1);
            $we->execute();
            $res=$we->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($res);
        break;
    }

?>