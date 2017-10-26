


<section class="content-header">
    <h1>
      Carga de documentos tributarios
      <small>Guarda las boletas y facturas en el sistema</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-dashboard']).' Dashboard', ['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]);?>
      </li>
      <li>
        <?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-files-o']).' Documentos', ['controller' => 'Requests', 'action' => 'uploadBills'], ['escape' => false]);?>
      </li>
      <li class="active">Carga de documentos tributarios</li>
    </ol> 
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Sube al sistema las boletas y facturas con el siguiente formato: solicitud_cliente.jpg (Ej: 5_2.jpg)</h3>
    </div>

    <div class="box-body">
      <?= $this->Form->create(null, ['url' => ['controller' => 'Requests', 'action' => 'uploadBills'], 'type' => 'file']);?>
      <div class="form-group">
        <label>Archivos</label>

        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-files-o"></i>
          </div>
          <?php echo $this->Form->input('docs[]', ['type' => 'file', 'multiple' => 'true', 'label' => false, 'required' => true]); ?>
        </div>
      </div>


    </div>
    <div class="box-footer">
      <?= $this->Form->button(__('Cargar'), ['class' => 'btn btn-success']); ?>
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
