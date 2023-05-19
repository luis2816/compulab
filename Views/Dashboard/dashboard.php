<?php headerAdmin($data); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">Dashboard</div>
          </div>
       
        </div>
      </div>

      <div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="<?= base_url(); ?>/usuarios">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuarios</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800" id="totalUser"></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

        
		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="<?= base_url(); ?>/roles">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Roles</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800" id="totalRoles"></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-user fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
        	<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="<?= base_url(); ?>/categorias">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Categorias</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800" id="totalCategoria"></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-tags fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

        <a class="col-xl-3 col-md-6 mb-4" href="<?= base_url(); ?>/tipoproductos">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tipo productos</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800" id="totalProducto"></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-cube fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

        <a class="col-xl-3 col-md-6 mb-4" href="<?= base_url(); ?>/sedes">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sedes</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800" id="totalSede"></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
        <a class="col-xl-3 col-md-6 mb-4" href="<?= base_url(); ?>/insumos">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Insumos</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800" id="totalInsumo"></div>
						</div>
						<div class="col-auto">
                           <i class="fas fa-archive fa-2x text-gray-300"></i>
                        </div>

					</div>
				</div>
			</div>
		</a>

		<a class="col-xl-3 col-md-6 mb-4" href="<?= base_url(); ?>/entregas">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Generar entregas</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800" ></div>
						</div>
						<div class="col-auto">
                           <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>

					</div>
				</div>
			</div>
		</a>

		<a class="col-xl-3 col-md-6 mb-4" href="<?= base_url(); ?>/stock">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kardex</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800" ></div>
						</div>
						<div class="col-auto">
                             <i class="fas fa-archive fa-2x text-gray-300"></i>
                        </div>

					</div>
				</div>
			</div>
		</a>
</div>
    </main>
<?php footerAdmin($data); ?>