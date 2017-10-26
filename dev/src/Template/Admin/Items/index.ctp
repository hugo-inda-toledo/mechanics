<section class="content-header">
  <h1>Items</h1>
</section>
<section class="content">
  <?php
  // buscar
  echo $this->Form->create();
  echo $this->Form->input('q',['label'=>'Buscar (nombre, descripción, marca)']);
  echo $this->Form->input('categoria',['label'=>'Categoría']);
  echo $this->Form->input('proveedor',['label'=>'Proveedor']);
  echo $this->Form->button('Buscar', ['type' => 'submit']);
  echo $this->Html->link('Resetiar', ['action' => 'index']);
  echo $this->Form->end();
  ?>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col"><?= $this->Paginator->sort('id','id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('name','nombre') ?></th>
        <th scope="col"><?= $this->Paginator->sort('description','descripción') ?></th>
        <th scope="col"><?= $this->Paginator->sort('quantity','cantidad') ?></th>
        <th scope="col"><?= $this->Paginator->sort('cost','costo') ?></th>
        <th scope="col"><?= $this->Paginator->sort('brand','marca') ?></th>
        <th scope="col"><?= $this->Paginator->sort('category','categoría') ?></th>
        <th scope="col">proveedor</th>
        <th scope="col"><?= $this->Paginator->sort('active','activo') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $item): ?>
        <tr>
          <td><?= $this->Number->format($item->id) ?></td>
          <td><?= h($item->name) ?></td>
          <td><?= h($item->description) ?></td>
          <td><?= $this->Number->format($item->quantity) ?></td>
          <td><?= $this->Number->format($item->cost) ?></td>
          <td><?= h($item->brand) ?></td>
          <td><?= $item->category->name; ?></td>
          <td><?= '' //$item->providers[0]->name; ?></td>
          <td><?= $item->active ? 'Sí': 'No' ?></td>
          <td class="actions">
            <?php $texto_postlink = $item->active ? 'deshabilitar' : 'habilitar'; ?>
            <?= $this->Form->postLink($texto_postlink, ['action' => 'desactivated', $item->id], ['confirm' => __('¿Está seguro que desea '. $texto_postlink .' # {0}?', $item->id)]) ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="paginator">
    <ul class="pagination">
      <?= $this->Paginator->first('<< ' . __('first')) ?>
      <?= $this->Paginator->prev('< ' . __('previous')) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next(__('next') . ' >') ?>
      <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
  </div>
</section>

