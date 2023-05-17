<?php 

	class Sedes extends Controllers{
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
			getPermisos(3);
		}

		public function Sedes()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 3;
			$data['page_tag'] = "Sedes";
			$data['page_name'] = "Sedes";
			$data['page_title'] = "Sedes <small> Compulab</small>";
			$data['page_functions_js'] = "functions_sedes.js";
			$this->views->getView($this,"sedes",$data);
		}

		public function getSedes()
		{
			if($_SESSION['permisosMod']['r']){
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData = $this->model->selectSedes();

				for ($i=0; $i < count($arrData); $i++) {

					if($arrData[$i]['estado'] == 1)
					{
						$arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					
						$btnView = '<button class="btn btn-info btn-sm btnViewSede" onClick="fntViewSede('.$arrData[$i]['id'].')" title="Ver Sede"><i class="far fa-eye"></i></button>';
						$btnEdit = '<button class="btn btn-primary  btn-sm btnEditSede" onClick="fntEditSede(this,'.$arrData[$i]['id'].')" title="Editar sede"><i class="fas fa-pencil-alt"></i></button>';
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelSede" onClick="fntDelSede('.$arrData[$i]['id'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>
					</div>';
					
					$arrData[$i]['opciones'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getSelectSedes()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectSedes();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

		public function getSede(int $id)
		{
			if($_SESSION['permisosMod']['r']){
				$intIdsede = intval(strClean($id));
				if($intIdsede > 0)
				{
					$arrData = $this->model->selectSede($intIdsede);
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

		public function setSede(){
			if($_SESSION['permisosMod']['w']){

				$intIdsede = intval($_POST['idSede']);
				$strNombre =  strClean($_POST['txtNombre']);
				$strDireccion = strClean($_POST['txtDireccion']);
				$strTelefono = strClean($_POST['txtTelefono']);
				$strEmail = strClean($_POST['txtEmail']);
				$intStatus = intval($_POST['listStatus']);

				if($intIdsede == 0)
				{
					//Crear
					$request_sede = $this->model->insertSede($strNombre, $strDireccion,$strTelefono, $strEmail, $intStatus);
					$option = 1;
				}else{
					//Actualizar
					$request_sede= $this->model->updateSede($intIdsede, $strNombre, $strDireccion,$strTelefono, $strEmail, $intStatus);
					$option = 2;
				}

				if($request_sede > 0 )
				{
					if($option == 1)
					{
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}
				}else if($request_sede == 'exist'){
					
					$arrResponse = array('status' => false, 'msg' => '¡Atención! La sede  ya existe.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function delSede()
		{
			if($_POST){
	
					$intIdsede = intval($_POST['idSede']);
					$requestDelete = $this->model->deleteSede($intIdsede);
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

		
		public function getSelectsedesEntrega(){
			$htmlOptions = "";
			$arrData = $this->model->selectSedes();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					
					$htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre'].'</option>';
					
				}
			}
			echo $htmlOptions;
			die();	
		}


	}
 ?>