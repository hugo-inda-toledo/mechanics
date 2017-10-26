<section class="content-header">
  <h1>
    <?php echo __('Supply'); ?>
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
                                                                                                                <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($supply->name) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Total Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($supply->total_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Price For Request') ?></dt>
                                <dd>
                                    <?= $this->Number->format($supply->price_for_request) ?>
                                </dd>
                                                                                                                <dt><?= __('Stock') ?></dt>
                                <dd>
                                    <?= $this->Number->format($supply->stock) ?>
                                </dd>
                                                                                                                <dt><?= __('Active') ?></dt>
                                <dd>
                                    <?= $this->Number->format($supply->active) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                            
                                                                        <dt><?= __('Description') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($supply->description)); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Available Services']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($supply->available_services)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Requests Type Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Description
                                    </th>
                                        
                                                                    
                                    <th>
                                    Estimated Time
                                    </th>
                                        
                                                                    
                                    <th>
                                    Real Estimated Time
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
                                    Active
                                    </th>
                                        
                                                                    
                                    <th>
                                    Inspection
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($supply->available_services as $availableServices): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($availableServices->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($availableServices->requests_type_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($availableServices->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($availableServices->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($availableServices->estimated_time) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($availableServices->real_estimated_time) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($availableServices->total_price) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($availableServices->supplies_price) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($availableServices->replacements_price) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($availableServices->mechanic_pay) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($availableServices->active) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($availableServices->inspection) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'AvailableServices', 'action' => 'view', $availableServices->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'AvailableServices', 'action' => 'edit', $availableServices->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AvailableServices', 'action' => 'delete', $availableServices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $availableServices->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
                    <h3 class="box-title"><?= __('Related {0}', ['Providers']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($supply->providers)): ?>

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
                                    Phone
                                    </th>
                                        
                                                                    
                                    <th>
                                    Email
                                    </th>
                                        
                                                                    
                                    <th>
                                    Address
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($supply->providers as $providers): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($providers->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->phone) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->email) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->address) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Providers', 'action' => 'view', $providers->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Providers', 'action' => 'edit', $providers->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Providers', 'action' => 'delete', $providers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $providers->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
