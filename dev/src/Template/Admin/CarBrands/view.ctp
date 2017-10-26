<section class="content-header">
  <h1>
    <?php echo __('Car Brand'); ?>
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
                                                                                                                <dt><?= __('Brand Name') ?></dt>
                                        <dd>
                                            <?= h($carBrand->brand_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Brand Logo') ?></dt>
                                        <dd>
                                            <?= h($carBrand->brand_logo) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                            
                                                                                                                                                                                                
                                                                        <dt><?= __('Active') ?></dt>
                            <dd>
                            <?= $carBrand->active ? __('Yes') : __('No'); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Car Models']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($carBrand->car_models)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Car Brand Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Model Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($carBrand->car_models as $carModels): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($carModels->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($carModels->car_brand_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($carModels->model_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($carModels->active) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'CarModels', 'action' => 'view', $carModels->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'CarModels', 'action' => 'edit', $carModels->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CarModels', 'action' => 'delete', $carModels->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carModels->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
                    <h3 class="box-title"><?= __('Related {0}', ['Cars']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($carBrand->cars)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    User Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Car Brand Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Car Model Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Patent
                                    </th>
                                        
                                                                    
                                    <th>
                                    Year
                                    </th>
                                        
                                                                    
                                    <th>
                                    Mileage
                                    </th>
                                        
                                                                    
                                    <th>
                                    Active
                                    </th>
                                        
                                                                                                                                            
                                    <th>
                                    Observations
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($carBrand->cars as $cars): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($cars->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->user_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->car_brand_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->car_model_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->patent) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->year) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->mileage) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($cars->active) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($cars->observations) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Cars', 'action' => 'view', $cars->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Cars', 'action' => 'edit', $cars->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Cars', 'action' => 'delete', $cars->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cars->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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

                <?php if (!empty($carBrand->providers)): ?>

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

                            <?php foreach ($carBrand->providers as $providers): ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Replacements']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($carBrand->replacements)): ?>

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

                            <?php foreach ($carBrand->replacements as $replacements): ?>
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
</section>
