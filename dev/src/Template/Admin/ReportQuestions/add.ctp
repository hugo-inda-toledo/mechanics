<section class="content-header">
  <h1>
    Report Question
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
        <?= $this->Form->create($reportQuestion, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('content');
            echo $this->Form->input('report_question_category_id', ['options' => $reportQuestionCategories]);
            echo $this->Form->input('active');
            echo $this->Form->input('report_question_group_id', ['options' => $reportQuestionGroups]);
            echo $this->Form->input('tips');
            echo $this->Form->input('obs');
            echo $this->Form->input('type');
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
