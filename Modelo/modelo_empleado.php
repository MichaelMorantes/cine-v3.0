<?php
	require_once('modeloAbstractoDB.php');
	class Empleado extends ModeloAbstractoDB {
		public $staff_id; 	
        public $first_name;
        public $last_name;
        public $address_id;
        public $picture;
        public $email;
        public $store_id;
        public $rol_id;
        public $username;
        public $password;
		
		function __construct() {
			//$this->db_first_name = '';
		}
		
		public function getStaff_id(){
			return $this->staff_id;
		}

		public function getFirst_name(){
			return $this->first_name;
        }
        
        public function getLast_name(){
			return $this->last_name;
        }
        
        public function getAddress_id(){
			return $this->address_id;
        }
        
        public function getPicture(){
			return $this->picture;
        }
        
        public function getEmail(){
			return $this->email;
		}
        
        public function getStore_id(){
			return $this->store_id;
        }
        
        public function getUsername(){
			return $this->username;
		}
        
        public function getPassword(){
			return $this->password;
		}
		public function getRol_id(){
			return $this->rol_id;
		}
        		
		public function consultar($staff_id='') {
			if($staff_id != ''):
				$this->query = "
				SELECT staff_id,first_name,last_name,address_id,email,store_id,rol_id
				FROM staff
				WHERE staff_id = '$staff_id' and active != 0 order by staff_id
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
			SELECT staff_id,CONCAT(s.first_name, ' ', s.last_name) as empleado,address,email,store_id,rol_name
            FROM staff as s
            INNER JOIN address as a ON (s.address_id = a.address_id)
            INNER JOIN rol as r ON (s.rol_id = r.rol_id)
            WHERE s.active != 0 and s.rol_id<3
            ORDER BY staff_id
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

        public function listarol() {
			$this->query = "
			SELECT rol_id,rol_name
            From rol
            WHERE estado != 1 AND rol_id<3
			ORDER BY rol_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function nuevousuario($datos=array(),$foto) {
			// var_dump($foto);
			// var_dump($datos);
			if(array_key_exists('staff_id', $datos)):
			// 	//you keep your column name setting for insertion. I keep image type Blob.
			// 	// $query = "INSERT INTO products (id,image) VALUES('','$image')";  
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				// $query = "
				$this->query = "
				INSERT INTO staff
				(first_name,last_name,address_id,picture,email,store_id,rol_id,username,password)
				VALUES
				('$first_name','$last_name','$address_id','$foto','$email','$store_id','$rol_id','$username','$password')
				";
				// $db = mysqli_connect("localhost","root","","sakila"); //keep your db name
				//you keep your column name setting for insertion. I keep image type Blob.
				$resultado = $this->ejecutar_query_simple();
				// $qry = mysqli_query($db, $query);
				// echo $resultado;
				return $resultado;
				// return var_dump($datos);
			endif;
		}

		public function editarusuario($datos=array(),$foto) {
			// var_dump($foto);
			// var_dump($datos);
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$this->query = "
			UPDATE staff
            SET first_name='$first_name',
			last_name='$last_name',
			address_id='$address_id',
			picture='$foto',
            email='$email',
            store_id='$store_id',
            rol_id='$rol_id',
            username='$username',
            password='$password'
			WHERE staff_id = '$staff_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}

		public function nuevo($datos=array()) {
			// // var_dump($picture);
			// if(array_key_exists('staff_id', $datos)):
			// 	//you keep your column name setting for insertion. I keep image type Blob.
			// 	// $query = "INSERT INTO products (id,image) VALUES('','$image')";  
			// 	foreach ($datos as $campo=>$valor):
			// 		$$campo = $valor;
			// 	endforeach;
			// 	$this->query = "
			// 	INSERT INTO staff
			// 	(first_name,last_name,address_id,picture,email,store_id,rol_id,username,password)
			// 	VALUES
			// 	('$first_name','$last_name','$address_id','$picture','$email','$store_id','$rol_id','$username','$password')
			// 	";
			// 	$resultado = $this->ejecutar_query_simple();
			// 	return $resultado;
			// 	// return var_dump($datos);
			// endif;
		}
		
		public function editar($datos=array()) {
			// foreach ($datos as $campo=>$valor):
			// 	$$campo = $valor;
			// endforeach;
			// $this->query = "
			// UPDATE staff
            // SET first_name='$first_name',
			// last_name='$last_name',
			// address_id='$address_id',
			// picture='$picture',
            // email='$email',
            // store_id='$store_id',
            // rol_id='$rol_id',
            // username='$username',
            // password='$password'
			// WHERE staff_id = '$staff_id'
			// ";
			// $resultado = $this->ejecutar_query_simple();
			// return $resultado;
		}
		
		public function borrar($staff_id='') {
			$this->query = "
			UPDATE staff
			SET active=0
			WHERE staff_id = '$staff_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		// public function generarPassword($pass=""){
        //     $opciones = [
		// 		'cost' => 12,
		// 	];
		// 	$passwordHashed = password_hash($pass, PASSWORD_BCRYPT, $opciones);
        //     return $passwordHashed;
        // }
		
		function __destruct() {
			//unset($this);
		}
	}
?>