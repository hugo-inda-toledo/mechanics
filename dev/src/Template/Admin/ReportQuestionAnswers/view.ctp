<section class="content-header">
  <h1>
    <?php echo __('Report Question Answer'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                        <dt><?= __('Report Question') ?></dt>
                                <dd>
                                    <?= $reportQuestionAnswer->has('report_question') ? $reportQuestionAnswer->report_question->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Report Question Alternative') ?></dt>
                                <dd>
                                    <?= $reportQuestionAnswer->has('report_question_alternative') ? $reportQuestionAnswer->report_question_alternative->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Report Question Category') ?></dt>
                                <dd>
                                    <?= $reportQuestionAnswer->has('report_question_category') ? $reportQuestionAnswer->report_question_category->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Report') ?></dt>
                                <dd>
                                    <?= $reportQuestionAnswer->has('report') ? $reportQuestionAnswer->report->id : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('Score') ?></dt>
                                <dd>
                                    <?= $this->Number->format($reportQuestionAnswer->score) ?>
                                </dd>
                                                                                                
                                                                                                                                            
                                            
                                    </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

</section>
