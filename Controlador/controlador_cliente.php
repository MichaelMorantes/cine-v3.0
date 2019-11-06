<?php
 
require_once '../Modelo/modelo_cliente.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $clientes = new Clientes();
		$resultado = $clientes->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $clientes = new Clientes();
		$resultado = $clientes->nuevo($datos);
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
		$clientes = new Clientes();
		$resultado = $clientes->borrar($datos['codigo']);
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
        $clientes = new Clientes();
        $clientes->consultar($datos['codigo']);

        if($clientes->getCustomer_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $clientes->getCustomer_id(),
                'tienda' => $clientes->getStore_id(),
                'nombre' => $clientes->getFirst_name(),
                'apellido' =>$clientes->getLast_name(),
                'email' => $clientes->getEmail(),
                'direccion' => $clientes->getAddress_id(),
                'fecha_creacion' => $clientes->getCreate_date(),
                'fecha' =>$clientes->getLast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $clientes = new Clientes();
        $listado = $clientes->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listatienda':
        $clientes = new Clientes();
        $listado = $clientes->listatienda();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listapais':
        $clientes = new Clientes();
        $listado = $clientes->listapais();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listaciudad':
        $clientes = new Clientes();
        $listado = $clientes->listaciudad($datos['codigo']);        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listadireccion':
        $clientes = new Clientes();
        $listado = $clientes->listadireccion($datos['codigo']);        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
