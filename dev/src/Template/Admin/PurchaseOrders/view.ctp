<section class="content-header">
  <h1>
    <?php echo __('Orden de Compra'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-arrow-left"></i> ' . __('Volver al listado de solicitudes'), ['controller' => 'Requests', 'action' => 'index'], ['escape' => false])?>
    </li>
    <li>
    <?= $this->Html->link('<i class="fa fa-wrench"></i> ' . __('Volver a la solicitud'), ['controller' => 'Requests', 'action' => 'view', $purchaseOrder->request_id], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Información'); ?></h3>
                <?php
                    if(is_null($purchaseOrder->active))
                    {
                        echo $this->Form->postLink(__('Rechazar Orden de Compra'), ['controller' => 'PurchaseOrders', 'action' => 'reject', $purchaseOrder->id], ['confirm' => __('Estas seguro que quieres rechazar la orden de compra {0}?', $purchaseOrder->id), 'class'=>'btn btn-danger btn-xs pull-right']); 

                        echo $this->Form->postLink(__('Aprobar Orden de Compra'), ['controller' => 'PurchaseOrders', 'action' => 'Approve', $purchaseOrder->id], ['confirm' => __('Estas seguro de aprobar la orden de compra {0}?', $purchaseOrder->id), 'class'=>'btn btn-success btn-xs pull-right']); 
                    }
                    else
                    {
                        switch ($purchaseOrder->active) {
                            case 1:
                                echo $this->Html->tag('span', 'Aceptada', ['class' => 'label label-success pull-right']);
                                break;

                            case 0:
                                echo $this->Html->tag('span', 'Rechazada', ['class' => 'label label-danger pull-right']);
                                break;

                            case null:
                                echo $this->Html->tag('span', 'En Revisión', ['class' => 'label label-warning pull-right']);
                                break;
                        }
                    }
                ?>  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <?= $this->Html->tag('h4', 'Información general', ['class' => 'text-center']); ?>
                        <dl class="dl-horizontal">
                            <dt><?= __('Orden de trabajo') ?></dt>
                            <dd>
                                <?= $purchaseOrder->has('request') ? $purchaseOrder->request->ot_code : '' ?>
                            </dd>
                                                                                            
                            <dt><?= __('Auto') ?></dt>
                            <dd>
                                <?= '['.$purchaseOrder->request->car->patent.'] '.$purchaseOrder->request->car->year.' '.$purchaseOrder->request->car->car_brand->brand_name.' '.$purchaseOrder->request->car->car_model->model_name.' ('.$purchaseOrder->request->car->mileage.' kms)'; ?>
                            </dd>            
                            
                            <dt><?= __('Cliente') ?></dt>
                            <dd>
                                <?= $purchaseOrder->request->client->name.' '.$purchaseOrder->request->client->last_name ?>
                            </dd>   

                            <dt><?= __('Mecánico asignado') ?></dt>
                            <dd>
                                <?= ($purchaseOrder->request->mechanic_id != null) ? $purchaseOrder->request->mechanic->name.' '.$purchaseOrder->request->mechanic->last_name : 'No tiene';?>
                            </dd>                                                                                                        
                                                                                                                                                                                            
                            <dt><?= __('Estado') ?></dt>
                            <dd>
                                <?php
                                    if(is_null($purchaseOrder->active))
                                    {
                                        echo 'Esperando aprobación';
                                    }
                                    elseif($purchaseOrder->active == 1)
                                    {
                                        echo 'Aprobado';
                                    }
                                    else
                                    {
                                        echo 'Rechazado';
                                    }
                                ?>
                            </dd>
                                                                            
                        </dl>
                    </div>
                    <div class="col-sm-6">
                        <?= $this->Html->tag('h4', 'Servicios a realizar', ['class' => 'text-center']); ?>
                        <dl class="dl-horizontal">
                            <?php foreach($purchaseOrder->request->available_services as $service):?>
                                <dt><?= $service->requests_type->name ?></dt>
                                <dd>
                                    <?= $service->name ?>
                                </dd>
                            <?php endforeach;?>    
                        </dl>
                    </div>
                </div>
                    
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('{0} Relacionados', ['Repuestos']) ?></h3>

                    <?php
                        if(is_null($purchaseOrder->active))
                        {
                            echo $this->Form->button('Agregar Repuesto', ['class' => 'btn btn-success btn-xs pull-right', 'data-toggle' => 'modal', 'data-target' => '#addReplacement']);
                        }
                    ?>  
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($purchaseOrderReplacements)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>                                                        
                                <th>
                                    Repuesto
                                </th>                                                     
                                <th>
                                    Proveedor
                                </th>
                                <?php if(is_null($purchaseOrder->active)):?>  
                                    <th>
                                        <?php echo __('Acciones'); ?>
                                    </th>
                                <?php endif;?>
                            </tr>

                            <?php foreach ($purchaseOrderReplacements as $replacement): ?>
                                <tr>                                                        
                                    <td>
                                        <?= h($replacement->replacement->name) ?>
                                    </td>
                                                                        
                                    <td>
                                        <?= h($replacement->provider->name) ?>
                                    </td>
                                    
                                    <?php if(is_null($purchaseOrder->active)):?>                                                               
                                        <td class="actions">
                                            <?= $this->Form->postLink(__('Quitar'), ['controller' => 'PurchaseOrdersReplacements', 'action' => 'delete', $replacement->id], ['confirm' => __('Estas seguro de quitar el respuesto {0} de la orden de compra?', $replacement->replacement->name), 'class'=>'btn btn-danger btn-xs']); ?>    
                                        </td>
                                    <?php endif;?>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('{0} Relacionados', ['Insumos']) ?></h3>
                    <?php
                        if(is_null($purchaseOrder->active))
                        {
                            echo $this->Form->button('Agregar Insumo', ['class' => 'btn btn-success btn-xs pull-right', 'data-toggle' => 'modal', 'data-target' => '#addSupply']);
                        }
                    ?>  
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($purchaseOrderSupplies)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>                                                        
                                <th>
                                    Insumo
                                </th>                                                     
                                <th>
                                    Proveedor
                                </th>
                                <?php if(is_null($purchaseOrder->active)):?>
                                    <th>
                                        <?php echo __('Acciones'); ?>
                                    </th>
                                <?php endif;?>
                            </tr>

                            <?php foreach ($purchaseOrderSupplies as $supply): ?>
                                <tr>                                                        
                                    <td>
                                        <?= h($supply->supply->name) ?>
                                    </td>
                                                                        
                                    <td>
                                        <?= h($supply->provider->name) ?>
                                    </td>
                                    
                                    <?php if(is_null($purchaseOrder->active)):?>                                                    
                                        <td class="actions">
                                            <?= $this->Form->postLink(__('Quitar'), ['controller' => 'PurchaseOrdersSupplies', 'action' => 'delete', $supply->id], ['confirm' => __('Estas seguro de quitar el insumo {0} de la orden de compra?', $supply->supply->name), 'class'=>'btn btn-danger btn-xs']) ?>    
                                        </td>
                                    <?php endif;?>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<?php  if(is_null($purchaseOrder->active)):?>
    <div class="modal fade" id="addReplacement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Repuesto a la Orden de Compra</h4>
                </div>
                <?= $this->Form->create('PurchaseOrdersReplacements', ['url' => ['controller' => 'PurchaseOrdersReplacements', 'action' => 'add'], 'class' => 'form']) ?>
                    <div class="modal-body">
                        <?= $this->Form->hidden('purchase_order_id', ['value' => $purchaseOrder->id]); ?>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Proveedor</label>
                            <?= $this->Form->select('provider_id', $providers, ['class' => 'form-control', 'label' => false, 'type' => 'select']);?>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Repuesto</label>
                            <?= $this->Form->select('replacement_id', $replacements, ['class' => 'form-control', 'label' => false, 'type' => 'select']);?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <?= $this->Form->button('Agregar', ['class' => 'btn btn-primary', 'type' => 'submit']); ?>
                    </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSupply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Insumo a la Orden de Compra</h4>
                </div>
                <?= $this->Form->create('PurchaseOrdersSupplies', ['url' => ['controller' => 'PurchaseOrdersSupplies', 'action' => 'add'], 'class' => 'form']) ?>
                    <div class="modal-body">
                        <?= $this->Form->hidden('purchase_order_id', ['value' => $purchaseOrder->id]); ?>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Proveedor</label>
                            <?= $this->Form->select('provider_id', $providers, ['class' => 'form-control', 'label' => false, 'type' => 'select']);?>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Insumo</label>
                            <?= $this->Form->select('supply_id', $supplies, ['class' => 'form-control', 'label' => false, 'type' => 'select']);?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <?= $this->Form->button('Agregar', ['class' => 'btn btn-primary', 'type' => 'submit']); ?>
                    </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
<?php endif;?>