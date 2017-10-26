<section class="content-header">
  <h1>
    <?php echo __('Car'); ?>
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
                                                                                                        <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $car->has('user') ? $car->user->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Car Brand') ?></dt>
                                <dd>
                                    <?= $car->has('car_brand') ? $car->car_brand->brand_name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Car Model') ?></dt>
                                <dd>
                                    <?= $car->has('car_model') ? $car->car_model->model_name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Patent') ?></dt>
                                        <dd>
                                            <?= h($car->patent) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Year') ?></dt>
                                <dd>
                                    <?= $this->Number->format($car->year) ?>
                                </dd>
                                                                                                                <dt><?= __('Mileage') ?></dt>
                                <dd>
                                    <?= $this->Number->format($car->mileage) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                                                        <dt><?= __('Active') ?></dt>
                            <dd>
                            <?= $car->active ? __('Yes') : __('No'); ?>
                            </dd>
                                                                    
                                                                        <dt><?= __('Observations') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($car->observations)); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Health Reports']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($car->health_reports)): ?>

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
                                    Score
                                    </th>
                                        
                                                                    
                                    <th>
                                    Description
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                    <th>
                                    Car Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($car->health_reports as $healthReports): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($healthReports->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($healthReports->request_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($healthReports->score) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($healthReports->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($healthReports->active) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($healthReports->car_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'HealthReports', 'action' => 'view', $healthReports->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'HealthReports', 'action' => 'edit', $healthReports->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HealthReports', 'action' => 'delete', $healthReports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $healthReports->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
                    <h3 class="box-title"><?= __('Related {0}', ['Maintence Records']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($car->maintence_records)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Date
                                    </th>
                                        
                                                                    
                                    <th>
                                    Description
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                    <th>
                                    Car Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($car->maintence_records as $maintenceRecords): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($maintenceRecords->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($maintenceRecords->date) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($maintenceRecords->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($maintenceRecords->active) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($maintenceRecords->car_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'MaintenceRecords', 'action' => 'view', $maintenceRecords->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'MaintenceRecords', 'action' => 'edit', $maintenceRecords->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MaintenceRecords', 'action' => 'delete', $maintenceRecords->id], ['confirm' => __('Are you sure you want to delete # {0}?', $maintenceRecords->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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

                <?php if (!empty($car->requests)): ?>

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

                            <?php foreach ($car->requests as $requests): ?>
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
