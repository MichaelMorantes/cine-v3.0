<?php
	require_once('modeloAbstractoDB.php');
	class Ciudad extends ModeloAbstractoDB {
		public $city_id; 	
		public $city;
        public $country_id;
        public $last_update;
		
		function __construct() {
			//$this->db_name = '';
		}
		
		public function getCity_id(){
			return $this->city_id;
		}

		public function getCity(){
			return $this->city;
		}
		
		public function getCountry_id(){
			return $this->country_id;
        }
        
        public function getLast_update(){
			return $this->last_update;
		}

		public function consultar($city_id='') {
			if($city_id != ''):
				$this->query = "
				SELECT city_id, city, country_id, last_update
				FROM city
				WHERE city_id = '$city_id' and estado != 1 order by city_id";
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
			SELECT city_id, city, co.country_id,co.country, ci.last_update
			FROM city as ci inner join country as co
			ON (ci.country_id = co.country_id)
			WHERE ci.estado != 1 
            ORDER BY city_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function listapais() {
			$this->query = "
			SELECT country_id,country
			FROM country  
			WHERE estado != 1
            ORDER BY country
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('city_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO city
				(city, country_id)
				VALUES
				('$city', '$country_id')
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
			UPDATE city
			SET city='$city',
			country_id='$country_id'
			WHERE city_id = '$city_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($city_id='') {
			$this->query = "
			UPDATE city
			SET estado=1
			WHERE city_id = '$city_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
        }
		
		function __destruct() {
			//unset($this);
		}
	}
?>