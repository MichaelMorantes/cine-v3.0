<?php
	require_once('modeloAbstractoDB.php');
	class Idioma extends ModeloAbstractoDB {
		public $language_id; 	
		public $name;
        public $last_update;
		
		function __construct() {
			//$this->db_name = '';
		}
		
		public function getLanguage_id(){
			return $this->language_id;
		}

		public function getName(){
			return $this->name;
		}
        
        public function getLast_update(){
			return $this->last_update;
		}
        		
		public function consultar($language_id='') {
			if($language_id != ''):
				$this->query = "
				SELECT language_id, name, last_update
				FROM language
				WHERE language_id = '$language_id' and estado != 1 order by language_id";
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
			SELECT language_id, name, last_update
			FROM language
			WHERE estado != 1 
            ORDER BY language_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('language_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO language
				(name)
				VALUES
				('$name')
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
			UPDATE language
			SET name='$name'
			WHERE language_id = '$language_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($language_id='') {
			$this->query = "
			UPDATE language
			SET estado=1
			WHERE language_id = '$language_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
        }
		
		function __destruct() {
			//unset($this);
		}
	}
?>