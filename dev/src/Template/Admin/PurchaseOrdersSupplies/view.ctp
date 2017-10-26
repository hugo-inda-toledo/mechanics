<section class="content-header">
  <h1>
    <?php echo __('Purchase Orders Supply'); ?>
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
                                                                                                        <dt><?= __('Purchase Order') ?></dt>
                                <dd>
                                    <?= $purchaseOrdersSupply->has('purchase_order') ? $purchaseOrdersSupply->purchase_order->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Supply') ?></dt>
                                <dd>
                                    <?= $purchaseOrdersSupply->has('supply') ? $purchaseOrdersSupply->supply->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Provider') ?></dt>
                                <dd>
                                    <?= $purchaseOrdersSupply->has('provider') ? $purchaseOrdersSupply->provider->name : '' ?>
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

</section>
