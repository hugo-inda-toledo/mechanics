<section class="content-header">
  <h1>
    Available Service
    <small><?= __('Add') ?></small>
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
        <?= $this->Form->create($availableService, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('requests_type_id', ['options' => $requestsTypes]);
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('estimated_time');
            echo $this->Form->input('real_estimated_time');
            echo $this->Form->input('total_price');
            echo $this->Form->input('supplies_price');
            echo $this->Form->input('replacements_price');
            echo $this->Form->input('mechanic_pay');
            echo $this->Form->input('active');
            echo $this->Form->input('inspection');
            echo $this->Form->input('abilities._ids', ['options' => $abilities]);
            echo $this->Form->input('replacements._ids', ['options' => $replacements]);
            echo $this->Form->input('supplies._ids', ['options' => $supplies]);
            echo $this->Form->input('requests._ids', ['options' => $requests]);
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
