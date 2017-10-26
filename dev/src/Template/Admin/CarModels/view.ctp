<section class="content-header">
  <h1>
    <?php echo __('Car Model'); ?>
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
                                                                                                        <dt><?= __('Car Brand') ?></dt>
                                <dd>
                                    <?= $carModel->has('car_brand') ? $carModel->car_brand->brand_name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Model Name') ?></dt>
                                        <dd>
                                            <?= h($carModel->model_name) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                            
                                                                                                                                                                                                
                                                                        <dt><?= __('Active') ?></dt>
                            <dd>
                            <?= $carModel->active ? __('Yes') : __('No'); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Cars']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($carModel->cars)): ?>

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

                            <?php foreach ($carModel->cars as $cars): ?>
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
</section>
