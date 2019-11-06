<?php
 
require_once '../Modelo/modelo_empleado.php';
$data = $_GET;
switch ($_GET['accion']){
    case 'consultar':
        $Empleado = new Empleado();
        $Empleado->consultar($data['codigo']);

        if($Empleado->getStaff_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $Empleado->getStaff_id(),
                'nombre' => $Empleado->getFirst_name(),
                'apellido' => $Empleado->getLast_name(),
                'direccion' =>$Empleado->getAddress_id(),
                'email' => $Empleado->getEmail(),
                'tienda' => $Empleado->getStore_id(),
                'rol' => $Empleado->getRol_id(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $Empleado = new Empleado();
        $listado = $Empleado->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listapais':
        $Empleado = new Empleado();
        $listado = $Empleado->listapais();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listaciudad':
        $Empleado = new Empleado();
        $listado = $Empleado->listaciudad($data['codigo']);        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listadireccion':
        $Empleado = new Empleado();
        $listado = $Empleado->listadireccion($data['codigo']);        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listatienda':
        $Empleado = new Empleado();
        $listado = $Empleado->listatienda();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;

    case 'listarol':
        $Empleado = new Empleado();
        $listado = $Empleado->listarol();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
