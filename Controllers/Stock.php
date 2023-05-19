<?php
	class Stock extends Controllers{
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
			getPermisos(8);
		}

		public function Stock()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Kardex";
			$data['page_title'] = "KARDEX <small>Compulab</small>";
			$data['page_name'] = "Kardex";
			$data['page_functions_js'] = "functions_stock.js";
			$this->views->getView($this,"stock",$data);
		}

		public function getStock()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectStock();
				for ($i=0; $i < count($arrData); $i++) {


					if($arrData[$i]['cantidad'] > 50)
					{
						$arrData[$i]['estado'] = '<span class="badge badge-success">Disponible</span>';
					}else if($arrData[$i]['cantidad'] >10 and $arrData[$i]['cantidad'] <=50 ){
						$arrData[$i]['estado'] = '<span class="badge badge-warning">Pendiente</span>';
					}else{
						$arrData[$i]['estado'] = '<span class="badge badge-danger">Agotado</span>';
					}

				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}


 ?>