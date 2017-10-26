<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Purchase Order
    <small><?= __('Edit') ?></small>
    <div class="pull-right">
      <?= $this->Html->link('<i class="fa fa-angle-left"></i> '.__('Volver'), ['action' => 'index'], ['class'=>'btn btn-success btn-sm','escape' => false]) ?>
    </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Form') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($purchaseOrder, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('request_id', ['options' => $requests]);
            echo $this->Form->input('active');
            echo $this->Form->input('replacements._ids', ['options' => $replacements]);
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Save')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
