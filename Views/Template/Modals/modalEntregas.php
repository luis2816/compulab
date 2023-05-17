<!-- Modal -->
<div class="modal fade" id="modalFormEntregas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Insumo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formEntrega" name="formEntrega" class="form-horizontal">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
              <div class="row">
                <div class="col-md-12">

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="listSedes">Sede</label>
                    <select class="form-control" data-live-search="true" id="listSedes"  name="listSedes" required >
                           <option value="">Selecciona una opción</option>
                    </select>

                </div>

             </div>
                  
            </div>
               
              </div>
              
              <div class="tile-footer">
                <input id="btnActionForm" value="Generar Entrega" class="btn btn-primary" type="submit"></input>
                <input class="btn btn-danger" value="Cerrar" type="button" data-dismiss="modal"></input>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>