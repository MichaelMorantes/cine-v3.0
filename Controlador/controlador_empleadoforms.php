<?php

require_once '../Modelo/modelo_empleado.php';
$datos = $_POST;
// var_dump($datos);
// echo  $_POST['picture'];
// var_dump($foto);
// var_dump($datos);

switch ($_POST['accion']){
    // case 'cifrar':
    //     $Empleado = new Empleado();
	// 	$resultado = $Empleado->generarPassword($datos['password']);
    //     $respuesta = array(
    //             'respuesta' => $resultado
    //         );
    //     echo json_encode($respuesta);
    //     break;

    case 'editar':
        // echo "editar";
        $Empleado = new Empleado();
        $foto = addslashes(file_get_contents($_FILES['picture']['tmp_name']));;
        $opciones = [
            'cost' => 12,
        ];
        $passwordHashed = password_hash($datos['password'], PASSWORD_BCRYPT, $opciones);
        $datos['password']= $passwordHashed;
        // var_dump($foto);
        // var_dump($datos);
        $resultado = $Empleado->editarusuario($datos,$foto);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => 'correcto'
            );
        }  else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $Empleado = new Empleado();
        $foto = addslashes(file_get_contents($_FILES['picture']['tmp_name']));;
        $opciones = [
            'cost' => 12,
        ];
        $passwordHashed = password_hash($datos['password'], PASSWORD_BCRYPT, $opciones);
        $datos['password']= $passwordHashed;
//         var_dump($foto);
// var_dump($datos);
		$resultado = $Empleado->nuevousuario($datos,$foto);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => 'correcto'
            );
        }  else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        echo json_encode($respuesta);
        // return $Empleado->nuevo($datos);
        break;

    case 'borrar':
		$Empleado = new Empleado();
		$resultado = $Empleado->borrar($datos['codigo']);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => 'correcto'
            );
        }  else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        echo json_encode($respuesta);
        break;
}
?>