<section class="content-header">
  <h1>
    Provider
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
        <?= $this->Form->create($provider, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('city_id', ['options' => $cities]);
            echo $this->Form->input('commune_id', ['options' => $communes]);
            echo $this->Form->input('name');
            echo $this->Form->input('contact_name');
            echo $this->Form->input('address');
            echo $this->Form->input('dni');
            echo $this->Form->input('phone');
            echo $this->Form->input('email');
            echo $this->Form->input('website');
            echo $this->Form->input('active');
            echo $this->Form->input('car_brands._ids', ['options' => $carBrands]);
            echo $this->Form->input('payment_refunds._ids', ['options' => $paymentRefunds]);
            echo $this->Form->input('replacements._ids', ['options' => $replacements]);
            echo $this->Form->input('supplies._ids', ['options' => $supplies]);
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
