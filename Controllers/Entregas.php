<?php
	class Entregas extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(7);
		}

		public function Entregas()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Entregas";
			$data['page_title'] = "ENTREGAS <small>Compulab</small>";
			$data['page_name'] = "entregas";
			$data['page_functions_js'] = "functions_entregas.js";
			$this->views->getView($this,"entregas",$data);
		}

	}


 ?>