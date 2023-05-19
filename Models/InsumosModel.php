<?php 

	class InsumosModel extends Mysql
	{
		private $idInsumo;
	     private $intTipoproducto;
		 private $strFabricante;
		 private $strLote;
		 private $dateFechaEntrada;
		 private $dateFechaVence;
		 private $intCantidad;
		 private $strPresentacioncomercial;
		 private $strRegistrosanitario;
		public function __construct()
		{
			parent::__construct();
		}

    
		public function selectInsumos()
		{
			$sql = "SELECT i.id, t.nombre as nombreCategoria, t.nombre, 
			               i.fabricante, i.lote, i.fecha_entrada,
						    i.fecha_vencimiento, i.cantidad,
							DATEDIFF (i.fecha_vencimiento, i.fecha_entrada) as dias
							 FROM insumos as i
			inner join tipoproducto as t on t.id=i.idTipoproducto
			inner join categoria as c on c.idcategoria=t.categoria";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectInsumosEntregas(){

			$sql= "SELECT t.id, t.nombre, s.cantidad FROM stock as s
			inner join tipoproducto as t on t.id=s.id_Tipoproducto";
	$request = $this->select_all($sql);
	return $request;
		}

		public function selectInsumo($id)
		{
			$this->idInsumo=$id;
			$sql = "SELECT i.id, t.nombre as nombreCategoria, t.nombre, 
			               i.fabricante, i.lote, i.fecha_entrada,
						    i.fecha_vencimiento, i.cantidad,
							DATEDIFF (i.fecha_vencimiento, i.fecha_entrada) as dias
							 FROM insumos as i
			inner join tipoproducto as t on t.id=i.idTipoproducto
			inner join categoria as c on c.idcategoria=t.categoria
			where i.id= $this->idInsumo";
			$request = $this->select($sql);
			return $request;
		}

		
		public function insertInsumo( int $idTipoproducto, string $fabricante, string $lote, 
		                              string $fechaEntrada, string $fechaVence, int $cantidad,
									  string $presentacionComercial, string $registroSanitario){

			$this->intTipoproducto = $idTipoproducto;
			$this->strFabricante = $fabricante;
			$this->strLote = $lote;
			$this->dateFechaEntrada = $fechaEntrada;
			$this->dateFechaVence = $fechaVence;
			$this->intCantidad = $cantidad;
			$this->strPresentacioncomercial = $presentacionComercial;
			$this->strRegistrosanitario = $registroSanitario;

				$query_insert  = "INSERT INTO insumos (idTipoproducto,fabricante,lote, fecha_entrada, fecha_vencimiento, cantidad, presentacionComercial,registroSanitario) 
				                  VALUES (?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->intTipoproducto,
        						$this->strFabricante,
        						$this->strLote,
								$this->dateFechaEntrada,
								$this->dateFechaVence,
								$this->intCantidad,
								$this->strPresentacioncomercial,
							    $this->strRegistrosanitario,);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			
	        return $return;
		}


	}
 ?>