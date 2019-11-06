<?php
	require_once('modeloAbstractoDB.php');
	class Clientes extends ModeloAbstractoDB {
		public $customer_id; 	
        public $store_id;
        public $first_name;
        public $last_name;
        public $email;
        public $address_id;
        public $create_date;
        public $last_update;
		
		function __construct() {
			//$this->db_store_id = '';
		}
		
		public function getCustomer_id(){
			return $this->customer_id;
		}

		public function getStore_id(){
			return $this->store_id;
        }
        
        public function getFirst_name(){
			return $this->first_name;
        }
        
        public function getLast_name(){
			return $this->last_name;
        }
        
        public function getEmail(){
			return $this->email;
        }

        public function getAddress_id(){
			return $this->address_id;
        }
        
        public function getCreate_date(){
			return $this->create_date;
		}
        
        public function getLast_update(){
			return $this->last_update;
		}
        		
		public function consultar($customer_id='') {
			if($customer_id != ''):
				$this->query = "
				SELECT customer_id,store_id,first_name,last_name,email,address_id,create_date,last_update
				FROM customer
				WHERE customer_id = '$customer_id' and active != 0 order by customer_id";
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
            SELECT customer_id,c.store_id,CONCAT(c.first_name, ' ', c.last_name) as cliente,email,a.address,create_date,c.last_update 
            FROM customer as c 
            INNER JOIN address as a ON (c.address_id = a.address_id) 
            WHERE c.active != 0 ORDER BY customer_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listatienda() {
			$this->query = "
			SELECT store_id
            From store
            WHERE estado != 1 
			ORDER BY store_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
        }

		public function listapais() {
			$this->query = "
			SELECT country_id,country
            From country
            WHERE estado !=1
			ORDER BY country_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaciudad($country_id='') {
			$this->query = "
			SELECT city_id,city
			From city as c
			INNER JOIN country as y ON (c.country_id=y.country_id)
            WHERE c.estado !=1 and c.country_id='$country_id'
			ORDER BY city_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listadireccion($city_id='') {
				$this->query = "
				SELECT address_id,address
				From address as a
				INNER JOIN city as c ON (a.city_id=c.city_id)
				WHERE a.estado !=1  and a.city_id='$city_id'
				ORDER BY address_id
				";
			$this->obtener_resultados_query();
			return $this->rows;
        }

		public function nuevo($datos=array()) {
			if(array_key_exists('customer_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO customer
				(store_id,first_name,last_name,email,address_id,create_date)
				VALUES
				('$store_id','$first_name','$last_name','$email','$address_id','$create_date')
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
			UPDATE customer
            SET store_id='$store_id',
			first_name='$first_name',
			last_name='$last_name',
            email='$email',
            address_id='$address_id',
			create_date='$create_date'
			WHERE customer_id = '$customer_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($customer_id='') {
			$this->query = "
			UPDATE customer
			SET active=0
			WHERE customer_id = '$customer_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
        }
		
		function __destruct() {
			//unset($this);
		}
	}
?>