<?php
	require_once('modeloAbstractoDB.php');
	class Tienda extends ModeloAbstractoDB { 	
		public $store_id;
        public $admin;
		public $address_id;
		public $city_id;
        public $last_update;
		
		function __construct() {
			//$this->db_manager_staff_id = '';
		}
		
		public function getStore_id(){
			return $this->store_id;
		}

		public function getAdmin(){
			return $this->admin;
		}
		
		public function getCity_id(){
			return $this->city_id;
        }
        
        public function getAddress_id(){
			return $this->address_id;
		}
		
        public function getLast_update(){
			return $this->last_update;
		}
        		
		public function consultar($store_id='') {
			if($store_id != ''):
				$this->query = "
				SELECT se.store_id,cit.city_id,IFNULL(CONCAT(ad.first_name, ' ', ad.last_name),'Sin asignar') as admin,dir.address_id
                FROM store as se
                LEFT OUTER JOIN staff as ad ON (se.manager_staff_id=ad.staff_id)
                INNER JOIN address as dir ON (se.address_id=dir.address_id)
                INNER JOIN city as cit ON (dir.city_id=cit.city_id)
				WHERE se.store_id = '$store_id' and se.estado != 1 
                GROUP BY se.store_id
            	ORDER BY se.store_id ASC
				";
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
			SELECT se.store_id,cit.city,address,IFNULL(CONCAT(ad.first_name, ' ', ad.last_name),'Sin asignar') as admin,IFNULL((SELECT GROUP_CONCAT(CONCAT(em.first_name, ' ', em.last_name) separator ', ')
                   FROM staff as em 
                   WHERE em.store_id=se.store_id),'Sin asignar') as empleados
            FROM store as se
            LEFT OUTER JOIN staff as ad ON (se.manager_staff_id=ad.staff_id)
            INNER JOIN address as dir ON (se.address_id=dir.address_id)
            INNER JOIN city as cit ON (dir.city_id=cit.city_id)
            WHERE se.estado!=1 and (se.manager_staff_id=ad.staff_id or se.manager_staff_id is null) 
            GROUP BY se.store_id
            ORDER BY se.store_id ASC
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

		public function listaadmin($store_id='') {
				$this->query = "
				SELECT staff_id,CONCAT(first_name, ' ', last_name) as admin
				FROM staff
				WHERE active!=0 AND rol_id=1 AND store_id='$store_id' 
				";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('store_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO store
				(address_id)
				VALUES
				('$address_id')
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
			UPDATE store
            SET manager_staff_id=$manager_staff_id,
			address_id='$address_id'
			WHERE store_id = '$store_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($store_id='') {
			$this->query = "
			UPDATE store
			SET estado=1
			WHERE store_id = '$store_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
        }
		
		function __destruct() {
			//unset($this);
		}
	}
?>