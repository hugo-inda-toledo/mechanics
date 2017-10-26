<section class="content-header">
  <h1>
    <?php echo __('Replacement'); ?>
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
                                            <?= h($replacement->name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Description') ?></dt>
                                        <dd>
                                            <?= h($replacement->description) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Original Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($replacement->original_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Price For Request') ?></dt>
                                <dd>
                                    <?= $this->Number->format($replacement->price_for_request) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                                                        <dt><?= __('Active') ?></dt>
                            <dd>
                            <?= $replacement->active ? __('Yes') : __('No'); ?>
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

                <?php if (!empty($replacement->available_services)): ?>

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

                            <?php foreach ($replacement->available_services as $availableServices): ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Purchase Orders']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($replacement->purchase_orders)): ?>

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
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($replacement->purchase_orders as $purchaseOrders): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($purchaseOrders->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($purchaseOrders->request_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($purchaseOrders->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'PurchaseOrders', 'action' => 'view', $purchaseOrders->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'PurchaseOrders', 'action' => 'edit', $purchaseOrders->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurchaseOrders', 'action' => 'delete', $purchaseOrders->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrders->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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

                <?php if (!empty($replacement->providers)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    City Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Commune Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Contact Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Address
                                    </th>
                                        
                                                                    
                                    <th>
                                    Dni
                                    </th>
                                        
                                                                    
                                    <th>
                                    Phone
                                    </th>
                                        
                                                                    
                                    <th>
                                    Email
                                    </th>
                                        
                                                                    
                                    <th>
                                    Website
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($replacement->providers as $providers): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($providers->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->city_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->commune_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->contact_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->address) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->dni) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->phone) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->email) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($providers->website) ?>
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Car Brands']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($replacement->car_brands)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Brand Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Brand Logo
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($replacement->car_brands as $carBrands): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($carBrands->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($carBrands->brand_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($carBrands->brand_logo) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($carBrands->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'CarBrands', 'action' => 'view', $carBrands->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'CarBrands', 'action' => 'edit', $carBrands->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CarBrands', 'action' => 'delete', $carBrands->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carBrands->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
