<section class="content-header">
  <h1>
    <?php echo __('Purchase Orders Replacement'); ?>
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
                                    <?= $purchaseOrdersReplacement->has('purchase_order') ? $purchaseOrdersReplacement->purchase_order->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Replacement') ?></dt>
                                <dd>
                                    <?= $purchaseOrdersReplacement->has('replacement') ? $purchaseOrdersReplacement->replacement->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Provider') ?></dt>
                                <dd>
                                    <?= $purchaseOrdersReplacement->has('provider') ? $purchaseOrdersReplacement->provider->name : '' ?>
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
