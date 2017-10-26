<section class="content-header">
  <h1>
    <?php echo __('Available Service'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
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
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                        <dt><?= __('Requests Type') ?></dt>
                                <dd>
                                    <?= $availableService->has('requests_type') ? $availableService->requests_type->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($availableService->name) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Estimated Time') ?></dt>
                                <dd>
                                    <?= $this->Number->format($availableService->estimated_time) ?>
                                </dd>
                                                                                                                <dt><?= __('Real Estimated Time') ?></dt>
                                <dd>
                                    <?= $this->Number->format($availableService->real_estimated_time) ?>
                                </dd>
                                                                                                                <dt><?= __('Total Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($availableService->total_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Supplies Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($availableService->supplies_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Replacements Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($availableService->replacements_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Mechanic Pay') ?></dt>
                                <dd>
                                    <?= $this->Number->format($availableService->mechanic_pay) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                                                        <dt><?= __('Active') ?></dt>
                            <dd>
                            <?= $availableService->active ? __('Yes') : __('No'); ?>
                            </dd>
                                                    <dt><?= __('Inspection') ?></dt>
                            <dd>
                            <?= $availableService->inspection ? __('Yes') : __('No'); ?>
                            </dd>
                                                                    
                                                                        <dt><?= __('Description') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($availableService->description)); ?>
                            </dd>
                                                            </dl>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Request Services']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($availableService->request_services)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Request Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Available Service Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($availableService->request_services as $requestServices): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($requestServices->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requestServices->request_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requestServices->available_service_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requestServices->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'RequestServices', 'action' => 'view', $requestServices->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'RequestServices', 'action' => 'edit', $requestServices->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RequestServices', 'action' => 'delete', $requestServices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestServices->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Abilities']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($availableService->abilities)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Description
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($availableService->abilities as $abilities): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($abilities->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($abilities->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($abilities->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($abilities->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Abilities', 'action' => 'view', $abilities->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Abilities', 'action' => 'edit', $abilities->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Abilities', 'action' => 'delete', $abilities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abilities->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Replacements']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($availableService->replacements)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Description
                                    </th>
                                        
                                                                    
                                    <th>
                                    Original Price
                                    </th>
                                        
                                                                    
                                    <th>
                                    Price For Request
                                    </th>
                                        
                                                                    
                                    <th>
                                    Stock
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($availableService->replacements as $replacements): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($replacements->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($replacements->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($replacements->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($replacements->original_price) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($replacements->price_for_request) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($replacements->stock) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($replacements->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Replacements', 'action' => 'view', $replacements->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Replacements', 'action' => 'edit', $replacements->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Replacements', 'action' => 'delete', $replacements->id], ['confirm' => __('Are you sure you want to delete # {0}?', $replacements->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Supplies']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($availableService->supplies)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Description
                                    </th>
                                        
                                                                    
                                    <th>
                                    Total Price
                                    </th>
                                        
                                                                    
                                    <th>
                                    Price For Request
                                    </th>
                                        
                                                                    
                                    <th>
                                    Stock
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($availableService->supplies as $supplies): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($supplies->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($supplies->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($supplies->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($supplies->total_price) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($supplies->price_for_request) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($supplies->stock) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($supplies->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Supplies', 'action' => 'view', $supplies->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Supplies', 'action' => 'edit', $supplies->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Supplies', 'action' => 'delete', $supplies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplies->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Requests']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($availableService->requests)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Client Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Mechanic Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Car Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Address Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Address Number
                                    </th>
                                        
                                                                    
                                    <th>
                                    Address Complement
                                    </th>
                                        
                                                                    
                                    <th>
                                    City Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Commune Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Status
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                    
                                    <th>
                                    Total Price
                                    </th>
                                        
                                                                    
                                    <th>
                                    Supplies Price
                                    </th>
                                        
                                                                    
                                    <th>
                                    Replacements Price
                                    </th>
                                        
                                                                    
                                    <th>
                                    Mechanic Pay
                                    </th>
                                        
                                                                    
                                    <th>
                                    Start Time Schedule Requested
                                    </th>
                                        
                                                                    
                                    <th>
                                    Type Documents Payment
                                    </th>
                                        
                                                                    
                                    <th>
                                    Ot Code
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($availableService->requests as $requests): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($requests->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->client_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->mechanic_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->car_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->address_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->address_number) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->address_complement) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->city_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->commune_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->status) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->active) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->total_price) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->supplies_price) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->replacements_price) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->mechanic_pay) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->start_time_schedule_requested) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->type_documents_payment) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($requests->ot_code) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Requests', 'action' => 'view', $requests->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Requests', 'action' => 'edit', $requests->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Requests', 'action' => 'delete', $requests->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requests->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
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
