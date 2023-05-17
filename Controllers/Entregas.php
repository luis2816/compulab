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




		public function setEntrega(){
			// Obtener los datos enviados en la solicitud
$datos = json_decode(file_get_contents("php://input"), true);

// Verificar si se recibieron los datos correctamente
if ($datos) {
  // Procesar los datos recibidos
  foreach ($datos as $dato) {
    $id = $dato['id'];
    $cantidad = $dato['cantidad'];
	$tipoproducto = $dato['producto'];
	$intSede = $dato['sede'];
	$strCodigoFactura=$dato['codigofactura'];
    
   
	if($_SESSION['permisosMod']['w']){
		$request_user = $this->model->insertEntrega( $id, $cantidad,$intSede,$strCodigoFactura);
	  }

	  if($request_user > 0){
		
			$arrResponse = array('status' => true, 'msg' => 'Creación correcta' );
	}


    // Hacer lo que necesites con los datos, por ejemplo, insertarlos en una base de datos
    // ...
  }
  
  // Enviar una respuesta de éxito
  $respuesta = array('mensaje' => 'Datos recibidos y procesados correctamente');
  echo json_encode($respuesta);
} else {
  // Enviar una respuesta de error si los datos no se recibieron correctamente
  $respuesta = array('error' => 'No se recibieron los datos correctamente');
  echo json_encode($respuesta);
}
		}
	}

	


 ?>