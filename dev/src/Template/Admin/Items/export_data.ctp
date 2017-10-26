<section class="content-header">
    <h1>
      Exportar Insumos
      <small>Formato Excel</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-dashboard']).' Dashboard', ['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]);?>
      </li>
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-files-o']).' Reportes', ['controller' => 'Reports', 'action' => 'index'], ['escape' => false]);?>
      </li>
      <li class="active">Exportar Insumos</li>
    </ol> 
</section>


<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Selecciona el rango de fecha de los insumos.</h3>
    </div>

    <div class="box-body">
      <?= $this->Form->create(null, ['url' => ['controller' => 'Items', 'action' => 'exportFile', '_ext'=>'xlsx']]);?>
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


    </div>
    <div class="box-footer">
      <?= $this->Form->button(__('Export'), ['class' => 'btn btn-success']); ?>
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
