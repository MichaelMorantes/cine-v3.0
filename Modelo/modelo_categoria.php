<?php
	require_once('modeloAbstractoDB.php');
	class Categoria extends ModeloAbstractoDB {
		public $category_id; 	
		public $name;
		public $last_update;
		
		function __construct() {
			//$this->db_name = '';
		}
		
		public function getCategory_id(){
			return $this->category_id;
		}

		public function getName(){
			return $this->name;
		}
        
        public function getLast_update(){
			return $this->last_update;
		}
        		
		public function consultar($category_id='') {
			if($category_id != ''):
				$this->query = "
				SELECT category_id, name, last_update
				FROM category
				WHERE category_id = '$category_id' and estado != 1 order by category_id";
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
			SELECT category_id, name, last_update
			FROM category
			WHERE estado != 1 
            ORDER BY category_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('category_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO category
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
			UPDATE category
			SET name='$name'
			WHERE category_id = '$category_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($category_id='') {
			$this->query = "
			UPDATE category
			SET estado=1
			WHERE category_id = '$category_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
        }
		
		function __destruct() {
			//unset($this);
		}
	}
?>