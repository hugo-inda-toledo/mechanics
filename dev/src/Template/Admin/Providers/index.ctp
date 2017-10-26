<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Providers
    <div class="pull-right"><?= $this->Html->link(__('Agregar'), ['action' => 'add'], ['class'=>'btn btn-success btn-sm']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Providers</h3>
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
              <th><?= $this->Paginator->sort('city_id') ?></th>
              <th><?= $this->Paginator->sort('commune_id') ?></th>
              <th><?= $this->Paginator->sort('name') ?></th>
              <th><?= $this->Paginator->sort('contact_name') ?></th>
              <th><?= $this->Paginator->sort('address') ?></th>
              <th><?= $this->Paginator->sort('dni') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($providers as $provider): ?>
              <tr>
                <td><?= $this->Number->format($provider->id) ?></td>
                <td><?= $provider->has('city') ? $this->Html->link($provider->city->name, ['controller' => 'Cities', 'action' => 'view', $provider->city->id]) : '' ?></td>
                <td><?= $provider->has('commune') ? $this->Html->link($provider->commune->name, ['controller' => 'Communes', 'action' => 'view', $provider->commune->id]) : '' ?></td>
                <td><?= h($provider->name) ?></td>
                <td><?= h($provider->contact_name) ?></td>
                <td><?= h($provider->address) ?></td>
                <td><?= h($provider->dni) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $provider->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $provider->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $provider->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
