<section class="content-header">
  <h1>
    <?php echo __('Bank'); ?>
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
                                                                                                                <dt><?= __('Short Name') ?></dt>
                                        <dd>
                                            <?= h($bank->short_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Long Name') ?></dt>
                                        <dd>
                                            <?= h($bank->long_name) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Origin Account Number') ?></dt>
                                <dd>
                                    <?= $this->Number->format($bank->origin_account_number) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                                                        <dt><?= __('Active') ?></dt>
                            <dd>
                            <?= $bank->active ? __('Yes') : __('No'); ?>
                            </dd>
                                                    <dt><?= __('Enabled To Export') ?></dt>
                            <dd>
                            <?= $bank->enabled_to_export ? __('Yes') : __('No'); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Payment Refunds']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($bank->payment_refunds)): ?>

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

                            <?php foreach ($bank->payment_refunds as $paymentRefunds): ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Codes']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($bank->codes)): ?>

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
                                    Code
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($bank->codes as $codes): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($codes->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($codes->bank_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($codes->code) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Codes', 'action' => 'view', $codes->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Codes', 'action' => 'edit', $codes->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Codes', 'action' => 'delete', $codes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $codes->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
