<section class="content-header">
    <h1>
        Reportes
        <small>Listado de reportes y extracción de información</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-dashboard']).' Dashboard', ['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]); ?>
        </li>
        <li class="active">Reportes</li>
    </ol>
</section>


<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-info">
	            <div class="box-header with-border">
	            	<h3 class="box-title">Pagos</h3>
	            </div>
	            <div class="box-body text-center">
	            	<div class="row">
						<div class="col-sm-6">
							<?= 
								$this->Html->link(
									$this->Html->div('info-box',
										$this->Html->tag('span', $this->Html->tag('i', '', ['class' => 'fa fa-cogs']), ['class' => 'info-box-icon bg-aqua']).
										$this->Html->div('info-box-content',
											$this->Html->tag('span', 'Pagos a Mecánicos', ['class' => 'info-box-text']).
											$this->Html->tag('span', 'Se exporta información de pagos no realizados a mecánicos de un mes y un año determinado', ['class' => 'info-box-number'])
										)
									),
									[
										'controller' => 'Payments',
										'action' => 'exportData'
									],
									[
										'escape' => false,
										'style' => 'color:#333;'
									]
								);
							?>
						</div>

						<div class="col-sm-6">
							<?= 
								$this->Html->link(
									$this->Html->div('info-box',
										$this->Html->tag('span', $this->Html->tag('i', '', ['class' => 'fa fa-building']), ['class' => 'info-box-icon bg-aqua']).
										$this->Html->div('info-box-content',
											$this->Html->tag('span', 'Pago a proveedores', ['class' => 'info-box-text']).
											$this->Html->tag('span', 'Se exporta información para el pago a proveedores agregados al sistema entre 2 fechas determinadas', ['class' => 'info-box-number'])
										)
									),
									[
										'controller' => 'Providers',
										'action' => 'exportData'
									],
									[
										'escape' => false,
										'style' => 'color:#333;'
									]
								);
							?>
						</div>
					</div>
	            </div>
	        </div>

	        <div class="box box-warning">
	            <div class="box-header with-border">
	            	<h3 class="box-title">Productos</h3>
	            </div>
	            <div class="box-body text-center">
	            	<div class="row">
						<!--<div class="col-sm-6">
							<?php 
								/*$this->Html->link(
									$this->Html->div('info-box',
										$this->Html->tag('span', $this->Html->tag('i', '', ['class' => 'fa fa-truck']), ['class' => 'info-box-icon bg-yellow']).
										$this->Html->div('info-box-content',
											$this->Html->tag('span', 'Exportar Insumos', ['class' => 'info-box-text']).
											$this->Html->tag('span', 'Se exporta información de insumos agregados al sistema entre 2 fechas determinadas', ['class' => 'info-box-number'])
										)
									),
									[
										'controller' => 'Supplies',
										'action' => 'exportData'
									],
									[
										'escape' => false,
										'style' => 'color:#333;'
									]
								);*/
							?>
						</div>-->

						<!--<div class="col-sm-6">
							<?php 
								/*$this->Html->link(
									$this->Html->div('info-box',
										$this->Html->tag('span', $this->Html->tag('i', '', ['class' => 'fa fa-cogs']), ['class' => 'info-box-icon bg-yellow']).
										$this->Html->div('info-box-content',
											$this->Html->tag('span', 'Exportar Repuestos', ['class' => 'info-box-text']).
											$this->Html->tag('span', 'Se exporta información de los repuestos agregados al sistema entre 2 fechas determinadas', ['class' => 'info-box-number'])
										)
									),
									[
										'controller' => 'Replacements',
										'action' => 'exportData'
									],
									[
										'escape' => false,
										'style' => 'color:#333;'
									]
								);*/
							?>
						</div>-->
						<div class="col-sm-6">
							<?= 
								$this->Html->link(
									$this->Html->div('info-box',
										$this->Html->tag('span', $this->Html->tag('i', '', ['class' => 'fa fa-files-o']), ['class' => 'info-box-icon bg-yellow']).
										$this->Html->div('info-box-content',
											$this->Html->tag('span', 'Inventario de productos', ['class' => 'info-box-text']).
											$this->Html->tag('span', 'Se despliega la lista de todos los productos del sistema con el detalle correspondiente', ['class' => 'info-box-number'])
										)
									),
									[
										'controller' => 'Reports',
										'action' => 'productsSearch'
									],
									[
										'escape' => false,
										'style' => 'color:#333;'
									]
								);
							?>
						</div>

						<div class="col-sm-6">
							<?= 
								$this->Html->link(
									$this->Html->div('info-box',
										$this->Html->tag('span', $this->Html->tag('i', '', ['class' => 'fa fa-truck']), ['class' => 'info-box-icon bg-yellow']).
										$this->Html->div('info-box-content',
											$this->Html->tag('span', 'Pedidos Históricos a Proveedores', ['class' => 'info-box-text']).
											$this->Html->tag('span', 'Despliega información de las ordenes de compra con sus insumos asociados en un determinado tiempo (Mes / Año)', ['class' => 'info-box-number'])
										)
									),
									[
										'controller' => 'PurchaseOrders',
										'action' => 'orders_search'
									],
									[
										'escape' => false,
										'style' => 'color:#333;'
									]
								);
							?>
						</div>

						
					</div>
	            </div>
	        </div>

	        <div class="box box-danger">
	            <div class="box-header with-border">
	            	<h3 class="box-title">Ventas</h3>
	            </div>
	            <div class="box-body text-center">
	            	<div class="row">
	            		<div class="col-sm-6">
							<?= 
								$this->Html->link(
									$this->Html->div('info-box',
										$this->Html->tag('span', $this->Html->tag('i', '', ['class' => 'fa fa-money']), ['class' => 'info-box-icon bg-red']).
										$this->Html->div('info-box-content',
											$this->Html->tag('span', 'Estadisticas de venta', ['class' => 'info-box-text']).
											$this->Html->tag('span', 'Despliega información sobre las ventas efectivas realizadas en un rango de tiempo (Mes / Año)', ['class' => 'info-box-number'])
										)
									),
									[
										'controller' => 'Requests',
										'action' => 'sales_search'
									],
									[
										'escape' => false,
										'style' => 'color:#333;'
									]
								);
							?>
						</div>
						<div class="col-sm-6">
							<?= 
								$this->Html->link(
									$this->Html->div('info-box',
										$this->Html->tag('span', $this->Html->tag('i', '', ['class' => 'fa fa-money']), ['class' => 'info-box-icon bg-red']).
										$this->Html->div('info-box-content',
											$this->Html->tag('span', 'Sueldos pagados', ['class' => 'info-box-text']).
											$this->Html->tag('span', 'Despliega los pagos realizados a los mecánicos en un mes/año determinado', ['class' => 'info-box-number'])
										)
									),
									[
										'controller' => 'Payments',
										'action' => 'salaryPaidSearch'
									],
									[
										'escape' => false,
										'style' => 'color:#333;'
									]
								);
							?>
						</div>
					</div>
	            </div>
	        </div>
		</div>
	</div>
</section>