<?php
 
require_once '../Modelo/modelo_pago.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $pagos = new Pagos();
		$resultado = $pagos->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $pagos = new Pagos();
		$resultado = $pagos->nuevo($datos);
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
		$pagos = new Pagos();
		$resultado = $pagos->borrar($datos['codigo']);
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
        $pagos = new Pagos();
        $pagos->consultar($datos['codigo']);

        if($pagos->getPayment_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $pagos->getPayment_id(),
                'cliente' => $pagos->getCustomer_id(),
                'empleado' => $pagos->getStaff_id(),
                'prestamo' =>$pagos->getRental_id(),
                'precio' => $pagos->getAmount(),
                'fecha_pago' => $pagos->getPayment_date(),
                'fecha' =>$pagos->getLast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $pagos = new Pagos();
        $listado = $pagos->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listacliente':
        $pagos = new Pagos();
        $listado = $pagos->listacliente();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listaempleado':
        $pagos = new Pagos();
        $listado = $pagos->listaempleado();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listarental':
        $pagos = new Pagos();
        $listado = $pagos->listarental();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
