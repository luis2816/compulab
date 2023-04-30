<?php

class DashboardModel extends Mysql
	{

		public function __construct()
		{
			parent::__construct();
		}

        public function getCount(){

         $sql= "SELECT   COUNT(idpersona)  as totalusuarios,
         (SELECT COUNT(idrol) from rol) as totalRoles, 
         (SELECT COUNT(idcategoria) FROM categoria) as totalCategoria,
         (SELECT COUNT(id) FROM tipoproducto) as totalProductos,
         (SELECT COUNT(id) FROM sede) as totalSedes,
         (SELECT COUNT(id) FROM insumos) as totalInsumos
         from persona;";

         $request= $this-> select($sql);
         return $request;

}

    }



?>