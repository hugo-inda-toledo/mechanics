<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    User
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
        <?= $this->Form->create($user, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('role_id', ['options' => $roles]);
            echo $this->Form->input('name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('email');
            echo $this->Form->input('phone1');
            echo $this->Form->input('phone2');
            echo $this->Form->input('address_name');
            echo $this->Form->input('address_number');
            echo $this->Form->input('address_complement');
            echo $this->Form->input('commune_id', ['options' => $commune]);
            echo $this->Form->input('city_id', ['options' => $cities]);
            echo $this->Form->input('password');
            echo $this->Form->input('photo_url');
            echo $this->Form->input('sex');
            echo $this->Form->input('active');
            echo $this->Form->input('id_fcm1');
            echo $this->Form->input('id_fcm2');
            echo $this->Form->input('hash_activate');
            echo $this->Form->input('temp_pass');
            echo $this->Form->input('communes._ids', ['options' => $communes]);
            echo $this->Form->input('tools._ids', ['options' => $tools]);
            echo $this->Form->input('payment_refunds._ids', ['options' => $paymentRefunds]);
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
