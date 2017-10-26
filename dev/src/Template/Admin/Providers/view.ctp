<section class="content-header">
  <h1>
    <?php echo __('Provider'); ?>
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
                                                                                                        <dt><?= __('City') ?></dt>
                                <dd>
                                    <?= $provider->has('city') ? $provider->city->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Commune') ?></dt>
                                <dd>
                                    <?= $provider->has('commune') ? $provider->commune->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($provider->name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Contact Name') ?></dt>
                                        <dd>
                                            <?= h($provider->contact_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Address') ?></dt>
                                        <dd>
                                            <?= h($provider->address) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Dni') ?></dt>
                                        <dd>
                                            <?= h($provider->dni) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Phone') ?></dt>
                                        <dd>
                                            <?= h($provider->phone) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Email') ?></dt>
                                        <dd>
                                            <?= h($provider->email) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Website') ?></dt>
                                        <dd>
                                            <?= h($provider->website) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                            
                                                                                                                                                                                                
                                                                        <dt><?= __('Active') ?></dt>
                            <dd>
                            <?= $provider->active ? __('Yes') : __('No'); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Purchase Orders Replacements']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($provider->purchase_orders_replacements)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Purchase Order Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Replacement Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Provider Id
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($provider->purchase_orders_replacements as $purchaseOrdersReplacements): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($purchaseOrdersReplacements->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($purchaseOrdersReplacements->purchase_order_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($purchaseOrdersReplacements->replacement_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($purchaseOrdersReplacements->provider_id) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'PurchaseOrdersReplacements', 'action' => 'view', $purchaseOrdersReplacements->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'PurchaseOrdersReplacements', 'action' => 'edit', $purchaseOrdersReplacements->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurchaseOrdersReplacements', 'action' => 'delete', $purchaseOrdersReplacements->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrdersReplacements->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
                    <h3 class="box-title"><?= __('Related {0}', ['Purchase Orders Supplies']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($provider->purchase_orders_supplies)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Purchase Order Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Supply Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Provider Id
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($provider->purchase_orders_supplies as $purchaseOrdersSupplies): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($purchaseOrdersSupplies->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($purchaseOrdersSupplies->purchase_order_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($purchaseOrdersSupplies->supply_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($purchaseOrdersSupplies->provider_id) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'PurchaseOrdersSupplies', 'action' => 'view', $purchaseOrdersSupplies->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'PurchaseOrdersSupplies', 'action' => 'edit', $purchaseOrdersSupplies->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurchaseOrdersSupplies', 'action' => 'delete', $purchaseOrdersSupplies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrdersSupplies->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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

                <?php if (!empty($provider->car_brands)): ?>

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

                            <?php foreach ($provider->car_brands as $carBrands): ?>
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Payment Refunds']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($provider->payment_refunds)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Bank Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Account Number
                                    </th>
                                        
                                                                    
                                    <th>
                                    Dni
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Email
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($provider->payment_refunds as $paymentRefunds): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->bank_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->account_number) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->dni) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($paymentRefunds->email) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'PaymentRefunds', 'action' => 'view', $paymentRefunds->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'PaymentRefunds', 'action' => 'edit', $paymentRefunds->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PaymentRefunds', 'action' => 'delete', $paymentRefunds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentRefunds->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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

                <?php if (!empty($provider->replacements)): ?>

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
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($provider->replacements as $replacements): ?>
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

                <?php if (!empty($provider->supplies)): ?>

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

                            <?php foreach ($provider->supplies as $supplies): ?>
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
</section>
