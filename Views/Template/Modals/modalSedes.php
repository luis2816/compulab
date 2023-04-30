<!-- Modal -->
<div class="modal fade" id="modalFormSedes" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Sede</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formSede" name="formSede">
                <input type="hidden" id="idSede" name="idSede" value="">
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre de la Sede" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Dirección</label>
                  <textarea class="form-control" id="txtDireccion" name="txtDireccion" rows="2" placeholder="Dirección de sede" required=""></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Teléfono</label>
                  <input class="form-control" id="txtTelefono" name="txtTelefono" type="number" placeholder="Telefono de la Sede" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Email</label>
                  <input class="form-control" id="txtEmail" name="txtEmail" type="email" placeholder="Correo Electronico de la Sede" required="">
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Estado</label>
                    <select class="form-control" id="listStatus" name="listStatus" required="">
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    </select>
                </div>
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalViewSede" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos de la Sede</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Nombre:</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celDireccion"></td>
            </tr>
            <tr>
              <td>Apellidos:</td>
              <td id="celTelefono">Jacob</td>
            </tr>
            <tr>
              <td>Teléfono:</td>
              <td id="celEmail">Larry</td>
            </tr>
            <tr>
              <td>Email (Usuario):</td>
              <td id="celEstado">Larry</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


