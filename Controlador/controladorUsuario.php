<?php
require_once '../Modelo/modeloUsuario.php';

$username = htmlspecialchars(trim("$_POST[username]"));
$password = htmlspecialchars(trim("$_POST[password]"));
$datos = array("username"=>$username, "password"=>$password);
$actualizacion = $_POST;

switch ($_POST['accion']){
   
    case 'login':
        $usuario = new Usuario();
        $usuario->consultar($datos);
        if($usuario->getStaff_id() == null) {
           
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            // echo 'console.log('. $usuario->getPassword() .')';
            // echo 'console.log('. $datos['password'] .')';
            if(password_verify($datos['password'],$usuario->getPassword())){
                // if ($usuario->getRol_id() == 1 || $usuario->getRol_id() == 0 || $usuario->getRol_id() == 2) {
                    session_start();
                    $_SESSION['usuario'] = $usuario->getUsername();
                    $_SESSION['nombre'] = $usuario->getNombre();
                    $_SESSION['foto'] = $usuario->getPicture($usuario->getStaff_id());
                    $_SESSION['rol']= $usuario->getRol_id();
                    $_SESSION['id']= $usuario->getStaff_id();
                    $respuesta = array(
                        'respuesta' =>'existe'
                    );
                    // echo 'console.log('. $usuario->getPicture($usuario->getStaff_id()) .')';
                    // $respuesta = array(
                    //     'respuesta' =>'empleado'
                    // );
                // } else {
                //     $respuesta = array(
                //         'respuesta' =>'usuario'
                //     );
                // }
            } else {
                $respuesta = array(
                    'respuesta' => 'no existe'
                );
            }
            
        }
        echo json_encode($respuesta);
        break;
    break;

    case 'editar':
        // echo "editar";
        $usuario = new Usuario();
        $foto = addslashes(file_get_contents($_FILES['picture']['tmp_name']));;
        $opciones = [
            'cost' => 12,
        ];
        $passwordHashed = password_hash($actualizacion['password'], PASSWORD_BCRYPT, $opciones);
        $actualizacion['password']= $passwordHashed;
        // var_dump($foto);
        // var_dump($datos);
        $resultado = $usuario->editarusuario($actualizacion,$foto);
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
        $usuario = new Usuario();
        $resultado = $usuario->nuevo($datos);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }  else {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }
        echo json_encode($respuesta);
        break;
       
    case 'borrar':
		$usuario = new Usuario();
		$resultado = $usuario->borrar($datos['codigo']);
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
        $usuario = new Usuario();
        $usuario->consultar($datos['codigo']);

        if($usuario->getComu_codi() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $usuario->getComu_codi(),
                'comuna' => $usuario->getComu_nomb(),
                'municipio' =>$usuario->getMuni_codi(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $usuario = new Usuario();
        $listado = $usuario->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
