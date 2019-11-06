<?php
 
require_once '../Modelo/modelo_inventario.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $inventario = new Inventario();
		$resultado = $inventario->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $inventario = new Inventario();
		$resultado = $inventario->nuevo($datos);
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
		$inventario = new Inventario();
		$resultado = $inventario->borrar($datos['codigo']);
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
        $inventario = new Inventario();
        $inventario->consultar($datos['codigo']);

        if($inventario->getInventory_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $inventario->getInventory_id(),
                'pelicula' => $inventario->getFilm_id(),
                'tienda' =>$inventario->getStore_id(),
                'fecha' =>$inventario->getLast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $inventario = new Inventario();
        $listado = $inventario->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listartienda':
        $inventario = new Inventario();
        $listado = $inventario->listatienda();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listarpelicula':
        $inventario = new Inventario();
        $listado = $inventario->listapelicula();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
