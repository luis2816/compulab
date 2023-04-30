<?php
	class Tipoproductos extends Controllers{
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
			getPermisos(5);
		}

		public function Tipoproductos()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Tipo Productos";
			$data['page_title'] = "TIPO PRODUCTOS <small>Compulab</small>";
			$data['page_name'] = "tipo productos";
			$data['page_functions_js'] = "functions_tipoproductos.js";
			$this->views->getView($this,"tipoproductos",$data);
		}
		public function getTipoproductos()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectTipoproductos();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['estado'] == 1)
					{
						$arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewTipoproducto('.$arrData[$i]['id'].')" title="Ver Tipo producto"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditTipoproducto(this,'.$arrData[$i]['id'].')" title="Editar Tipo producto"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelTipoproducto('.$arrData[$i]['id'].')" title="Eliminar Tipo producto"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getTipoproductosInsumo()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectTipoproductos();
				for ($i=0; $i < count($arrData); $i++) {
					$btnSelect = '';
	
						$btnSelect = '<button class="btn btn-success btn-sm" onClick="openModalSelectInsumos('.$arrData[$i]['id'].')" title="Seleccionar Tipo producto"><i class="fas fa-plus"></i></button>';
					
					$arrData[$i]['options'] = '<div class="text-center">'.$btnSelect.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getTipoproducto(int $id)
		{
			if($_SESSION['permisosMod']['r']){
				$intId = intval(strClean($id));
				if($intId > 0)
				{
					$arrData = $this->model->selectTipoproducto($intId);
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

		public function getTipoproductoxCategoria(int $id){
			$htmlOptions = "";
			$arrData = $this->model->selectTipoproductoxCategoria($id);
		    
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					$htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre'].'</option>';
					
				}
			}
			echo $htmlOptions;
			die();	
	
		}

		

		public function setTipoproducto(){
			if($_POST){			
				if(empty($_POST['txtNombre']) || empty($_POST['listTipocategoria']) || empty($_POST['listStatus']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$id = intval($_POST['id']);
					$strNombre = strClean($_POST['txtNombre']);
					$intTipocategoria = intval(strClean($_POST['listTipocategoria']));
					$intEstado = intval(strClean($_POST['listStatus']));
					
					if($id == 0)
					{
						

						if($_SESSION['permisosMod']['w']){
							$request_user = $this->model->insertTipoproduto( $strNombre, $intTipocategoria, $intEstado);
						}
						$option = 1;
				   }else{
						
						if($_SESSION['permisosMod']['u']){
							$request_user = $this->model->updateTipoproducto($id,$strNombre, $intTipocategoria, $intEstado);
						}
						$option = 2;

					}

					if($request_user > 0)
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'msg' => 'Creación correcta' );
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_user == 0){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el tipo de producto ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.' );
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function delTipoproducto()
		{
			if($_POST){
	
					$intIdtipoproducto = intval($_POST['id']);
					$requestDelete = $this->model->deleteTipoproducto($intIdtipoproducto);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Sede');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Sede.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			}
			die();
		}



	}


 ?>