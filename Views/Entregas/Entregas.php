<?php 
    headerAdmin($data); 
?>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-box-tissue"></i> <?= $data['page_title'] ?>
        
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/categorias"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-6">
              <div class="tile"> 
                <div class="tile-body">  
                  <div class="table-responsive">
                 <h1>Lista de Insumos</h1>
                  <table class="table table-hover table-bordered" id="idTablaInsumos">
                      <thead>
                        <tr> 
                          <th>ID</th>                       
                          <th>Producto</th>
                          <th>Fecha vencimiento</th>
                          <th>Cantidad</th>
                          <th>Agregar</th>

                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6" id="insumosSeleccionados">
              <div class="tile"> 
                <div class="tile-body">  
                  <div class="table-responsive">
                  <div>
                     <h1><i class="fas fa-box-tissue"></i>Productos seleccionados             
                   <button class="btn btn-primary" type="button"  ><i class="fas fa-plus-circle"></i> Generar entrega</button>
         
            </h1>
        </div>

          <table class="table table-hover table-bordered" id="idTablaSeleccionados" >
           <thead>
                 <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Fecha vencimiento</th>
                    <th>Cantidad</th>
                   <th>Eliminar</th>
                </tr>
            </thead>
           <tbody>
          </tbody>
         </table>

                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>
<?php footerAdmin($data); ?>
    