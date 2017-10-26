<section class="content-header">
    <h1>
      Inventario
      <small>Detalle general</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-dashboard']).' Dashboard', ['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]);?>
      </li>
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-files-o']).' Reportes', ['controller' => 'Reports', 'action' => 'index'], ['escape' => false]);?>
      </li>
      <li class="active">Inventario</li>
    </ol> 
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Listado de Pagos</h3>
    </div>

    <div class="box-body">
      <table class="table table-striped">
        <tbody>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Marca</th>
            <th>Costo</th>
            <th>Stock</th>
            <th>Estado</th>
          </tr>
        <?php foreach($items as $item):?>
          <tr>
            <td><?= $item->id ?></td>
            <td><?= $item->name ?></td>
            <td><?= $item->category->name ?></td>
            <td><?= $item->brand ?></td>
            <td><?= $this->Number->format($item->cost, ['before' => '$ ','after' => ' CLP']);?></td>
            <td><?= $item->quantity ?></td>
            <td>
              <?php
                switch ($item->quantity) {
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
    </div>
  </div>
</section>