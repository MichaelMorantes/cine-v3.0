<?php
	require_once('modeloAbstractoDB.php');
	class Prestamo extends ModeloAbstractoDB {
		public $rental_id; 
        public $rental_date;
        public $inventory_id;
        public $customer_id;
        public $return_date;
        public $staff_id;
        public $last_update;
		
		function __construct() {
			//$this->db_rental_date = '';
		}
		
		public function getRental_id(){
			return $this->rental_id;
		}

		public function getRental_date(){
			return $this->rental_date;
        }
        
        public function getInventory_id(){
			return $this->inventory_id;
        }
        
        public function getCustomer_id(){
			return $this->customer_id;
        }
        
        public function getReturn_date(){
			return $this->return_date;
        }
        
        public function getStaff_id(){
			return $this->staff_id;
		}
        
        public function getLast_update(){
			return $this->last_update;
		}
        		
		public function consultar($rental_id='') {
			if($rental_id != ''):
				$this->query = "
				SELECT rental_id, rental_date,inventory_id, customer_id,return_date,staff_id,last_update
				FROM rental
				WHERE rental_id = '$rental_id' and estado != 1 order by rental_id";
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
			SELECT rental_id, rental_date,i.inventory_id,CONCAT(c.first_name, ' ', c.last_name) as cliente,return_date,CONCAT(s.first_name, ' ', s.last_name) as empleado,r.last_update
			FROM rental as r
			INNER JOIN customer as c ON (r.customer_id = c.customer_id)
			INNER JOIN staff as s ON (r.staff_id = s.staff_id)
			INNER JOIN inventory as i ON (r.inventory_id = i.inventory_id)
			WHERE r.estado != 1 order by rental_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listacliente() {
			$this->query = "
			SELECT customer_id,CONCAT(first_name, ' ', last_name) as nombre
            From customer
            WHERE active !=0
			ORDER BY customer_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaempleado() {
			$this->query = "
			SELECT staff_id,CONCAT(first_name, ' ', last_name) as nombre
            From staff
            WHERE active !=0 and (rol_id=1 or rol_id=2)
			ORDER BY staff_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
        }

		public function listainventario() {
			$this->query = "
			SELECT inventory_id
            From inventory
            WHERE estado !=1
			ORDER BY inventory_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('rental_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;	
				$this->query = "
				INSERT INTO rental 
				(rental_date,inventory_id,customer_id,return_date,staff_id)
				VALUES
				('$rental_date','$inventory_id','$customer_id','$return_date','$staff_id')
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
			UPDATE rental
            SET rental_date='$rental_date',
            inventory_id='$inventory_id',
            customer_id='$customer_id',
            return_date='$return_date',
            staff_id='$staff_id'
			WHERE rental_id = '$rental_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($rental_id='') {
			$this->query = "
			UPDATE rental
			SET estado=1
			WHERE rental_id = '$rental_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
        }
		
		function __destruct() {
			//unset($this);
		}
	}
?>