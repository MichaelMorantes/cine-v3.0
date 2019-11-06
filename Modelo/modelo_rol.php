<?php
	require_once('modeloAbstractoDB.php');
	class Roles extends ModeloAbstractoDB {
		public $rol_id;
		public $rol_name; 
		
		function __construct() {
			//$this->db_name = '';
		}
		
		public function getRol_id(){
			return $this->rol_id;
		}
		
		public function getRol_name(){
			return $this->rol_name;
		}
        
		public function consultar($rol_id='') {
			if($rol_id != ''):
				$this->query = "
				SELECT rol_id, rol_name
				FROM rol
				WHERE rol_id = '$rol_id' and estado != 1 order by rol_id";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function lista() {
			$this->query = "
			SELECT rol_id, rol_name
			FROM rol
			WHERE estado != 1 
            ORDER BY rol_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('rol_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO rol
				(rol_name)
				VALUES
				('$rol_name')
				";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$this->query = "
			UPDATE rol
			SET rol_name='$rol_name'
			WHERE rol_id = '$rol_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($rol_id='') {
			$this->query = "
			UPDATE rol
			SET estado=1
			WHERE rol_id = '$rol_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
        }
		
		function __destruct() {
			//unset($this);
		}
	}
?>