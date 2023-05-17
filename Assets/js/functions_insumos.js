let tableInsumos;

// Pintamos en una tabla todos los insumos obtenidos por la petición
document.addEventListener('DOMContentLoaded', function(){

    tableInsumos = $('#idTableinsumos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": base_url+"/insumos/getInsumos",
            "dataSrc":""
        },
        "columns":[
            {"data":"nombreCategoria"},
            {"data":"nombre"},
            {"data":"fabricante"},
            {"data":"lote"},
            {"data":"fecha_entrada"},
            {"data":"fecha_vencimiento"},
            {"data":"dias"},
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
           
    
    //NUEVO INSUMO
      var formInsumo = document.querySelector("#formInsumo");
      formInsumo.onsubmit = function(e, id) {
        e.preventDefault();
        let intTipocategoria = document.querySelector('#listCategoria').value;
        let intProducto= document.querySelector('#listProductosxcategoria').value;
        let strFabricante = document.querySelector('#txtFabricante').value; 
        let strLote = document.querySelector('#txtLote').value; 
        let strFehavencimiento = document.querySelector('#txtFechaVencimiento').value; 
        let intCantidad = document.querySelector('#txtCantidad').value; 
        
        if(intTipocategoria == '' || intProducto == '' || strFabricante == '' || strLote == '' || strFehavencimiento == '' || intCantidad == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }

        divLoading.style.display = "flex";
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/insumos/setInsumo'; 
        let formData = new FormData(formInsumo);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                console.log(objData);
                if(objData.status)
                {
                    if(rowTable == ""){
                        tableInsumos.api().ajax.reload();
                    }else{

                        rowTable.cells[1].textContent = intCategoria;
                        rowTable.cells[2].textContent = intProducto;
                        rowTable.cells[3].innerHTML = strFabricante;
                        rowTable.cells[4].innerHTML = strLote;
                        rowTable.cells[5].innerHTML = strFehavencimiento;
                        rowTable.cells[6].innerHTML = intCantidad;
                        rowTable = "";
                    }

                    $('#modalFormInsumos').modal("hide");
                    formInsumo.reset();
                    swal("Insumo", objData.msg ,"success");
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }        
      }

}, false);

// se ejecuta apenas carga la pagina 
// Función para obtener la lista de categorias y poder adicionarselas al select de categoria
function fntCategorias(){
    if(document.querySelector('#listCategoria')){
        let ajaxUrl = base_url+'/Categorias/getSelectCategorias';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listCategoria').innerHTML = request.responseText;
                $('#listCategoria').selectpicker('render');
            }
        }
    }
}

// Funcion para obtener los productos dependiendo la categoria seleccioanda
function fntproductosxCategoria() {
    var miSelect = document.getElementById("listCategoria");
    var valorSeleccionado = miSelect.value;
  
    let ajaxUrl = base_url+'/Tipoproductos/getTipoproductoxCategoria/'+valorSeleccionado;
  
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();
  
    request.onreadystatechange = function() {
      if(request.readyState == 4 && request.status == 200) {
        var listProducto = document.getElementById("listProductosxcategoria");
        listProducto.innerHTML = '<option value="">Selecciona un producto</option>'; // limpia el contenido anterior del select
        listProducto.innerHTML = request.responseText; // agrega las nuevas opciones
        $('#listProductosxcategoria').selectpicker('refresh'); // actualiza el selectpicker
      }
    }
  }

// Función para visualizar un insumo en especifico
function fntViewInfoInsumo(id){

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/insumos/getInsumo/'+id;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector("#celCategoria").innerHTML = objData.data.nombreCategoria;
                document.querySelector("#celProducto").innerHTML = objData.data.nombre;
                document.querySelector("#celFabricante").innerHTML = objData.data.fabricante;
                document.querySelector("#celLote").innerHTML = objData.data.lote;
                document.querySelector("#celFechaingreso").innerHTML = objData.data.fecha_entrada;
                document.querySelector("#celFechavencimiento").innerHTML = objData.data.fecha_vencimiento;
                document.querySelector("#celCantidad").innerHTML = objData.data.cantidad;
                document.querySelector("#celDias").innerHTML = objData.data.dias;
                $('#modalViewInsumo').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

  // Función para validar si en el campo cantidad se ingreso un numero mayor a 0
  function validarNumero() {
    var inputNumero = document.getElementById("txtCantidad");
    if (inputNumero.value <= 0) {
        inputNumero.setCustomValidity("El número debe ser mayor que 0");
    } else {
        inputNumero.setCustomValidity("");
    }
}

function openModal()
{
    rowTable = "";
    document.querySelector('#idInsumo').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Insumo";
    document.querySelector("#formInsumo").reset();
    fntCategorias();
    $('#modalFormInsumos').modal('show');
}

