<?php
	require_once('modeloAbstractoDB.php');
	class Pagos extends ModeloAbstractoDB {
		public $payment_id; 	
        public $customer_id;
        public $staff_id;
        public $rental_id;
        public $amount;
        public $payment_date;
        public $last_update;
		
		function __construct() {
			//$this->db_customer_id = '';
		}
		
		public function getPayment_id(){
			return $this->payment_id;
		}

		public function getCustomer_id(){
			return $this->customer_id;
        }
        
        public function getStaff_id(){
			return $this->staff_id;
        }
        
        public function getRental_id(){
			return $this->rental_id;
        }
        
        public function getAmount(){
			return $this->amount;
        }
        
        public function getPayment_date(){
			return $this->payment_date;
		}
        
        public function getLast_update(){
			return $this->last_update;
		}
        		
		public function consultar($payment_id='') {
			if($payment_id != ''):
				$this->query = "
				SELECT payment_id,customer_id,staff_id,rental_id,amount,payment_date,last_update
				FROM payment
				WHERE payment_id = '$payment_id' and estado != 1 order by payment_id";
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
			SELECT payment_id,CONCAT(c.first_name, ' ', c.last_name) as cliente,CONCAT(s.first_name, ' ', s.last_name) as empleado,rental_id,amount,payment_date,p.last_update
			FROM payment as p
			INNER JOIN customer as c ON (p.customer_id = c.customer_id)
            INNER JOIN staff as s ON (p.staff_id = s.staff_id)
			WHERE p.estado != 1 
			ORDER BY payment_id
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

		public function listarental() {
			$this->query = "
			SELECT rental_id
            From rental
            WHERE estado !=1 and  NOT EXISTS(SELECT rental_id
                   FROM  payment
                   WHERE  payment.rental_id = rental.rental_id)
			ORDER BY rental_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('payment_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO payment
				(customer_id,staff_id,rental_id,amount,payment_date)
				VALUES
				('$customer_id','$staff_id','$rental_id','$amount','$payment_date')
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
			UPDATE payment
            SET customer_id='$customer_id',
			staff_id='$staff_id',
			rental_id='$rental_id',
			amount='$amount',
			payment_date='$payment_date'
			WHERE payment_id = '$payment_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($payment_id='') {
			$this->query = "
			UPDATE payment
			SET estado=1
			WHERE payment_id = '$payment_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
        }
		
		function __destruct() {
			//unset($this);
		}
	}
?>