<section class="content-header">
    <h1>
      Inventario de productos
      <small>Listado y exportación</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-dashboard']).' Dashboard', ['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]);?>
      </li>
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-files-o']).' Reportes', ['controller' => 'Reports', 'action' => 'index'], ['escape' => false]);?>
      </li>
      <li class="active">Inventario de productos</li>
    </ol> 
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Listado de <?= ($type_search == 'Replacements') ? 'Repuestos' : 'Insumos'?></h3>
      <div class="pull-right">
        <?= $this->Html->link('Volver a buscar', ['controller' => 'Reports', 'action' => 'productsSearch'], ['class' => 'btn btn-sm btn-default']); ?>
        <?= 
          ($type_search == 'Replacements') ? 
              $this->Form->postLink('Exportar Repuestos', ['controller' => 'Replacements', 'action' => 'exportFile', '_ext'=>'xlsx'], ['class' => 'btn btn-sm btn-success', 'data' => ['range' => $range]]) : 
              $this->Form->postLink('Exportar Insumos', ['controller' => 'Supplies', 'action' => 'exportFile', '_ext'=>'xlsx'], ['class' => 'btn btn-sm btn-success', 'data' => ['range' => $range]])
        ?>
      </div>
    </div>

    <div class="box-body">
      <?php if($type_search == 'Replacements'):?>
        <table class="table table-striped">
          <tbody>
            <tr>
              <th>ID</th>
              <th>Repuesto</th>
              <th>Marca</th>
              <th>Proveedor</th>
              <th>Stock</th>
              <th>Estado</th>
            </tr>
          <?php foreach($products as $product):?>
            <tr>
              <td><?= $product['id'] ?></td>
              <td><?= $product['repuesto'] ?></td>
              <td><?= $product['marca'] ?></td>
              <td><?= $product['proveedor'] ?></td>
              <td><?= $product['stock'] ?></td>
              <td>
                <?php
                  switch ($product['stock']) {
                    case 0:
                      echo $this->Html->tag('span', 'Sin Stock', ['class' => 'label label-danger']);
                      break;

                    case 1:
                      echo $this->Html->tag('span', 'Critico', ['class' => 'label label-danger']);
                      break;

                    case 2:
                      echo $this->Html->tag('span', 'Critico', ['class' => 'label label-danger']);
                      break;

                    case 3:
                      echo $this->Html->tag('span', 'Bajo', ['class' => 'label label-warning']);
                      break;

                    case 4:
                      echo $this->Html->tag('span', 'Bajo', ['class' => 'label label-warning']);
                      break;
                    
                    default:
                      echo $this->Html->tag('span', 'Con stock', ['class' => 'label label-success']);
                      break;
                  }
                ?>
              </td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>
      <?php else:?>
        <table class="table table-striped">
          <tbody>
            <tr>
              <th>ID</th>
              <th>Insumo</th>
              <th>Proveedor</th>
              <th>Stock</th>
              <th>Estado</th>
            </tr>
          <?php foreach($products as $product):?>
            <tr>
              <td><?= $product->id ?></td>
              <td><?= $product->name ?></td>
              <td><?= 'N/A' ?></td>
              <td><?= $product->stock ?></td>
              <td>
                <?php
                  switch ($product['stock']) {
                    case 0:
                      echo $this->Html->tag('span', 'Sin Stock', ['class' => 'label label-danger']);
                      break;

                    case 1:
                      echo $this->Html->tag('span', 'Critico', ['class' => 'label label-danger']);
                      break;

                    case 2:
                      echo $this->Html->tag('span', 'Critico', ['class' => 'label label-danger']);
                      break;

                    case 3:
                      echo $this->Html->tag('span', 'Bajo', ['class' => 'label label-warning']);
                      break;

                    case 4:
                      echo $this->Html->tag('span', 'Bajo', ['class' => 'label label-warning']);
                      break;
                    
                    default:
                      echo $this->Html->tag('span', 'Con stock', ['class' => 'label label-success']);
                      break;
                  }
                ?>
              </td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>
      <?php endif;?>
    </div>
  </div>
</section>