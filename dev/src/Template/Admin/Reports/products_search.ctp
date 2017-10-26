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
      <h3 class="box-title">jñlj</h3>
    </div>

    <div class="box-body">
      <?= $this->Form->create(null, ['url' => ['controller' => 'Reports', 'action' => 'productsResult']]);?>
      <div class="form-group">
        <label>Rango de fecha:</label>

        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <?= $this->Form->input('range', ['class' => 'form-control pull-right', 'id' => 'range-date', 'required' => true, 'label' => false]); ?>
        </div>
        <!-- /.input group -->
      </div>

      <div class="form-group">
        <?= $this->Form->label('type_search', 'Tipo de productos a buscar'); ?>
        <?= $this->Form->select('type_search', ['Replacements' => 'Repuestos', 'Supplies' => 'Insumos'], ['class' => 'form-control', 'empty' => 'Selecciona un tipo de producto', 'required' => true]);?>
      </div>


    </div>
    <div class="box-footer">
      <?= $this->Form->button(__('Buscar'), ['class' => 'btn btn-success']); ?>
    </div>

  </div>
</section>

<?= $this->start('scriptBotton') ?>
<?php echo $this->Html->css('AdminLTE./plugins/daterangepicker/daterangepicker-bs3'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/daterangepicker/moment'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/daterangepicker/daterangepicker'); ?>

<script>
  $(function () {
    $('#range-date').daterangepicker({format: 'YYYY-MM-DD'});
  });
</script>
<?= $this->end(); ?>

