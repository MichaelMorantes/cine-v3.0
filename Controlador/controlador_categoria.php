<?php
 
require_once '../Modelo/modelo_categoria.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $categoria = new Categoria();
		$resultado = $categoria->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $categoria = new Categoria();
		$resultado = $categoria->nuevo($datos);
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
		$categoria = new Categoria();
		$resultado = $categoria->borrar($datos['codigo']);
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
        $categoria = new Categoria();
        $categoria->consultar($datos['codigo']);

        if($categoria->getCategory_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $categoria->getCategory_id(),
                'categoria' => $categoria->getName(),
                'fecha' =>$categoria->getLast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $categoria = new Categoria();
        $listado = $categoria->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
