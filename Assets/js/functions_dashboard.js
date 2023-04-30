document.addEventListener('DOMContentLoaded', function(){

        // Obtén el elemento div por su ID
        const divElementUser = document.getElementById('totalUser');
        const divElementRol = document.getElementById('totalRoles');
        const divElementCategoria = document.getElementById('totalCategoria');
        const divElementProducto = document.getElementById('totalProducto');
        const divElementSede = document.getElementById('totalSede');
        const divElementInsumo = document.getElementById('totalInsumo');
    
        var request= (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/dashboard/getCount';
        
        request.open("GET",ajaxUrl,true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
         
                // Cambia el contenido de texto utilizando textContent
                divElementUser.textContent = objData.totalusuarios;
                divElementRol.textContent = objData.totalRoles;
                divElementCategoria.textContent = objData.totalCategoria;
                divElementProducto.textContent = objData.totalProductos;
                divElementSede.textContent = objData.totalSedes;
                divElementInsumo.textContent = objData.totalInsumos;

            }
        }
        // Envía la petición AJAX
        request.send(); 

}, false);


