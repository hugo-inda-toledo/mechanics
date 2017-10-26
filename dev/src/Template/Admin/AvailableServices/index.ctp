<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Available Services
    <div class="pull-right"><?= $this->Html->link(__('Agregar'), ['action' => 'add'], ['class'=>'btn btn-success btn-sm']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Available Services</h3>
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
              <th><?= $this->Paginator->sort('requests_type_id') ?></th>
              <th><?= $this->Paginator->sort('name') ?></th>
              <th><?= $this->Paginator->sort('estimated_time') ?></th>
              <th><?= $this->Paginator->sort('real_estimated_time') ?></th>
              <th><?= $this->Paginator->sort('total_price') ?></th>
              <th><?= $this->Paginator->sort('supplies_price') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($availableServices as $availableService): ?>
              <tr>
                <td><?= $this->Number->format($availableService->id) ?></td>
                <td><?= $availableService->has('requests_type') ? $this->Html->link($availableService->requests_type->name, ['controller' => 'RequestsTypes', 'action' => 'view', $availableService->requests_type->id]) : '' ?></td>
                <td><?= h($availableService->name) ?></td>
                <td><?= $this->Number->format($availableService->estimated_time) ?></td>
                <td><?= $this->Number->format($availableService->real_estimated_time) ?></td>
                <td><?= $this->Number->format($availableService->total_price) ?></td>
                <td><?= $this->Number->format($availableService->supplies_price) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $availableService->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $availableService->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $availableService->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
