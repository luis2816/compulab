<?php 

	class TipoproductosModel extends Mysql
	{
		private $intIdproducto;
		private $strNombre;
		private $intCategoria;
		private $intStatus;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectTipoproductos()
		{
			$sql = "SELECT t.id, t.nombre, (c.nombre) as categoria, t.estado FROM `tipoproducto` as t 
			         inner join categoria as c on t.categoria=c.idcategoria;
					 WHERE t.estado >= 0 ";
			$request = $this->select_all($sql);
			return $request;
		}
		
		public function selectTipoproducto(int $id)
		{
		  $this->intIdproducto= $id;
			$sql = "SELECT t.id, t.nombre, categoria, c.nombre as nombreCategoria, t.estado FROM `tipoproducto` as t 
			         inner join categoria as c on t.categoria=c.idcategoria
					 WHERE t.estado >= 0  and t.id =  $this->intIdproducto";
			$request = $this->select($sql);
			return $request;
		}

		public function selectTipoproductoxCategoria(int $idCategoria)
		{
		  $this->intCategoria= $idCategoria;
			$sql = "SELECT * FROM tipoproducto
			WHERE categoria= $this->intCategoria";
			$request = $this->select_all($sql);
			return $request;
		}


		public function updateTipoproducto(int $id, string $nombre, string $idTipoproducto, int $estado){

			$this->intIdproducto = $id;
			$this->strNombre = $nombre;
			$this->intCategoria = $idTipoproducto;
			$this->intStatus = $estado;

			
					$sql = "UPDATE tipoproducto SET nombre=?, categoria=?, estado=?
							WHERE id = $this->intIdproducto ";
					$arrData = array($this->strNombre,
	        						$this->intCategoria,
	        						$this->intStatus);
			
				$request = $this->update($sql,$arrData);
			    return $request;
		
		}


		public function insertTipoproduto(string $nombre, int $idTipocategoria, int $estado){

			$this->strNombre = $nombre;
			$this->intCategoria = $idTipocategoria;
			$this->intStatus = $estado;
			$return = 0;

			$sql = "SELECT * FROM tipoproducto where categoria= $this->intCategoria and nombre = '{$this->strNombre}'";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tipoproducto(nombre,categoria,estado) 
								  VALUES(?,?,?)";
	        	$arrData = array($this->strNombre,
        						$this->intCategoria,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = 0;
			}
	        return $return;
		}

		public function deleteTipoproducto(int $id)
		{
			$this->intIdproducto = $id;

				$sql = "UPDATE tipoproducto SET estado = ? WHERE id = $this->intIdproducto ";
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