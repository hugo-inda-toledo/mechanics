<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Report Question Answers
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Report Question Answers</h3>
          <?php /*
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        */ ?>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('report_question_id') ?></th>
              <th><?= $this->Paginator->sort('report_question_alternative_id') ?></th>
              <th><?= $this->Paginator->sort('report_question_category_id') ?></th>
              <th><?= $this->Paginator->sort('score') ?></th>
              <th><?= $this->Paginator->sort('report_id') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($reportQuestionAnswers as $reportQuestionAnswer): ?>
              <tr>
                <td><?= $this->Number->format($reportQuestionAnswer->id) ?></td>
                <td><?= $reportQuestionAnswer->has('report_question') ? $this->Html->link($reportQuestionAnswer->report_question->id, ['controller' => 'ReportQuestions', 'action' => 'view', $reportQuestionAnswer->report_question->id]) : '' ?></td>
                <td><?= $reportQuestionAnswer->has('report_question_alternative') ? $this->Html->link($reportQuestionAnswer->report_question_alternative->id, ['controller' => 'ReportQuestionAlternatives', 'action' => 'view', $reportQuestionAnswer->report_question_alternative->id]) : '' ?></td>
                <td><?= $reportQuestionAnswer->has('report_question_category') ? $this->Html->link($reportQuestionAnswer->report_question_category->name, ['controller' => 'ReportQuestionCategories', 'action' => 'view', $reportQuestionAnswer->report_question_category->id]) : '' ?></td>
                <td><?= $this->Number->format($reportQuestionAnswer->score) ?></td>
                <td><?= $reportQuestionAnswer->has('report') ? $this->Html->link($reportQuestionAnswer->report->id, ['controller' => 'Reports', 'action' => 'view', $reportQuestionAnswer->report->id]) : '' ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $reportQuestionAnswer->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reportQuestionAnswer->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reportQuestionAnswer->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
