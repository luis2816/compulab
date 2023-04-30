<?php 

	class SedesModel extends Mysql
	{
		public $intIdsede;
		public $strNombre;
		public $strDireccion;
		public $intTelefono;
		public $strEmail;
		public $strEstado;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectSedes()
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " and id != 1 ";
			}
			//EXTRAE SEDES
			$sql = "SELECT * FROM sede WHERE estado != 0".$whereAdmin;
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectSede(int $idSede)
		{
			//BUSCAR SEDE
			$this->intIdsede = $idSede;
			$sql = "SELECT * FROM sede WHERE id = $this->intIdsede";
			$request = $this->select($sql);
			return $request;
		}

		public function insertSede(string $nombre, string $direccion, int $telefono, string $email, int $estado){

			$return = "";
			$this->strNombre = $nombre;
			$this->strDireccion = $direccion;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strEstado = $estado;

			$sql = "SELECT * FROM sede WHERE nombre = '{$this->strNombre}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO sede(nombre,direccion,telefono,email,estado) VALUES(?,?,?,?,?)";
	        	$arrData = array($this->strNombre, $this->strDireccion, $this->intTelefono,$this->strEmail,$this->strEstado);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateSede(int $idsede, string $nombre, string $direccion, int $telefono, string $email, int $estado){
			
			$this->intIdsede = $idsede;
			$this->strNombre = $nombre;
			$this->strDireccion = $direccion;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strEstado = $estado;

			$sql = "SELECT * FROM sede WHERE nombre = '$this->strNombre' AND id != $this->intIdsede";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE sede SET nombre = ?, direccion = ?, telefono = ?, email = ?,  estado  = ? WHERE id = $this->intIdsede ";
				$arrData = array($this->strNombre, $this->strDireccion, $this->intTelefono,$this->strEmail,$this->strEstado);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteSede(int $idsede)
		{
			$this->intIdsede = $idsede;

				$sql = "UPDATE sede SET estado = ? WHERE id = $this->intIdsede ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
		
			return $request;
		}
	}
 ?>