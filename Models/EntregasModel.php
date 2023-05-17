<?php 

	class EntregasModel extends Mysql
	{
		 private $idEntrega;
	     private $idProducto;
		 private $intcantidad_salida;
		 private $strfecha;
		 private $intSede;
		 private $strCodigoFactura;
		public function __construct()
		{
			parent::__construct();
		}

		public function insertEntrega( int $idproducto, int $cantidadSalida, int $idSede, string $codigoFactura){

			$this->idProducto = $idproducto;
			$this->intcantidad_salida = $cantidadSalida;
			$this->intSede = $idSede;
			$this->strCodigoFactura = $codigoFactura;
			
				$query_insert  = "INSERT INTO detalleentrega (idtipoProducto,cantidad_salida,id_sede,codigoFactura) 
				                  VALUES (?,?,?,?)";
	        	$arrData = array($this->idProducto,
        						$this->intcantidad_salida,
								$this->intSede,
							    $this->strCodigoFactura,);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			
	        return $return;
		}


	}
 ?>