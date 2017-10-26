<section class="content-header">
    <h1>
      Pedidos Históricos a Proveedores
      <small>Detalle general</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-dashboard']).' Dashboard', ['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]);?>
      </li>
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-files-o']).' Reportes', ['controller' => 'Reports', 'action' => 'index'], ['escape' => false]);?>
      </li>
      <li class="active">Pedidos Históricos a Proveedores</li>
    </ol> 
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Listado de Ordenes de compra</h3>
    </div>

    <div class="box-body">
      <table class="table table-striped">
        <tbody><tr>
          <th>ID Orden de Compra</th>
          <th>Categoría</th>
          <th>Insumo</th>
          <th>Marca</th>
          <th>Proveedor</th>
          <th>Valor Insumo</th>
        </tr>
        <?php foreach($purchase_orders as $purchase_order):?>
          <?php foreach($purchase_order->items as $item):?>
            <tr>
              <td><?= $purchase_order->id;?></td>
              <td><?= $item->category->name;?></td>
              <td><?= $item->name;?></td>
              <td><?= $item->brand;?></td>
              <td>
                <?php foreach($item->providers as $provider):?>
                  <?php if($provider->id == $item->_joinData->provider_id):?>
                    <?= $provider->name?>
                    <?php break;?>
                  <?php endif;?>
                <?php endforeach;?>
              </td>
              <td><?= $this->Number->format($item->cost, ['before' => '$ ','after' => ' CLP']);?></td>
          <?php endforeach;?>
        <?php endforeach;?>
      </tbody>
      </table>
    </div>
    
    <div class="box-footer">
      <?= $this->Html->link('< Volver a buscar', ['controller' => 'Requests', 'action' => 'salesSearch'], ['class' => 'btn btn-default']);?>

      <?= $this->Form->postLink($this->Html->tag('i', '', ['class' => 'fa fa-file-excel-o']).' Exportar', ['controller' => 'PurchaseOrders', 'action' => 'ordersResultExport', '_ext'=>'xlsx'], ['data' => array('year' => $year, 'month' => $month), 'class' => 'btn btn-success', 'escape' => false])?>
    </div>
  </div>
</section>
