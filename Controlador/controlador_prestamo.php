<?php
 
require_once '../Modelo/modelo_prestamo.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $prestamo = new Prestamo();
		$resultado = $prestamo->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $prestamo = new Prestamo();
		$resultado = $prestamo->nuevo($datos);
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
		$prestamo = new Prestamo();
		$resultado = $prestamo->borrar($datos['codigo']);
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
        $prestamo = new Prestamo();
        $prestamo->consultar($datos['codigo']);

        if($prestamo->getRental_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $prestamo->getRental_id(),
                'fecha_prestamo' => $prestamo->getRental_date(),
                'inventario' =>$prestamo->getInventory_id(),
                'cliente' =>$prestamo->getCustomer_id(),
                'fecha_retorno' =>$prestamo->getReturn_date(),
                'empleado' =>$prestamo->getStaff_id(),
                'fecha' =>$prestamo->getLast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $prestamo = new Prestamo();
        $listado = $prestamo->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listacliente':
        $prestamo = new Prestamo();
        $listado = $prestamo->listacliente();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listaempleado':
        $prestamo = new Prestamo();
        $listado = $prestamo->listaempleado();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listainventario':
        $prestamo = new Prestamo();
        $listado = $prestamo->listainventario();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
