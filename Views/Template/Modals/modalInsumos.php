<!-- Modal -->
<div class="modal fade" id="modalFormInsumos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Insumo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formInsumo" name="formInsumo" class="form-horizontal">
              <input type="hidden" id="idInsumo" name="idInsumo" value="">
             
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
              <div class="row">
                <div class="col-md-12">

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="listCategoria">Tipo categoria</label>
                    <select class="form-control" data-live-search="true" id="listCategoria" onchange="fntproductosxCategoria()" name="listCategoria" required >
                           <option value="">Selecciona una opción</option>
                    </select>

                </div>

                <div class="form-group col-md-6">
                    <label for="listProductosxcategoria">Producto</label>
                    <select class="form-control"  data-live-search="true" id="listProductosxcategoria" name="listProductosxcategoria" required >
                    </select>
                </div>
             </div>

             <div class="row">
                 <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Fabricante <span class="required">*</span></label>
                      <input class="form-control" id="txtFabricante" name="txtFabricante" type="text" placeholder="Nombre  de Fabricante" required="">
                     </div>

                     <div class="form-group">
                      <label class="control-label">Lote <span class="required">*</span></label>
                      <input class="form-control" id="txtLote" name="txtLote" type="text" placeholder="Numero de Lote" required="">                      
                    </div> 


                 </div>

                 <div class="col-md-6">
                 <div class="form-group">
                        <label class="control-label">Fecha Vencimiento <span class="required">*</span></label>
                        <input class="form-control" id="txtFechaVencimiento" name="txtFechaVencimiento" type="date" placeholder="Fecha de Vencimiento" min="<?php echo date('Y-m-d'); ?>" required="">
                 </div>

                    <div class="form-group">
                      <label class="control-label">Cantidad de Ingreso <span class="required">*</span></label>
                      <input class="form-control" id="txtCantidad" name="txtCantidad" type="number" min="1" oninput="validarNumero()" placeholder="Cantidad de Ingreso" required="">
                    </div>
                 </div>

             </div>
                  
            </div>
               
              </div>
              
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewInsumo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Insumos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Categoria:</td>
              <td id="celCategoria"></td>
            </tr>
            <tr>
              <td>Producto:</td>
              <td id="celProducto"></td>
            </tr>
            <tr>
              <td>Fabricante:</td>
              <td id="celFabricante"></td>
            </tr>
            <tr>
              <td>Lote:</td>
              <td id="celLote"></td>
            </tr>
            <tr>
              <td>Fecha Ingreso:</td>
              <td id="celFechaingreso"></td>
            </tr>
            <tr>
              <td>Fecha Vencimiento:</td>
              <td id="celFechavencimiento"></td>
            </tr>

            <tr>
              <td>Dias por vencer:</td>
              <td id="celDias"></td>
            </tr>
            <tr>
              <td>Cantidad Ingresada:</td>
              <td id="celCantidad"></td>
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

