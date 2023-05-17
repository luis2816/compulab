let tableInsumos;
var tablaSelecionados = document.getElementById("insumosSeleccionados");
// Pintamos en una tabla todos los insumos obtenidos por la petición
document.addEventListener('DOMContentLoaded', function(){
   // Seleccionar la tabla
 
  // Ocultar la tabla
  tablaSelecionados.style.display = "none";

    tableInsumos = $('#idTablaInsumos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/insumos/getInsumosEntrega",
            "dataSrc":""
        },
        "columns":[
            {"data":"id"},
            {"data":"nombre"},
            {"data":"cantidad"},
            {"data":"options"}

        ],
        'buttons': [
         
        ],
        'dom': 'lBfrtip',
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });
           
 //NUEVO detalleEntrega
 var formInsumo = document.querySelector("#formEntrega");
 formInsumo.onsubmit = function(e, id) {
   e.preventDefault();
   let intSede = document.querySelector('#listSedes').value;
   
   if(intSede == '')
   {
       swal("Atención", "Todos los campos son obligatorios." , "error");
       return false;
   }

   // Obtener la referencia de la tabla
var tabla = document.getElementById("idTablaSeleccionados");

var datos = [];
const codigo = generarCodigoFactura();
console.log("esta es el codigo" + codigo);
for (var i = 1; i < tabla.rows.length; i++) {
  var fila = tabla.rows[i];
  var filaDatos = {};

  var celdas = fila.cells;
  filaDatos.id = celdas[0].innerText;
  filaDatos.producto = celdas[1].innerText;
  filaDatos.cantidad = celdas[2].innerText;
  filaDatos.sede=intSede;
  filaDatos.codigofactura= codigo;
  datos.push(filaDatos);
}

console.log(datos);
fetch(base_url+"/entregas/setEntrega", {
  method: "POST",
  headers: {
    "Content-Type": "application/json"
  },
  body: JSON.stringify(datos)
})
.then(response => response.json())
.then(data => {
  $('#modalFormEntregas').modal("hide");
  formEntrega.reset();
  swal("Exitoso", "Registro exitoso" , "success");
 //Limpiar la tabla de los insumos seleccionados

  var filas = tabla.getElementsByTagName("tr");
  
  while (filas.length > 0) {
    tabla.deleteRow(0);
  }
   // Ocultar la tabla
   tabla.style.display = "none";
   tablaSelecionados.style.display = "none";
})
.catch(error => {
  console.error("Error en la petición:", error);
});        
 }
      

}, false);


// Función para obtener la lista de sedes y poder adicionarselas al select de sedes
function fntSedes(){
  console.log("estoy aqui");
  if(document.querySelector('#listSedes')){
    let ajaxUrl = base_url+'/sedes/getSelectsedesEntrega';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#listSedes').innerHTML = request.responseText;
            $('#listSedes').selectpicker('render');
        }
    }
}
}

function obtenerDatos(boton) {

    const tabla2 = document.getElementById("idTablaSeleccionados");

    let fila = $(boton).closest('tr');
    let id = fila.find('td:nth-child(1)').text();
    let producto = fila.find('td:nth-child(2)').text();
    
   
    // Buscar el elemento en la tabla 2
    let elementoTabla2;
    for (let i = 0; i < tabla2.rows.length; i++) {
      const fila = tabla2.rows[i];
      if (fila.cells[0].textContent === id) {
        elementoTabla2 = fila;
        break;
      }
    }
    
    // Verificar si el elemento se encuentra en la tabla 2
    if (elementoTabla2) {
      console.log(`El elemento con id  ya se encuentra en la tabla 2.`);
        // Actualizar Cantidad
        const campoAActualizar = elementoTabla2.cells[2]; 
        const valorActual = parseInt(campoAActualizar.textContent);
        campoAActualizar.textContent = valorActual + 1;

    } else {
      console.log(`El elemento con id no se encuentra en la tabla 2.`);
       // Agregar fila a la tabla de destino
       let tablaDestino = document.getElementById('idTablaSeleccionados');
       let nuevaFila = tablaDestino.insertRow();
       let celdaId = nuevaFila.insertCell(0);
       let celdaProducto = nuevaFila.insertCell(1);
       let celCantidad = nuevaFila.insertCell(2);
       let option = nuevaFila.insertCell(3);

       celdaId.innerHTML = id;
       celdaProducto.innerHTML = producto;
       celCantidad.innerHTML = '1';
       option.innerHTML= '<div class="text-center"><button class="btn btn-primary btn-sm " onclick="adicionarProducto(this)" title="Adicionar"><i class="fa fa-plus-circle" aria-hidden="true"></i>' +
       '</button> <button class="btn btn-warning  btn-sm " onclick="disminuirProducto(this)" title="Disminuir"><i class="fas fa-minus-circle" aria-hidden="true"></i>' + 
       '</button> <button class="btn btn-danger btn-sm" onclick="eliminarFila(this)" title="Eliminar" ><i class="fa fa-trash" aria-hidden="true"></i></button></div>';
       tablaSelecionados.style.display = "table";

    }
  }

function eliminarFila(btnEliminar) {
  $(btnEliminar).closest('tr').remove();
  const tabla2 = document.getElementById("idTablaSeleccionados");
  var contenido = document.getElementById("insumosSeleccionados");
  const productos= tabla2.rows.length;

  if((productos - 1)==0){
    contenido.style.display = "none";
  }
  }

function adicionarProducto(boton){
    const tabla1 = document.getElementById("idTablaInsumos");
    let fila = $(boton).closest('tr');
    let id = fila.find('td:nth-child(1)').text();
    // Buscar el elemento en la tabla 2
  
    let elementoTabla1;
    for (let i = 0; i < tabla1.rows.length; i++) {
      const fila = tabla1.rows[i];
      if (fila.cells[0].textContent === id) {
        elementoTabla1 = fila;
        break;
      }
    }

     // Verificar si el elemento se encuentra en la tabla 2
     if (elementoTabla1) {
       
        const cantidadTalab1 = elementoTabla1.cells[2]; 
        const valorTabla1 = parseInt(cantidadTalab1.textContent);
        let cantidad = fila.find('td:nth-child(3)');
        let cantidadActual = parseInt(cantidad.text());
              if(valorTabla1 >  cantidadActual){

                      cantidad.html(cantidadActual + 1);
              }else{
                      swal("Atención", "La cantidad es la maxima" , "error");
             } 

    }
}

function disminuirProducto(boton){
    let fila = $(boton).closest('tr');
    let cantidad = fila.find('td:nth-child(3)');
    let cantidadActual = parseInt(cantidad.text());

    if(cantidadActual>0){
      
      cantidad.html(cantidadActual - 1);
    }else{
      swal("Atención", "La cantidad debera ser mayor de 0" , "error");
    }
   
  }

  $('button').click(function() {
    obtenerDatos(this);
  });

function generarCodigoFactura() {
  // Generar un número aleatorio de 6 dígitos
  const numeroAleatorio = Math.floor(Math.random() * 900000) + 100000;

  // Obtener la fecha actual
  const fecha = new Date();
  const año = fecha.getFullYear();
  const mes = fecha.getMonth() + 1;
  const dia = fecha.getDate();

  // Formatear la fecha en formato YYYYMMDD
  const fechaFormateada = `${año}${mes < 10 ? '0' + mes : mes}${dia < 10 ? '0' + dia : dia}`;

  // Combinar el número aleatorio y la fecha formateada
  const codigoFactura = `${fechaFormateada}-${numeroAleatorio}`;

  return codigoFactura;
}

function openModal()
{

    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#titleModal').innerHTML = "Selecciona una sede";
    document.querySelector("#formEntrega").reset();
    fntSedes();
    $('#modalFormEntregas').modal('show');
}
