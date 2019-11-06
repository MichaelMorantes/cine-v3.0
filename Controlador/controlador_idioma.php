<?php
 
require_once '../Modelo/modelo_idioma.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $idioma = new Idioma();
		$resultado = $idioma->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $idioma = new Idioma();
		$resultado = $idioma->nuevo($datos);
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
		$idioma = new Idioma();
		$resultado = $idioma->borrar($datos['codigo']);
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
        $idioma = new Idioma();
        $idioma->consultar($datos['codigo']);

        if($idioma->getLanguage_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $idioma->getLanguage_id(),
                'idioma' => $idioma->getName(),
                'fecha' =>$idioma->getLast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $idioma = new Idioma();
        $listado = $idioma->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
