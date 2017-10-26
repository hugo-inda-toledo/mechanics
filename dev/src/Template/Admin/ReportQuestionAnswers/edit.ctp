<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Report Question Answer
    <small><?= __('Edit') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
    </li>
  </ol>
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
        <?= $this->Form->create($reportQuestionAnswer, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('report_question_id', ['options' => $reportQuestions]);
            echo $this->Form->input('report_question_alternative_id', ['options' => $reportQuestionAlternatives]);
            echo $this->Form->input('report_question_category_id', ['options' => $reportQuestionCategories]);
            echo $this->Form->input('score');
            echo $this->Form->input('report_id', ['options' => $reports]);
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
