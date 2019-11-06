<?php
	require_once('modeloAbstractoDB.php');
	class Inventario extends ModeloAbstractoDB {
		public $inventory_id; 	
        public $film_id;
        public $store_id;
        public $last_update;
		
		function __construct() {
			//$this->db_film_id = '';
		}
		
		public function getInventory_id(){
			return $this->inventory_id;
		}

		public function getFilm_id(){
			return $this->film_id;
        }
        
        public function getStore_id(){
			return $this->store_id;
		}
        
        public function getLast_update(){
			return $this->last_update;
		}
        		
		public function consultar($inventory_id='') {
			if($inventory_id != ''):
				$this->query = "
				SELECT inventory_id, film_id,store_id, last_update
				FROM inventory
				WHERE inventory_id = '$inventory_id' and estado != 1 order by inventory_id";
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
			SELECT i.inventory_id, f.title, i.store_id , i.last_update
			FROM inventory as i
			INNER JOIN film as f ON (i.film_id = f.film_id)
			WHERE i.estado != 1 
			ORDER BY i.inventory_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listatienda() {
			$this->query = "
			SELECT store_id
			From store
			WHERE estado !=1
			ORDER BY store_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listapelicula() {
			$this->query = "
			SELECT film_id,title
			From film
			WHERE estado !=1
			ORDER BY title
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('inventory_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO inventory
				(film_id,store_id)
				VALUES
				('$film_id','$store_id')
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
			UPDATE inventory
            SET film_id='$film_id',
            store_id='$store_id'
			WHERE inventory_id = '$inventory_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($inventory_id='') {
			$this->query = "
			UPDATE inventory
			SET estado=1
			WHERE inventory_id = '$inventory_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
        }
		
		function __destruct() {
			//unset($this);
		}
	}
?>