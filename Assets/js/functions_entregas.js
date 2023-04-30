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
            {"data":"fecha_vencimiento"},
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
           

      

}, false);

function obtenerDatos(boton) {

    const tabla2 = document.getElementById("idTablaSeleccionados");

    let fila = $(boton).closest('tr');
    let id = fila.find('td:nth-child(1)').text();
    let producto = fila.find('td:nth-child(2)').text();
    let fechaVencimiento = fila.find('td:nth-child(3)').text();
    
   
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
        const campoAActualizar = elementoTabla2.cells[3]; 
        const valorActual = parseInt(campoAActualizar.textContent);
        campoAActualizar.textContent = valorActual + 1;

    } else {
      console.log(`El elemento con id no se encuentra en la tabla 2.`);
       // Agregar fila a la tabla de destino
       let tablaDestino = document.getElementById('idTablaSeleccionados');
       let nuevaFila = tablaDestino.insertRow();
       let celdaId = nuevaFila.insertCell(0);
       let celdaProducto = nuevaFila.insertCell(1);
       let celdaFechaVence = nuevaFila.insertCell(2);
       let celCantidad = nuevaFila.insertCell(3);
       let option = nuevaFila.insertCell(4);

       celdaId.innerHTML = id;
       celdaProducto.innerHTML = producto;
       celdaFechaVence.innerHTML = fechaVencimiento;
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
       
        const cantidadTalab1 = elementoTabla1.cells[3]; 
        const valorTabla1 = parseInt(cantidadTalab1.textContent);
        let cantidad = fila.find('td:nth-child(4)');
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
    let cantidad = fila.find('td:nth-child(4)');
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
