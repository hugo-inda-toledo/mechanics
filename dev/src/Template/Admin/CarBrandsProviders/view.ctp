<section class="content-header">
  <h1>
    <?php echo __('Car Brands Provider'); ?>
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
                                    <?= $carBrandsProvider->has('car_brand') ? $carBrandsProvider->car_brand->brand_name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Provider') ?></dt>
                                <dd>
                                    <?= $carBrandsProvider->has('provider') ? $carBrandsProvider->provider->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Replacement') ?></dt>
                                <dd>
                                    <?= $carBrandsProvider->has('replacement') ? $carBrandsProvider->replacement->name : '' ?>
                                </dd>
                                                                                                
                                <dt><?= __('Stock') ?></dt>
                                <dd>
                                    <?= $this->Number->format($carBrandsProvider->stock) ?>
                                </dd>
                                                                                                                <dt><?= __('Default Provider') ?></dt>
                                <dd>
                                    <?= $this->Number->format($carBrandsProvider->default_provider) ?>
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
