<section class="content-header">
    <h1>
      Estadisticas de Venta
      <small>Detalle general</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-dashboard']).' Dashboard', ['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]);?>
      </li>
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-files-o']).' Reportes', ['controller' => 'Reports', 'action' => 'index'], ['escape' => false]);?>
      </li>
      <li class="active">Estadisticas de Venta</li>
    </ol> 
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Selecciona el mes/año a visualizar:</h3>
    </div>

    <div class="box-body">
      <?= $this->Form->create(null, ['url' => ['controller' => 'Requests', 'action' => 'salesResult'/*, '_ext'=>'xlsx'*/]]);?>
      <div class="form-group">
        <label>Rango de fecha:</label>

        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <?= $this->Form->input('range', ['class' => 'form-control pull-right', 'id' => 'range-date', 'required' => true, 'label' => false]); ?>
        </div>
      </div>


    </div>
    <div class="box-footer">
      <?= $this->Form->button(__('Buscar'), ['class' => 'btn btn-success']); ?>
    </div>

  </div>
</section>

<?= $this->start('scriptBotton') ?>
<?php echo $this->Html->css('AdminLTE./plugins/datepicker/datepicker3'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/daterangepicker/moment'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/datepicker/bootstrap-datepicker'); ?>

<script>
  $(function () {
    //$('#range-date').daterangepicker({format: 'YYYY-MM-DD'});
    $("#range-date").datepicker( {
        format: "mm-yyyy",
        viewMode: "months", 
        minViewMode: "months",
        endDate: '+0d'
    });
  });
</script>
<?= $this->end(); ?>
