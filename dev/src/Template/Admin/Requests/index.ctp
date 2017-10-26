<section class="content-header">
    <h1>
        Solicitudes
        <small>Listado con solicitudes en fullmec</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-dashboard']).' Dashboard', ['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]); ?>
        </li>
        <li class="active">Solicitudes</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                  <i class="fa fa-wrench"></i>

                  <h3 class="box-title">Listado de solicitudes</h3>
                  <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-plus']).' '.$this->Html->tag('i', '', ['class' => 'fa fa-wrench']), ['controller' => 'Requests', 'action' => 'add'], ['escape' => false, 'class' => 'btn btn-success pull-right']);?>
                </div>

                <div class="box-body">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php foreach ($requests as $request): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <?php

                                        $status_text = '';
                                        $status_icon = '';
                                        switch ($request->status) {
                                            case 1:
                                                $status_text = 'Abierta';
                                                $status_icon = 'glyphicon-exclamation-sign';
                                                $status_color = 'text-info';
                                                break;

                                            case 2:
                                                $status_text = 'En Curso';
                                                $status_icon = 'glyphicon-screenshot';
                                                $status_color = 'text-success';
                                                break;

                                            case 3:
                                                $status_text = 'Anulada por Cliente';
                                                $status_icon = 'glyphicon-minus-sign';
                                                $status_color = 'text-danger';
                                                break;

                                            case 4:
                                                $status_text = 'Anulada por Mecánico';
                                                $status_icon = 'glyphicon-minus-sign';
                                                $status_color = 'text-danger';
                                                break;

                                            case 5:
                                                $status_text = 'Finalizada';
                                                $status_icon = 'glyphicon-ok-sign';
                                                $status_color = 'text-success';
                                                break;

                                            case 6:
                                                $status_text = 'En Espera de Trabajo';
                                                $status_icon = 'glyphicon-info-sign';
                                                $status_color = 'text-warning';
                                                break;

                                            case 7:
                                                $status_text = 'Pagado';
                                                $status_icon = 'glyphicon-credit-card';
                                                $status_color = 'text-success';
                                                break;

                                            case 8:
                                                $status_text = 'En Espera de Pago';
                                                $status_icon = 'glyphicon-info-sign';
                                                $status_color = 'text-warning';
                                                break;
                                            case 9:
                                                $status_text = 'Modifcaciones Mecanico';
                                                $status_icon = 'glyphicon-info-sign';
                                                $status_color = 'text-warning';
                                                break;
                                            case 10:
                                                $status_text = 'En Espera de Pago Modificaciones';
                                                $status_icon = 'glyphicon-info-sign';
                                                $status_color = 'text-warning';
                                                break;
                                            case 11:
                                                $status_text = 'Requiere Inspeccion';
                                                $status_icon = 'glyphicon-info-sign';
                                                $status_color = 'text-warning';
                                                break;
                                        }


                                        echo $this->Html->link(
                                            $this->Html->div('row',
                                                $this->Html->div('col-sm-3',
                                                    $this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-wrench']).' ['.$request->car->year.'] '.$this->Html->tag('strong', $request->car->car_brand->brand_name).' '.$request->car->car_model->model_name
                                                ).
                                                $this->Html->div('col-sm-3',
                                                    $this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-wrench']).' '.
                                                    (count($request->available_services) > 1) ? count($request->available_services).' Servicios' : count($request->available_services).' Servicio'
                                                ).
                                                $this->Html->div('col-sm-3',
                                                    $this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-user']).' '.'Solicitado por: '.$request->client->name.' '.$request->client->last_name
                                                ).
                                                $this->Html->div('col-sm-3',
                                                    $this->Html->tag('i', '', ['class' => 'glyphicon '.$status_icon.' '.$status_color]).' '.$status_text
                                                )
                                            ),
                                            '#request-'.$request->id,
                                            [
                                                'escape' => false,
                                                'role' => 'button',
                                                'data-toggle' => 'collapse',
                                                'class' => 'collapsed',
                                                'data-parent' => '#accordion',
                                                'aria-expanded' => false,
                                                'aria-controls' => '#request-'.$request->id
                                            ]
                                        );
                                    ?>
                                </div>
                                <div id="<?= 'request-'.$request->id?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <br>
                                    <div class="panel-body">
                                        <?php if($request->ot_code != null):?>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        <?= $this->Html->div('text-center', 'Orden de Trabajo: '.$this->Html->tag('strong', $request->ot_code)); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif;?>
                                        <div class="row">

                                            <div class="col-sm-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><?= (count($request->available_services) >= 2) ? 'Servicios Solicitados' : 'Servicio Solicitado'?></div>
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <?php if(count($request->available_services) > 0):?>

                                                                <?php
                                                                    $total_supplies= 0;
                                                                    $total_replacements= 0;
                                                                    $total_services= 0;
                                                                ?>




                                                                    <?php foreach($request->available_services as $available_service):?>

                                                                        <?php if(count($request->available_services) == 1 ):?>
                                                                            <div class="col-sm-12">
                                                                        <?php elseif(count($request->available_services) % 2 == 0):?>

                                                                            <?php if(count($request->available_services) == 2):?>
                                                                                <div class="col-sm-6">
                                                                            <?php else:?>
                                                                                <div class="col-sm-3">
                                                                            <?php endif;?>

                                                                        <?php else: ?>

                                                                            <?php if(count($request->available_services) == 3):?>
                                                                                <div class="col-sm-4">
                                                                            <?php else:?>
                                                                                <div class="col-sm-3">
                                                                            <?php endif;?>
                                                                        <?php endif;?>

                                                                            <?php
                                                                                $total_services += $available_service->total_price;
                                                                                $total_replacements += $available_service->replacements_price;
                                                                                $total_supplies += $available_service->supplies_price;
                                                                            ?>
                                                                            <div class="box box-solid">
                                                                                <div class="box-header with-border">
                                                                                    <i class="fa fa-text-width"></i>

                                                                                    <h3 class="box-title"><?= $available_service->name; ?></h3>
                                                                                </div>

                                                                                <div class="box-body">

                                                                                    <?php if(count($available_service->supplies) > 0 || count($available_service->replacements) > 0):?>
                                                                                        <ul>
                                                                                            <?php if(count($available_service->replacements) > 0):?>
                                                                                                <li>Repuestos asociados
                                                                                                    <ul>
                                                                                                        <?php foreach($available_service->replacements as $replacement):?>
                                                                                                            <li><?= $replacement->name?></li>
                                                                                                        <?php endforeach;?>
                                                                                                    </ul>
                                                                                                </li>
                                                                                            <?php endif;?>
                                                                                            <?php if(count($available_service->supplies) > 0):?>
                                                                                                <li>Insumos asociados
                                                                                                    <ul>
                                                                                                        <?php foreach($available_service->supplies as $supply):?>
                                                                                                            <li><?= $supply->name?></li>
                                                                                                        <?php endforeach;?>
                                                                                                    </ul>
                                                                                                </li>
                                                                                            <?php endif;?>
                                                                                        </ul>
                                                                                    <?php endif;?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach;?>
                                                            <?php endif;?>

                                                        </div>


                                                        <?= (count($request->available_services) > 1) ? 'Total a pagar por los servicios: ' : 'Total a pagar por el servicio: '?><br>
                                                        <?= $this->Html->tag('strong', $this->Number->format(($total_services + $total_supplies + $total_replacements), ['before' => '$ ','after' => ' CLP']));?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">



                                            <?php if($request->mechanic != null):?>
                                                <div class="col-sm-4">
                                            <?php else:?>
                                                <div class="col-sm-6">
                                            <?php endif;?>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">Información del Vehiculo</div>
                                                    <div class="panel-body">
                                                        <br>
                                                        <dl class="dl-horizontal">
                                                            <dt>Patente</dt>
                                                            <dd><?= $request->car->patent; ?></dd>
                                                            <dt>Marca</dt>
                                                            <dd><?= $request->car->car_brand->brand_name; ?></dd>
                                                            <dt>Modelo</dt>
                                                            <dd><?= $request->car->car_model->model_name; ?></dd>
                                                            <dt>Año</dt>
                                                            <dd><?= $request->car->year; ?></dd>
                                                            <dt>Kilometraje</dt>
                                                            <dd><?= $request->car->mileage; ?></dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php if($request->mechanic != null):?>
                                                <div class="col-sm-4">
                                            <?php else:?>
                                                <div class="col-sm-6">
                                            <?php endif;?>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">Información del Cliente</div>
                                                    <div class="panel-body">
                                                        <br>
                                                        <dl class="dl-horizontal">
                                                            <dt>Nombre</dt>
                                                            <dd><?= $request->client->name.' '.$request->client->last_name; ?></dd>
                                                            <dt>Email</dt>
                                                            <dd><?= $request->client->email; ?></dd>
                                                            <dt>Teléfono</dt>
                                                            <dd><?= $request->client->phone1; ?></dd>
                                                            <dt>Dirección del trabajo a realizar</dt>
                                                            <dd><?= $request->address_name.' '.$request->address_number.' '.$request->address_complement.' . '.$request->commune->name.', '.$request->city->name; ?></dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>


                                            <?php if($request->mechanic != null):?>
                                                <div class="col-sm-4">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><?= 'Mecánico asignado'?></div>
                                                        <div class="panel-body">
                                                            <br>
                                                            <dt>Nombre</dt>
                                                            <dd><?= $request->mechanic->name.' '.$request->mechanic->last_name; ?></dd>
                                                            <dt>Email</dt>
                                                            <dd><?= $request->mechanic->email; ?></dd>
                                                            <dt>Teléfono</dt>
                                                            <dd><?= $request->mechanic->phone1; ?></dd>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                        <?php if($request->ot_code != null):?>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><?= 'Ordenes de compra'?></div>
                                                        <div class="panel-body">
                                                            <br>

                                                            <?php if(count($request->purchase_orders) > 0):?>
                                                                <ul>
                                                                    <?php foreach($request->purchase_orders as $purchase_order):?>
                                                                        <li>

                                                                            <?php
                                                                                switch ($purchase_order->active) {


                                                                                    case 1:
                                                                                        echo $this->Html->tag('span', 'Aceptada', ['class' => 'label label-success']);
                                                                                        break;

                                                                                    case 0:
                                                                                        echo $this->Html->tag('span', 'Rechazada', ['class' => 'label label-danger']);
                                                                                        break;

                                                                                    case null:
                                                                                        echo $this->Html->tag('span', 'En Revisión', ['class' => 'label label-warning']);
                                                                                        break;
                                                                                }
                                                                            ?>

                                                                            <?= $this->Html->link('Orden de compra Nº'.$purchase_order->id.' ['.
                                                                                    $this->Html->tag('small',
                                                                                        (count($purchase_order->replacements) >=2) ?
                                                                                            count($purchase_order->replacements).' repuestos' :
                                                                                            count($purchase_order->replacements).' repuesto, '
                                                                                    ).', '.
                                                                                    $this->Html->tag('small',
                                                                                        (count($purchase_order->supplies) >=2) ?
                                                                                            count($purchase_order->supplies).' insumos' :
                                                                                            count($purchase_order->supplies).' insumo'
                                                                                    )
                                                                                    .']',
                                                                                    ['controller' => 'PurchaseOrders', 'action' => 'view', $purchase_order->id],
                                                                                    ['escape' => false]
                                                                                );
                                                                            ?>

                                                                            <?php if($request->status == 7):?>
                                                                                <?php if(is_null($purchase_order->active)):?>
                                                                                    &nbsp;&nbsp;&nbsp;
                                                                                    <?= $this->Html->link('Aprobar', ['controller' => 'PurchaseOrders', 'action' => 'approve', $purchase_order->id], ['confirm' => __('Estas seguro de aceptar la orden de compra Nº{0}? Se enviará un correo electronico al administrador de adquisiones.', $purchase_order->id)]);?>
                                                                                <?php endif;?>

                                                                                &nbsp;&nbsp;&nbsp;
                                                                                <?= $this->Form->postLink('Eliminar', ['controller' => 'PurchaseOrders', 'action' => 'delete', $purchase_order->id], ['confirm' => __('¿Está seguro que desea eliminar la orden de compra #{0}?', $purchase_order->id)]) ?>
                                                                            <?php endif;?>
                                                                        </li>
                                                                    <?php endforeach;?>
                                                                </ul>
                                                            <?php else:?>
                                                                <?= $this->Html->tag('strong', 'No existen ordenes de compra para esta solicitud', ['class' => 'text-danger'])?>
                                                            <?php endif;?>

                                                            <?php if($request->status == 7):?>
                                                                <br><?= $this->Html->link('Crear orden de compra', ['controller' => 'PurchaseOrders', 'action' => 'add', $request->id], ['class' => 'btn btn-defaul']);?>
                                                            <?php endif;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">
                                                <?= $this->Html->link($this->Html->tag('glyphicon glyphicon-search').' '.'Detalles', ['controller' => 'Requests', 'action' => 'view', $request->id], ['escape' => false]);?>
                                            </button>

                                            <?php if($request->status != 3 && $request->status != 4):?>

                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php
                                                        $pass = true;
                                                        if($request->purchase_orders != null)
                                                        {
                                                            foreach($request->purchase_orders as $purchase_order)
                                                            {
                                                                if(is_null($purchase_order->active))
                                                                {
                                                                    $pass = false;
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                    <?php if($request->mechanic_id != null && $request->status == 5):?>
                                                        <li>
                                                            <?= $this->Html->link('Calificar mecánico', ['controller' => 'Requests', 'action' => 'qualify', $request->id]);?>
                                                        </li>
                                                    <?php elseif($request->mechanic_id != null && $request->status == 2):?>
                                                        <li>
                                                            <?= $this->Html->link('Marcar Finalizado', ['controller' => 'Requests', 'action' => 'markFinish', $request->id]);?>
                                                        </li>
                                                        <li role="separator" class="divider"></li>
                                                        <li>
                                                            <?= $this->Html->link('Cancelar como Cliente', ['controller' => 'Requests', 'action' => 'cancelByClient',$request->id]);?>
                                                        </li>
                                                        <li>
                                                            <?= $this->Html->link('Cancelar como Mecánico', ['controller' => 'Requests', 'action' => 'cancelByMechanic',$request->id]);?>
                                                        </li>
                                                    <?php elseif($request->mechanic_id != null && $request->status == 6 && $pass == true):?>

                                                        <li>
                                                            <?= $this->Html->link('Marcar en curso', ['controller' => 'Requests', 'action' => 'markInCourse', $request->id]);?>
                                                        </li>
                                                        <li role="separator" class="divider"></li>
                                                        <li>
                                                            <?= $this->Html->link('Cancelar como Cliente', ['controller' => 'Requests', 'action' => 'cancelByClient',$request->id]);?>
                                                        </li>
                                                        <li>
                                                            <?= $this->Html->link('Cancelar como Mecánico', ['controller' => 'Requests', 'action' => 'cancelByMechanic',$request->id]);?>
                                                        </li>


                                                    <?php elseif($request->status == 8 && count($request->payment) > 0):?>

                                                        <?php if($request->payment->paid == 0):?>
                                                            <li>
                                                                <?= $this->Html->link('Marcar como pagado', ['controller' => 'Payments', 'action' => 'markAsPaid', $request->payment->id]);?>
                                                            </li>
                                                        <?php endif;?>

                                                        <li role="separator" class="divider"></li>
                                                        <li>
                                                            <?= $this->Html->link('Cancelar como Cliente', ['controller' => 'Requests', 'action' => 'cancelByClient',$request->id]);?>
                                                        </li>

                                                    <?php elseif(count($request->payment) == 0):?>
                                                        <li>
                                                          <?= $this->Html->link('Agregar Pago', ['controller' => 'Payments', 'action' => 'add', $request->id]);?>
                                                        </li>

                                                        <?php if($request->mechanic_id != null): ?>
                                                            <li>
                                                                <?= $this->Html->link('Cambiar Mecánico', ['controller' => 'Requests', 'action' => 'editMechanic', $request->id]);?>
                                                            </li>
                                                        <?php else:?>
                                                            <li>
                                                                <?= $this->Html->link('Asignar Mecánico', ['controller' => 'Requests', 'action' => 'assignMechanic', $request->id]);?>
                                                            </li>
                                                        <?php endif;?>


                                                          <li role="separator" class="divider"></li>
                                                          <li>
                                                              <?= $this->Html->link('Cancelar como Cliente', ['controller' => 'Requests', 'action' => 'cancelByClient',$request->id]);?>
                                                          </li>

                                                    <?php elseif($request->mechanic_id != null && $request->status == 6):?>
                                                        <li>
                                                            <?= $this->Html->link('Agregar Pago', ['controller' => 'Payments', 'action' => 'add', $request->id]);?>
                                                        </li>
                                                        <li role="separator" class="divider"></li>
                                                        <li>
                                                            <?= $this->Html->link('Cancelar como Cliente', ['controller' => 'Requests', 'action' => 'cancelByClient',$request->id]);?>
                                                        </li>
                                                    <?php else:?>
                                                        <li>
                                                            <?= $this->Html->link('Cancelar como Cliente', ['controller' => 'Requests', 'action' => 'cancelByClient',$request->id]);?>
                                                        </li>
                                                    <?php endif;?>
                                                </ul>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>

        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</section>
