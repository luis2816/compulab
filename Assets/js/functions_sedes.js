var tableSedes;
var divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){

	tableSedes = $('#tableSedes').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Sedes/getSedes",
            "dataSrc":""
        },
        "columns":[
            {"data":"id"},
            {"data":"nombre"},
            {"data":"direccion"},
            {"data":"telefono"},
            {"data":"email"},
            {"data":"estado"},
            {"data":"opciones"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });


  
    //NUEVA SEDE
    var formSede = document.querySelector("#formSede");
    formSede.onsubmit = function(e) {
        e.preventDefault();

        var strNombre = document.querySelector('#txtNombre').value;
        var strDireccion = document.querySelector('#txtDireccion').value;
        var strTelefono = document.querySelector('#txtTelefono').value;
        var strEmail = document.querySelector('#txtEmail').value;
        var intStatus = document.querySelector('#listStatus').value;        
        if(strNombre == '' || strDireccion == '' || strTelefono == '' || strEmail == '' || intStatus == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Sedes/setSede'; 
        var formData = new FormData(formSede);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                $('#modalFormSedes').modal("hide");
                formSede.reset();
                swal("Sedes de Compulab", objData.msg ,"success");
                tableSedes.api().ajax.reload();
            }else{
                swal("Error", objData.msg , "error");
            }  
                            
            } 
            divLoading.style.display = "none";
            return false;
        }

        
    }

});

$('#tableSedes').DataTable();

function fntViewSede(idsede){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Sedes/getSede/'+ idsede;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
               let estadoSede = objData.data.estado == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celNombre").innerHTML = objData.data.nombre;
                document.querySelector("#celDireccion").innerHTML = objData.data.direccion;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.email;
                document.querySelector("#celEstado").innerHTML = estadoSede;
                $('#modalViewSede').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}


function fntEditSede(element,idSede){
    
    rowTable = element.parentNode.parentNode.parentNode; 
    document.querySelector('#titleModal').innerHTML ="Actualizar Sede";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Sedes/getSede/'+idSede;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#idSede").value = objData.data.id;
                document.querySelector("#txtNombre").value = objData.data.nombre;
                document.querySelector("#txtDireccion").value = objData.data.direccion;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                document.querySelector("#txtEmail").value = objData.data.email;

                if(objData.data.estado == 1){
                    document.querySelector("#listStatus").value = 1;
                }else{
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');
            }
        }
    
        $('#modalFormSedes').modal('show');
    }
}

function fntDelSede(idSede){
    swal({
        title: "Eliminar Sede",
        text: "¿Realmente quiere eliminar la Sede?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Sedes/delSede';
            let strData = "idSede="+idSede;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    console.log(request.responseText);
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableSedes.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

function openModal(){


    document.querySelector('#idSede').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Sede";
    document.querySelector("#formSede").reset();
	$('#modalFormSedes').modal('show');
}