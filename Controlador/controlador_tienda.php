<?php
 
require_once '../Modelo/modelo_tienda.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $Tienda = new Tienda();
		$resultado = $Tienda->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $Tienda = new Tienda();
		$resultado = $Tienda->nuevo($datos);
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
		$Tienda = new Tienda();
		$resultado = $Tienda->borrar($datos['codigo']);
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
        $Tienda = new Tienda();
        $Tienda->consultar($datos['codigo']);

        if($Tienda->getStore_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $Tienda->getStore_id(),
                'admin' => $Tienda->getAdmin(),
                'ciudad' => $Tienda->getCity_id(),
                'direccion' =>$Tienda->getAddress_id(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $Tienda = new Tienda();
        $listado = $Tienda->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listapais':
        $Tienda = new Tienda();
        $listado = $Tienda->listapais();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listaciudad':
        $Tienda = new Tienda();
        $listado = $Tienda->listaciudad($datos['codigo']);        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listadireccion':
        $Tienda = new Tienda();
        $listado = $Tienda->listadireccion($datos['codigo']);        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listaadmin':
        $Tienda = new Tienda();
        $listado = $Tienda->listaadmin($datos['codigo']);
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
