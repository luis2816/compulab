<?php
	class Insumos extends Controllers{
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
			getPermisos(6);
		}

		public function Insumos()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Insumos";
			$data['page_title'] = "INSUMOS <small>Compulab</small>";
			$data['page_name'] = "insumos";
			$data['page_functions_js'] = "functions_insumos.js";
			$this->views->getView($this,"insumos",$data);
		}

		public function getInsumos()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectInsumos();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';
					
                   
					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfoInsumo('.$arrData[$i]['id'].')" title="Ver Insumo"><i class="far fa-eye"></i></button>';
					}
				
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				   
					
				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getInsumosEntrega()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectInsumosEntregas();
				for ($i=0; $i < count($arrData); $i++) {
					$btnSelect = '';
					
                   
					if($_SESSION['permisosMod']['r']){
						$btnSelect = '<button  onClick="obtenerDatos(this)" title="Seleccionar Insumo"><i class="fas fa-check-circle text-success"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnSelect.' </div>';
				   
					
				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setInsumo(){
			if($_POST){			
				if(empty($_POST['listCategoria']) || empty($_POST['listProductosxcategoria']) || empty($_POST['txtFabricante'])
				        || empty($_POST['txtLote']) || empty($_POST['txtFechaVencimiento']) || empty($_POST['txtCantidad']) 
						|| empty($_POST['txtPresentacioncomercial']) || empty($_POST['txtRegistrosanitario']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}

				else{ 
					$idTipoproducto = intval($_POST['listProductosxcategoria']);
					$strFabricate = strClean($_POST['txtFabricante']);
					$strLote = strClean($_POST['txtLote']);
					$strFechavence = ($_POST['txtFechaVencimiento']);
					$intCantidad = intval(strClean($_POST['txtCantidad']));
					$strPresentacioncomercial = strClean($_POST['txtPresentacioncomercial']);
					$strRegistrosanitario = strClean($_POST['txtRegistrosanitario']);
					$fecha_actual = date("Y-m-d");

					  if($_SESSION['permisosMod']['w']){
						$request_user = $this->model->insertInsumo( $idTipoproducto, $strFabricate, $strLote,
					                                                $fecha_actual, $strFechavence,$intCantidad,
																	$strPresentacioncomercial,$strRegistrosanitario);
					  }

					  if($request_user > 0){
						
							$arrResponse = array('status' => true, 'msg' => 'Creación correcta' );
					}

				}

			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}
	}


		public function getInsumo(int $id)
		{
			if($_SESSION['permisosMod']['r']){
				$intId = intval(strClean($id));
				if($intId > 0)
				{
					$arrData = $this->model->selectInsumo($intId);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
	}  



 ?>