<?php
	require_once('modeloAbstractoDB.php');
	class Pais extends ModeloAbstractoDB {
		public $country_id;
		public $country; 
        public $last_update;
		
		function __construct() {
			//$this->db_name = '';
		}
		
		public function getCountry_id(){
			return $this->country_id;
		}
		
		public function getCountry(){
			return $this->country;
		}
        
        public function getLast_update(){
			return $this->last_update;
		}

		public function consultar($country_id='') {
			if($country_id != ''):
				$this->query = "
				SELECT country_id, country, last_update
				FROM country
				WHERE country_id = '$country_id' and estado != 1 order by country_id";
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
			SELECT country_id, country, last_update
			FROM country
			WHERE estado != 1 
            ORDER BY country_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('country_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO country
				(country)
				VALUES
				('$country')
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
			UPDATE country
			SET country='$country'
			WHERE country_id = '$country_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($country_id='') {
			$this->query = "
			UPDATE country
			SET estado=1
			WHERE country_id = '$country_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
        }
		
		function __destruct() {
			//unset($this);
		}
	}
?>