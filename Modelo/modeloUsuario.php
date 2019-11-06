<?php
    require_once("modeloAbstractoDB.php");
	
    class Usuario extends ModeloAbstractoDB {
        private $staff_id;
        private $nombre;
		private $rol_id;
		private $username;
		private $password;
		private $picture;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getStaff_id(){
			return $this->staff_id;
		}
        
        public function getNombre(){
			return $this->nombre;
		}

		public function getRol_id(){
			return $this->rol_id;
		}

		public function getUsername(){
			return $this->username;
		}

		public function getpassword(){
			return $this->password;
		}

		public function getPicture($id=''){
			$query = "
			SELECT picture 
			FROM staff 
			WHERE staff_id = '$id'
			";
			return $this->foto($query);
        }
		
		public function consultar($datos = array()) {	
			$username = $datos['username'];
			$password = $datos['password'];
            $this->query = "
            SELECT staff_id,CONCAT(first_name, ' ', last_name) as nombre,rol_id,username,password
			FROM staff
			WHERE active!=0 and username= '$username'
			";
			$this->obtener_resultados_query();
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function lista() {
			$this->query = "
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
        
        public function generarPassword($pass=""){
            $opciones = [
                'cost' => 12,
            ];
            
            $passwordHashed = password_hash($pass, PASSWORD_BCRYPT, $opciones);
            
            return $passwordHashed;
        }

		public function nuevo($datos=array()) {
			if(array_key_exists('staff_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
                endforeach;
				$this->query = "
					INSERT INTO tb_usuario
					(staff_id, usuario, rol_id, password,perso_cod,update_at)
					VALUES
					(NULL, '$comu_nomb', '$muni_codi',NOW())
					";
					$resultado = $this->ejecutar_query_simple();
					return $resultado;
			endif;
			
		}
		
		public function editar($datos=array()) {
			// foreach ($datos as $campo=>$valor):
			// 	$$campo = $valor;
			// endforeach;
			// $this->query = "
			// UPDATE tb_comuna
			// SET comu_nomb ='$comu_nomb',
			// muni_codi ='$muni_codi',
			// update_at = NOW()
			// WHERE comu_codi = '$comu_codi'
			// ";
			// $resultado = $this->ejecutar_query_simple();
			// return $resultado;
		}

		public function editarusuario($datos=array(),$foto) {
			// var_dump($foto);
			// var_dump($datos);
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$this->query = "
			UPDATE staff
            SET first_name='$first_name',
			last_name='$last_name',
			picture='$foto',
            email='$email',
            rol_id='$rol_id',
            username='$username',
            password='$password'
			WHERE staff_id = '$staff_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($comu_codi='') {
			$this->query = "
			DELETE FROM tb_comuna
			WHERE comu_codi = '$comu_codi'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>