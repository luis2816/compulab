<?php 

	class StockModel extends Mysql
	{
		

		public function __construct()
		{
			parent::__construct();
		}


		public function selectStock()
		{
			$sql = "SELECT c.nombre as nombreCategoria, t.nombre,s.cantidad FROM stock as s
			inner join tipoproducto as t on t.id=s.id_Tipoproducto
			inner join categoria as c on c.idcategoria=t.categoria
			order by s.cantidad asc;";
			$request = $this->select_all($sql);
			return $request;
		}

	}
 ?>