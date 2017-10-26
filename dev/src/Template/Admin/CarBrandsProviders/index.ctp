<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Car Brands Providers
    <div class="pull-right"><?= $this->Html->link(__('Agregar'), ['action' => 'add'], ['class'=>'btn btn-success btn-sm']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Car Brands Providers</h3>
          <?php /*
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        */ ?>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('car_brand_id') ?></th>
              <th><?= $this->Paginator->sort('provider_id') ?></th>
              <th><?= $this->Paginator->sort('replacement_id') ?></th>
              <th><?= $this->Paginator->sort('stock') ?></th>
              <th><?= $this->Paginator->sort('default_provider') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($carBrandsProviders as $carBrandsProvider): ?>
              <tr>
                <td><?= $this->Number->format($carBrandsProvider->id) ?></td>
                <td><?= $carBrandsProvider->has('car_brand') ? $this->Html->link($carBrandsProvider->car_brand->brand_name, ['controller' => 'CarBrands', 'action' => 'view', $carBrandsProvider->car_brand->id]) : '' ?></td>
                <td><?= $carBrandsProvider->has('provider') ? $this->Html->link($carBrandsProvider->provider->name, ['controller' => 'Providers', 'action' => 'view', $carBrandsProvider->provider->id]) : '' ?></td>
                <td><?= $carBrandsProvider->has('replacement') ? $this->Html->link($carBrandsProvider->replacement->name, ['controller' => 'Replacements', 'action' => 'view', $carBrandsProvider->replacement->id]) : '' ?></td>
                <td><?= $this->Number->format($carBrandsProvider->stock) ?></td>
                <td><?= $this->Number->format($carBrandsProvider->default_provider) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $carBrandsProvider->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $carBrandsProvider->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $carBrandsProvider->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
