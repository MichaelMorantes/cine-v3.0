<?php
 
require_once '../Modelo/modelo_rol.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $rol = new Roles();
		$resultado = $rol->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $rol = new Roles();
		$resultado = $rol->nuevo($datos);
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

    case 'borrar':
		$rol = new Roles();
		$resultado = $rol->borrar($datos['codigo']);
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

    case 'consultar':
        $rol = new Roles();
        $rol->consultar($datos['codigo']);

        if($rol->getRol_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $rol->getRol_id(),
                'rol' => $rol->getRol_name(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $rol = new Roles();
        $listado = $rol->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
