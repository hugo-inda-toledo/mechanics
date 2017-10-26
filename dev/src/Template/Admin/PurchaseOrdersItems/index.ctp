<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Purchase Orders Items
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Purchase Orders Items</h3>
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
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('purchase_order_id') ?></th>
              <th><?= $this->Paginator->sort('item_id') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($purchaseOrdersItems as $purchaseOrdersItem): ?>
              <tr>
                <td><?= $this->Number->format($purchaseOrdersItem->id) ?></td>
                <td><?= $purchaseOrdersItem->has('purchase_order') ? $this->Html->link($purchaseOrdersItem->purchase_order->id, ['controller' => 'PurchaseOrders', 'action' => 'view', $purchaseOrdersItem->purchase_order->id]) : '' ?></td>
                <td><?= $purchaseOrdersItem->has('item') ? $this->Html->link($purchaseOrdersItem->item->name, ['controller' => 'Items', 'action' => 'view', $purchaseOrdersItem->item->id]) : '' ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseOrdersItem->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseOrdersItem->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseOrdersItem->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
